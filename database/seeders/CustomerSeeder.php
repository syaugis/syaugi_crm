<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Lead;
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
                'lead_id' => $project->lead_id,
                'name' => $project->lead->name,
                'email' => $project->lead->email,
                'phone_number' => $project->lead->phone_number,
            ]);

            $project->lead->update([
                'status' => Lead::STATUS_CLOSED,
            ]);
            $customer->products()->attach($project->product_id);
        }
    }
}
