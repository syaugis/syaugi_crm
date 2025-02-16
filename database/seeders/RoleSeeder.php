<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super admin']);
        $manager = Role::create(['name' => 'manager']);
        $staff = Role::create(['name' => 'staff']);
        $sales = Role::create(['name' => 'sales']);

        // Permissions
        $permissions = [
            'manage users',
            'manage leads',
            'manage products',
            'manage projects',
            'manage customers'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign Permissions
        $superAdmin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['manage leads', 'manage products', 'manage projects', 'manage customers']);
        $staff->givePermissionTo(['manage leads', 'manage products', 'manage customers']);
        $sales->givePermissionTo(['manage leads']);
    }
}
