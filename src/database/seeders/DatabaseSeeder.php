<?php

namespace RaisulHridoy\SimpleRolePermission\database\seeders;

use Illuminate\Database\Seeder;
use RaisulHridoy\SimpleRolePermission\database\seeders\DefaultSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultSeeder::class);
    }
}
