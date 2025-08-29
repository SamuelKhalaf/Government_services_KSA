<?php

namespace App\Http\Controllers\admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.users.index', compact('roles'));
    }

    public function getUsersDatatable()
    {
        $users = User::select('id', 'name', 'email', 'phone_number', 'status', 'national_id', 'preferred_language', 'last_login_at', 'created_at')
            ->with('roles')
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                $actions = '';

                if (auth()->user()->hasAnyPermission([PermissionEnum::UPDATE_USERS, PermissionEnum::DELETE_USERS])) {
                    $actions = '<a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    ' . __('common.actions') . '
                                    <span class="svg-icon svg-icon-5 m-0">
                                       <i class="fa-solid fa-angle-down"></i>
                                   </span>
                                </a>';

                    $actions .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">';

                    if (auth()->user()->hasPermissionTo(PermissionEnum::UPDATE_USERS)) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-user-id="' . $user->id . '" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">
                                ' . __('common.edit') . '
                            </a>
                        </div>';
                    }

                    if (auth()->user()->hasPermissionTo(PermissionEnum::DELETE_USERS)) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row"
                               data-user-id="' . $user->id . '">' . __('common.delete') . '</a>
                        </div>';
                    }

                    $actions .= '</div>';
                }
                return $actions;
            })
            ->addColumn('role', function ($user) {
                $role = $user->roles->first();
                if ($role) {
                    $color = $role->name === 'admin' ? 'primary' : 'info';
                    return '<span class="badge badge-light-' . $color . ' fs-7">' . __('roles.' . $role->name) . '</span>';
                }
                return '<span class="badge badge-light-secondary fs-7">' . __('users.no_role') . '</span>';
            })
            ->addColumn('status', function ($user) {
                $color = $user->status === 'active' ? 'success' : 'danger';
                $text = __('users.' .$user->status);
                return '<span class="badge badge-light-' . $color . ' fs-7">' . $text . '</span>';
            })
            ->addColumn('last_login', function ($user) {
                if ($user->last_login_at) {
                    return $user->last_login_at->diffForHumans();
                }
                return __('users.never_logged_in');
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->rawColumns(['actions', 'role', 'status'])
            ->make(true);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'national_id' => $request->national_id ?? null,
                'status' => $request->status ?? 'active',
                'preferred_language' => $request->preferred_language ?? 'ar',
                'address' => $request->address ?? null,
                'created_by' => auth()->id(),
            ]);

            $user->assignRole($request->role);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __('users.user_created'),
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('common.error_occurred')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(int $id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->json(['error' => __('users.user_not_found')], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'id'                => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'phone_number'      => $user->phone_number,
            'national_id'       => $user->national_id,
            'status'            => $user->status,
            'preferred_language' => $user->preferred_language,
            'address'           => $user->address,
            'role'              => $user->roles->first()?->name
        ]);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => __('users.user_not_found')], Response::HTTP_NOT_FOUND);
            }

            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'national_id' => $request->national_id,
                'status' => $request->status,
                'preferred_language' => $request->preferred_language,
                'address' => $request->address,
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            $user->syncRoles([$request->role]);

            DB::commit();

            return response()->json(['message' => __('users.user_updated')]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => __('common.error_occurred')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => __('users.user_not_found')], Response::HTTP_NOT_FOUND);
            }

            $user->syncRoles([]);
            $user->delete();

            DB::commit();

            return response()->json(['success' => true, 'message' => __('users.user_deleted')]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => __('common.operation_failed')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
