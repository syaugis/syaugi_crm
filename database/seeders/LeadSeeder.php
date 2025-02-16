<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = User::role('sales')->first();

        Lead::factory(5)->create([
            'assigned_to' => $sales->id,
        ]);
    }
}
