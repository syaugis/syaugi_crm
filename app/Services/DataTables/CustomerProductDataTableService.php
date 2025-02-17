<?php

namespace App\Services\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerProductDataTableService extends DataTable
{
    private $customerId;

    public function withCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('product_name', function ($product) {
                return $product->name;
            })
            ->addColumn('action', 'admin.product.action-show')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->whereHas('customers', function ($query) {
            $query->where('customer_id', $this->customerId);
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customer_product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('product_name')->title('Nama Produk'),
            Column::computed('action')
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];
    }
}
