<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdminUser = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('crm12345'),
        ]);
        $superAdminUser->assignRole('super admin');

        // Manager
        $managerUser = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@mail.com',
            'password' => bcrypt('crm12345'),
        ]);
        $managerUser->assignRole('manager');

        // Staff
        $staffUser = User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => bcrypt('crm12345'),
        ]);
        $staffUser->assignRole('staff');

        // Sales
        $salesUser = User::factory()->create([
            'name' => 'Sales',
            'email' => 'sales@mail.com',
            'password' => bcrypt('crm12345'),
        ]);
        $salesUser->assignRole('sales');
    }
}
