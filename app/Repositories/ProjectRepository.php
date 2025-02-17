<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function create($data): Project
    {
        $project = new $this->project;
        $project->lead_id = $data['lead_id'];
        $project->product_id = $data['product_id'];
        $project->status = $data['status'];
        $project->approved_by = $data['approved_by'] ?? null;
        $project->save();

        return $project;
    }

    public function update($data, $project): Project
    {
        $project->update($data);

        return $project;
    }
}
