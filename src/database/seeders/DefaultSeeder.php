<?php

namespace RaisulHridoy\SimpleRolePermission\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use RaisulHridoy\SimpleRolePermission\Models\Permission;
use RaisulHridoy\SimpleRolePermission\Models\Role;
use RaisulHridoy\SimpleRolePermission\Models\RoleHasPermission;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'identifier' => rand(1000000,9999999)
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'identifier' => rand(100000,999999)
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'identifier' => rand(10000,99999)
            ],
        ]);
        Permission::insert([
            [
                'name' => 'Dashboard',
                'group'=> 'dashboard'
            ],
            [
                'name' => 'User',
                'group'=> 'user'
            ],
            [
                'name' => 'Role',
                'group'=> 'role'
            ],
            [
                'name' => 'Permission',
                'group'=> 'role'
            ],
            [
                'name' => 'Settings',
                'group'=> 'setting'
            ],
        ]);

        RoleHasPermission::insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'permission_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'permission_id' => 2,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'permission_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'permission_id' => 4,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 3,
                'permission_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'role_id' => 3,
                'permission_id' => 2,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
