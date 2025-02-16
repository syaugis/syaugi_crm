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
        $models = ['project', 'lead', 'product', 'customer', 'user'];
        $actions = ['view_any', 'view', 'create', 'update', 'delete', 'restore', 'force_delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$action}_{$model}"]);
            }
        }

        // Assign Permissions
        $superAdmin->givePermissionTo(Permission::all());
        $manager->givePermissionTo([
            'view_any_project',
            'view_project',
            'create_project',
            'update_project',
            'delete_project',
            'view_any_lead',
            'view_lead',
            'create_lead',
            'update_lead',
            'delete_lead',
            'view_any_product',
            'view_product',
            'create_product',
            'update_product',
            'delete_product',
            'view_any_customer',
            'view_customer',
            'create_customer',
            'update_customer',
            'delete_customer',
            'view_any_user',
            'view_user',
            'create_user',
            'update_user',
            'delete_user',
        ]);
        $staff->givePermissionTo([
            'view_any_project',
            'view_project',
            'view_any_lead',
            'view_lead',
            'create_lead',
            'update_lead',
            'delete_lead',
            'view_any_product',
            'view_product',
            'create_product',
            'update_product',
            'delete_product',
            'view_any_customer',
            'view_customer',
            'create_customer',
            'update_customer',
            'delete_customer',
        ]);
        $sales->givePermissionTo([
            'view_any_lead',
            'view_lead',
            'create_lead',
            'update_lead',
            'delete_lead',
        ]);
    }
}
