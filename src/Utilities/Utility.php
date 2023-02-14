<?php

namespace RaisulHridoy\SimpleRolePermission\Utilities;

use RaisulHridoy\SimpleRolePermission\Models\Role;

class Utility
{
    /**
     * @return string
     */
    public static function getPackagePath(): string
    {
        return __DIR__ . '/../';
    }

    /**
     * @return string
     */
    public static function getPackageNamespace(): string
    {
        return __NAMESPACE__;
    }


    /**
     * @param $message
     * @return array
     */
    public static function successResponse($message,$data = []): array
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * @param $message
     * @return array
     */
    public static function errorResponse($message,$error = []): array
    {
        return [
            'status' => 'failed',
            'message' => $message,
            'error' => $error
        ];
    }

    /**
     * @param $role_name_or_slug
     * @param $permission_name_or_group
     * @return mixed
     */
    public static function rolePermissionCheck($role_name_or_slug, $permission_name_or_group){
            $role = Role::where('name',$role_name_or_slug)->orWhere('slug',$role_name_or_slug)->first();
            $permission = $role->permissions()->where('name',$permission_name_or_group)->orWhere('group',$permission_name_or_group)->first();
            return $permission;
    }


}
