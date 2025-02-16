<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::role('manager')->first();
        $leads = Lead::all();

        foreach ($leads as $lead) {
            $status = rand(0, 1);

            Project::create([
                'lead_id' => $lead->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'status' => $status,
                'approved_by' => $status == Project::STATUS_APPROVED ? $manager->id : null
            ]);
        }
    }
}
