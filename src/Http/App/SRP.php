<?php

namespace RaisulHridoy\SimpleRolePermission\Http\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use RaisulHridoy\SimpleRolePermission\Models\Permission;
use RaisulHridoy\SimpleRolePermission\Models\Role;
use RaisulHridoy\SimpleRolePermission\Models\RoleHasPermission;
use RaisulHridoy\SimpleRolePermission\Utilities\Utility;

class SRP extends Controller
{
    /**
     * @param $role_name
     * @return array
     */
    public function createRole($role_name = null): array
    {
        try {
            if ($role_name == null) {
                return Utility::errorResponse('Role name is required');
            }
            if (Role::where('name', $role_name)->first()) {
                return Utility::errorResponse('Role already exists');
            }
            $role = new Role();
            $role->name = $role_name;
            $role->slug = Str::slug($role_name);
            $role->identifier = rand(100000, 999999);
            $role->save();
            return Utility::successResponse('Role created successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @param $role_name
     * @return array
     */
    public function updateRole($role_id = null, $role_name = null): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            if ($role_name == null) {
                return Utility::errorResponse('Role name is required');
            }
            $role = Role::find($role_id);
            if (!$role) {
                return Utility::errorResponse('Role not found');
            }
            $role->name = $role_name;
            $role->slug = Str::slug($role_name);
            $role->save();
            return Utility::successResponse('Role updated successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @return array
     */
    public function deleteRole($role_id = null): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            $role = Role::find($role_id);
            if (!$role) {
                return Utility::errorResponse('Role not found');
            }
            RoleHasPermission::where('role_id', $role_id)->delete();
            $role->delete();
            return Utility::successResponse('Role deleted successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @param array $permissionIDs
     * @return array
     */
    public function syncPermission($role_id = null, array $permissionIDs = []): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            RoleHasPermission::where('role_id', $role_id)->delete();
            if (count($permissionIDs) > 0) {
                $syncedPermission = [];
                foreach ($permissionIDs as $permissionID){
                    $syncedPermission[] = [
                        'role_id' => $role_id,
                        'permission_id' => $permissionID
                    ];
                }
                RoleHasPermission::insert($syncedPermission);
            }
            return Utility::successResponse('Permission assigned successfully',$permissionIDs);
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @return array
     */
    public function assignedPermissions($role_id = null): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            $permissions = RoleHasPermission::where('role_id', $role_id)
                ->rightJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->select('role_has_permissions.permission_id', 'permissions.name','role_has_permissions.created_at as assigned_at')
                ->get();
            return Utility::successResponse('Assigned permissions', $permissions);
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @return array
     */
    public function assignedPermissionsGroup($role_id = null): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            $permissions = RoleHasPermission::where('role_id', $role_id)
                ->rightJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->select('permissions.group', 'role_has_permissions.permission_id', 'permissions.name','role_has_permissions.created_at as assigned_at')
                ->get()->groupBy('group');

            return Utility::successResponse('Assigned permissions', $permissions);
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $role_id
     * @return array
     */
    public function assignedPermissionIDs($role_id = null): array
    {
        try {
            if ($role_id == null) {
                return Utility::errorResponse('Role id is required');
            }
            $permissions = RoleHasPermission::where('role_id', $role_id)->pluck('permission_id')->toArray();
            return Utility::successResponse('Assigned permissions', $permissions);
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $permission_name
     * @param $permission_group
     * @return array
     */
    public function createPermission($permission_name = null, $permission_group = null): array
    {
        try {
            if ($permission_name == null) {
                return Utility::errorResponse('Permission name is required');
            }
            if (Permission::where('name', $permission_name)->first()) {
                return Utility::errorResponse('Permission already exists');
            }
            $permission = new Permission();
            $permission->name = $permission_name;
            $permission->group = $permission_group;
            $permission->save();
            return Utility::successResponse('Permission created successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $permission_id
     * @param $permission_name
     * @param $permission_group
     * @return array
     */
    public function updatePermission($permission_id = null, $permission_name = null, $permission_group = null): array
    {
        try {
            if ($permission_id == null) {
                return Utility::errorResponse('Permission id is required');
            }
            if ($permission_name == null) {
                return Utility::errorResponse('Permission name is required');
            }
            $permission = Permission::find($permission_id);
            if (!$permission) {
                return Utility::errorResponse('Permission not found');
            }
            $permission->name = $permission_name;
            $permission->group = $permission_group ?? $permission->group;
            $permission->save();
            return Utility::successResponse('Permission updated successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $permission_id
     * @return array
     */
    public function deletePermission($permission_id = null): array
    {
        try {
            if ($permission_id == null) {
                return Utility::errorResponse('Permission id is required');
            }
            $permission = Permission::find($permission_id);
            if (!$permission) {
                return Utility::errorResponse('Permission not found');
            }
            RoleHasPermission::where('permission_id', $permission_id)->delete();
            $permission->delete();
            return Utility::successResponse('Permission deleted successfully');
        } catch (\Exception $e) {
            return Utility::errorResponse($e->getMessage());
        }
    }

    /**
     * @param $permission_name
     * @param $role_id
     * @return bool
     */
    public function checkPermissionByName($permission_name = null, $role_id = null): bool
    {
        try {
            $permission = RoleHasPermission::where('role_id', $role_id)
                ->whereHas('permission', function ($query) use ($permission_name) {
                    $query->where('name', $permission_name);
                })->first();
            if (!$permission) {
                return false;
            } else {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $permission_id
     * @param $role_id
     * @return bool
     */
    public function checkPermissionByID($permission_id = null, $role_id = null): bool
    {
        try {
            $permission = RoleHasPermission::where(['role_id' => $role_id, 'permission_id' => $permission_id])->first();
            if (!$permission) {
                return false;
            } else {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }






}
