<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            UserSeeder::class,
         	DataProviderSeeder::class,
         	VisibilityTypeSeeder::class,
         	RoleSeeder::class,
         	PermissionSeeder::class,
         	UserRoleSeeder::class,
         	UserPermissionSeeder::class,
         	RolesPermissionsSeeder::class,
         ]);
    }
}
