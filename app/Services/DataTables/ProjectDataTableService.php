<?php

namespace App\Services\DataTables;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTableService extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('approved_by', function ($query) {
                return $query->approver->name ?? 'Belum disetujui';
            })
            ->editColumn('status', function ($query) {
                $labels = [
                    Project::STATUS_PENDING  => '<span class="badge bg-secondary">Pending</span>',
                    Project::STATUS_APPROVED => '<span class="badge bg-success">Approved</span>',
                    Project::STATUS_REJECTED => '<span class="badge bg-danger">Rejected</span>'
                ];
                return $labels[$query->status] ?? '<span class="badge bg-dark">Unknown</span>';
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = 'CASE WHEN status = ? THEN "Pending" 
                           WHEN status = ? THEN "Approved"
                           WHEN status = ? THEN "Rejected" END like ?';
                $query->whereRaw($sql, [Project::STATUS_PENDING,  Project::STATUS_APPROVED,  Project::STATUS_REJECTED, "%{$keyword}%"]);
            })
            ->addColumn('action', 'admin.project.action')
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Project $model): QueryBuilder
    {
        return $model
            ->with([
                'lead:id,name',
                'product:id,name',
                'approver:id,name'
            ])
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('projects-table')
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
            Column::make('lead_id')
                ->title('Nama Pelanggan')
                ->data('lead.name')
                ->name('lead.name'),
            Column::make('product_id')
                ->title('Nama Produk')
                ->data('product.name')
                ->name('product.name'),
            Column::make('status')->title('Status'),
            Column::make('approved_by')
                ->title('Disetujui Oleh')
                ->orderable(false),
            Column::computed('action')
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];
    }
}
