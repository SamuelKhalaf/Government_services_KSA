<?php

namespace App\Http\Controllers\admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StorePermissionRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PermissionsController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.permissions.index');
    }

    /**
     * @return JsonResponse
     */
    public function getPermissionsDatatable(): JsonResponse
    {
        $permissions = Permission::select(['id', 'name', 'created_at'])->with('roles')->get();

        return DataTables::of($permissions)
            ->addColumn('assigned_roles', function ($permission) {
                $roleColors = [
                    'admin' => 'primary',
                    'employee' => 'info'
                ];

                return $permission->roles->pluck('name')->map(function ($role) use ($roleColors) {
                    $color = $roleColors[$role] ?? 'warning';
                    $displayName =  __('roles.' .$role);
                    return '<span class="badge badge-light-' . $color . ' fs-7 m-1">' . $displayName . '</span>';
                })->implode(' ');
            })
            ->editColumn('name', function ($permission) {
                // Get the permission enum case from the permission name
                $permissionEnum = collect(PermissionEnum::cases())->first(function ($case) use ($permission) {
                    return $case->value === $permission->name;
                });
                
                // If we found the enum case, use its display name, otherwise use the original name
                if ($permissionEnum) {
                    return $permissionEnum->getDisplayName(app()->getLocale());
                }
                
                return $permission->name;
            })
            ->addColumn('actions', function ($permission) {
                if (auth()->user()->hasPermissionTo(PermissionEnum::DELETE_PERMISSIONS->value)) {
                    return '<div class="text-start">
                                <a href="#" class="btn btn-danger btn-sm" data-id="' . $permission->id . '" data-kt-permissions-table-filter="delete_row">
                                    <i class="fas fa-trash"></i> ' . __('common.delete') . '
                                </a>
                            </div>';
                }
                return '';
            })
            ->editColumn('created_at', function ($permission) {
                return Carbon::parse($permission->created_at)->format('d M Y, h:i A');
            })
            ->rawColumns(['assigned_roles', 'actions'])
            ->make(true);
    }

    /**
     * @param StorePermissionRequest $request
     * @return JsonResponse
     */
    public function store(StorePermissionRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            Permission::create([
                'name' => $request->permission_name,
                'guard_name' => 'web'
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __('permissions.permission_created'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('common.operation_failed'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $permission = Permission::findOrFail($id);

            // Prevent delete if assigned to roles
            if ($permission->roles()->count() > 0) {
                return response()->json([
                    'message' => __('permissions.cannot_delete_assigned_permission')
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $permission->delete();

            return response()->json([
                'message' => __('permissions.permission_deleted'),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => __('common.not_found')
            ], Response::HTTP_NOT_FOUND);
        }
    }
}