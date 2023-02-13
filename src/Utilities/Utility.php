<?php

namespace RaisulHridoy\SimpleRolePermission\Utilities;

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


}
