<?php

namespace App\Http\Controllers\admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreRoleRequest;
use App\Http\Requests\admin\UpdateRoleRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $formattedPermissions = $this->getFormattedPermissions();
        $roles = Role::with('permissions')->withCount('users')->get();

        return view('admin.roles.index', compact('roles', 'formattedPermissions'));
    }

    /**
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $request->role_name]);

            if (!empty($request->permissions)) {
                $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name');
                $role->syncPermissions($permissionNames);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('roles.role_created'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('common.error_occurred'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $role = Role::with(['users', 'permissions'])->findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function getSpecificRoleUsersData(string $id): JsonResponse
    {
        $role = Role::findOrFail($id);
        $users = $role->users()->select(['id', 'name', 'created_at'])->get();

        return DataTables::of($users)
            ->addColumn('actions', function ($user) use ($id) {
                if (auth()->user()->hasPermissionTo(PermissionEnum::DELETE_ROLES)) {
                    return '<a href="#" data-kt-roles-table-filter="delete_row" data-role-id="' . $id . '" data-user-id="' . $user->id . '" class="btn btn-sm btn-light-danger deleteUser">
                            <i class="bi bi-trash"></i> ' . __('common.delete') . '
                        </a>';
                }
                return '';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('D d, M Y');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * @param $roleId
     * @param $userId
     * @return JsonResponse
     */
    public function deleteUsersAssignedToRole($roleId, $userId): JsonResponse
    {
        try {
            $user = User::find($userId);
            $role = Role::find($roleId);

            if (!$user || !$role) {
                return response()->json([
                    'success' => false,
                    'message' => __('common.not_found'),
                ], Response::HTTP_NOT_FOUND);
            }

            $user->roles()->detach($role->id);

            return response()->json(['success' => true, 'message' => __('roles.role_detached')]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('common.error_occurred'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function edit(string $id): JsonResponse
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::all();
            $assignedPermissions = $role->permissions->pluck('id')->toArray();

            // Group permissions by category using PermissionEnum
            $groupedPermissions = collect();
            
            foreach ($permissions as $permission) {
                $permissionEnum = PermissionEnum::tryFrom($permission->name);
                if ($permissionEnum) {
                    $category = $permissionEnum->getCategory(app()->getLocale());
                    
                    if (!$groupedPermissions->has($category)) {
                        $groupedPermissions[$category] = collect();
                    }
                    
                    $groupedPermissions[$category]->push([
                        'id' => $permission->id,
                        'name' => $permissionEnum->getDisplayName(app()->getLocale()),
                        'original_name' => $permission->name,
                    ]);
                }
            }
            
            $formattedPermissions = $groupedPermissions;

            return response()->json([
                'success' => true,
                'role' => $role,
                'permissions' => $permissions,
                'assigned_permissions' => $assignedPermissions,
                'formatted_permissions' => $formattedPermissions
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('common.not_found'),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param UpdateRoleRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);
            $role->name = $request->role_name;
            $role->save();

            if (!empty($request->permissions)) {
                $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name');
                $role->syncPermissions($permissionNames);
            } else {
                $role->syncPermissions([]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('roles.role_updated'),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('common.operation_failed'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        try {
            $forceDelete = (bool) $request->input('force', false);
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                    'success' => false,
                    'message' => __('common.not_found')
                ], Response::HTTP_NOT_FOUND);
            }

            // Check if role is assigned to any users
            if ($role->users()->count() > 0 && !$forceDelete) {
                return response()->json([
                    'success' => false,
                    'message' => __('roles.role_has_users')
                ], Response::HTTP_BAD_REQUEST);
            }

            DB::beginTransaction();

            if ($forceDelete) {
                foreach ($role->users as $user) {
                    $user->removeRole($role);
                }
            }
            $role->permissions()->detach();
            $deleted = $role->delete();

            DB::commit();

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => __('common.operation_failed')
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'success' => true,
                'message' => __('roles.role_deleted')
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('common.operation_failed')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Helper method to get formatted permissions
     * @return \Illuminate\Support\Collection
     */
    private function getFormattedPermissions(): \Illuminate\Support\Collection
    {
        $permissions = Permission::all();
        
        // Group permissions by category using PermissionEnum
        $groupedPermissions = collect();
        
        foreach ($permissions as $permission) {
            $permissionEnum = PermissionEnum::tryFrom($permission->name);
            if ($permissionEnum) {
                $category = $permissionEnum->getCategory(app()->getLocale());
                
                if (!$groupedPermissions->has($category)) {
                    $groupedPermissions[$category] = collect();
                }
                
                $groupedPermissions[$category]->push([
                    'id' => $permission->id,
                    'name' => $permissionEnum->getDisplayName(app()->getLocale()),
                    'original_name' => $permission->name,
                ]);
            }
        }
        
        return $groupedPermissions;
    }
}
