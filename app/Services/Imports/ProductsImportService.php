<?php

namespace App\Services\Imports;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImportService implements ToModel, WithBatchInserts, WithChunkReading, WithValidation, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
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
        return (new ProductRequest())->rules();
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return (new ProductRequest())->messages();
    }

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
