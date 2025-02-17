<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function create(array $data)
    {
        try {
            $project = $this->projectRepository->create($data);
            $project->lead->update(['status' => Lead::STATUS_IN_PROGRESS]);

            return $project;
        } catch (Exception $e) {
            Log::error('Error when creating project: ' . $e->getMessage());

            return ['error' => 'Terjadi kesalahan saat membuat proyek'];
        }
    }

    public function update(array $data, $project, $user)
    {
        try {
            if (isset($data['status']) && $data['status'] == Project::STATUS_APPROVED) {
                $data['approved_by'] = $user->id;
                $customer = $project->lead?->customer;

                if (!$customer) {
                    $customer = Customer::create([
                        'lead_id' => $project->lead_id,
                        'name' => $project->lead->name,
                        'email' => $project->lead->email,
                        'phone_number' => $project->lead->phone_number
                    ]);
                }

                $customer->products()->attach($project->product_id);

                $project->lead->update([
                    'status' => Lead::STATUS_CLOSED
                ]);
            }

            return $this->projectRepository->update($data, $project);
        } catch (Exception $e) {
            Log::error('Error when updating project: ' . $e->getMessage());

            return ['error' => 'Terjadi kesalahan saat memperbarui proyek'];
        }
    }
}
