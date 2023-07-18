<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PengurusDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('pondok_id', function ($user) {
                return $user->pondok->nama;
            })
            ->editColumn('role', function ($user) {
                return $user->getRoleNames()->first();
            })
            ->editColumn('action', function ($query) {
                $user = auth()->user();
                $edit = '<a href="' . route('pengurus.edit', $query->id) . '" type="button" class="m-1 btn btn-sm btn-warning">Edit</a>';
                $delete = '<button type="button" data-type="delete" data-id=' . $query->id . ' class="m-1 btn btn-sm btn-danger action">Delete</button>';
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';

            })
            ->addColumn('action', 'pengurus.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->role('pengurus');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengurus-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
        //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('email'),
            Column::make('pondok_id')->title('Pondok'),
            Column::make('role')->title('Jabatan'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengurus_' . date('YmdHis');
    }
}
