<?php

use Illuminate\Support\Facades\Route;

Route::controller(\RaisulHridoy\SimpleRolePermission\Http\App\SRP::class)->group(function () {
    //Route::get('srp/{role_id}', 'assignedPermissions');
});
