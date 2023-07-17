<?php

namespace App\DataTables;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SiswaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('pondok_id', function ($data) {
                return $data->pondok->nama ?? '-';
            })
            ->editColumn('jurusan', function ($data) {
                return $data->jurusan == 'IIS' ? 'Ilmu-Ilmu Sosial' : ($data->jurusan == 'MIPA' ? 'Matematika dan Ilmu Pengetahuan Alam' : ($data->jurusan == 'IBB' ? 'Ilmu Bahasa dan Budaya' : 'Ilmu Kesenian'));
            })
            ->editColumn('wali_id', function ($data) {
                return $data->wali->name ?? '-';
            })

            ->editColumn('action', function ($query) {
                $user = auth()->user();
                $button = '';
                $button .= '<a href="' . route('siswa.show', $query->nis) . '" type="button" class="btn btn-sm btn-primary">Show</a>';
                //check role only admin
                if ($user->getRoleNames()->first() == 'admin') {

                    $button .= '<a href="' . route('siswa.edit', $query->nis) . '" type="button" class="m-1 btn btn-sm btn-warning">Edit</a>';
                    $button .= '<button type="button" data-type="delete" data-id=' . $query->nis . ' class="m-1 btn btn-sm btn-danger action">Delete</button>';
                }
                return $button;

            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Siswa $model): QueryBuilder
    {
        $user = auth()->user();
        if ($user->getRoleNames()->first() == 'pengurus') {
            return $model->newQuery()->where('pondok_id', $user->pondok_id);
        } elseif ($user->getRoleNames()->first() == 'wali') {
            return $model->newQuery()->where('wali_id', $user->id);
        }
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('siswa-table')
            ->columns($this->getColumns())
        // ->minifiedAjax()
            ->autoWidth(false)
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
            Column::make('nama'),
            Column::make('nis')->title('NIS'),
            Column::make('kelas'),
            Column::make('jurusan'),
            Column::make('jenis_kelamin'),
            Column::make('alamat'),
            Column::make('pondok_id')->title('Alamat Pondok'),
            Column::make('wali_id')->title('Wali'),
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
        return 'Siswa_' . date('YmdHis');
    }
}
