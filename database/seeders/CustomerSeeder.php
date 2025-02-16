<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvedProjects = Project::where('status', Project::STATUS_APPROVED)->get();

        foreach ($approvedProjects as $project) {
            $customer = Customer::create([
                'name' => $project->lead->name,
                'email' => $project->lead->email,
                'phone_number' => $project->lead->phone_number,
            ]);

            $customer->products()->attach($project->product_id);
        }
    }
}
