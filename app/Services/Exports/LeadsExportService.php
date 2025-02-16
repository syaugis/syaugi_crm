<?php

namespace App\Services\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;

class LeadsExportService implements FromQuery, WithCustomChunkSize, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return Lead::query()->with('user');
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
            'Nama',
            'Email',
            'Nomor Telepon',
            'Status',
            'Ditugaskan Kepada',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }

    /**
     * @param mixed $lead
     * @return array
     */
    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->name,
            $lead->email,
            $lead->phone_number,
            $lead->formatted_status,
            $lead->user->name,
            $lead->created_at,
            $lead->updated_at,
        ];
    }
}
