<?php

namespace App\Services\Imports;

use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadsImportService implements ToModel, WithBatchInserts, WithChunkReading, WithValidation, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Lead([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'status' => Lead::STATUS_NEW,
            'assigned_to' => Auth::id(),
        ]);
    }

    /**
     * @param array $rows
     *
     * @return array
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @param array $rows
     *
     * @return array
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return (new LeadRequest())->rules();
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return (new LeadRequest())->messages();
    }

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
