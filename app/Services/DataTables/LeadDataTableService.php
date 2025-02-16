<?php

namespace App\Services\DataTables;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeadDataTableService extends DataTable
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
            ->editColumn('status', function ($query) {
                $labels = [
                    Lead::STATUS_NEW => '<span class="badge bg-secondary">New</span>',
                    Lead::STATUS_IN_PROGRESS => '<span class="badge bg-primary">In Progress</span>',
                    Lead::STATUS_CLOSED => '<span class="badge bg-success">Closed</span>',
                ];
                return $labels[$query->status] ?? '<span class="badge bg-dark">Unknown</span>';
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = 'CASE WHEN status = ? THEN "New" 
                           WHEN status = ? THEN "In Progress"
                           WHEN status = ? THEN "Closed" END like ?';
                $query->whereRaw($sql, [Lead::STATUS_NEW, Lead::STATUS_IN_PROGRESS, Lead::STATUS_CLOSED, "%{$keyword}%"]);
            })
            ->addColumn('action', 'admin.lead.action')
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lead $model): QueryBuilder
    {
        $user = User::find(Auth::id());

        return $model
            ->with('user:id,name')
            ->when($user->hasRole('sales'), function ($query) use ($user) {
                return $query->where('assigned_to', $user->id);
            })
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('leads-table')
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
        $user = User::find(Auth::id());
        $columns = [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Alamat Email'),
            Column::make('phone_number')->title('Nomor Telepon'),
            Column::make('status')->title('Status'),
        ];

        if (!$user->hasRole('sales')) {
            $columns[] = Column::make('assigned_to')
                ->data('user.name')
                ->title('Ditugaskan Kepada');
        }

        $columns[] = Column::computed('action')
            ->searchable(false)
            ->width(60)
            ->addClass('text-center hide-search');

        return $columns;
    }
}
