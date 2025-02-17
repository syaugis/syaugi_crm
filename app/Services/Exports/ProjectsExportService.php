<?php

namespace App\Services\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;

class ProjectsExportService implements FromQuery, WithCustomChunkSize, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return Project::query()->with([
            'lead:id,name',
            'product:id,name',
            'approver:id,name'
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Calon Pelanggan',
            'Nama Produk',
            'Status',
            'Disetujui Oleh',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }

    /**
     * @param mixed $project
     * @return array
     */
    public function map($project): array
    {
        return [
            $project->id,
            $project->lead->name,
            $project->product->name,
            $project->formatted_status,
            $project->approver->name ?? '-',
            $project->created_at,
            $project->updated_at
        ];
    }
}
