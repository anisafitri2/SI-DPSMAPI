<?php

namespace App\DataTables;

use App\Models\Pelanggaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PelanggaranDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('siswa_id', function ($pelanggaran) {
                return $pelanggaran->siswa->nama;
            })
            ->editColumn('kategori', function ($data) {
                // check data kategori ringan , sedang , berat berikan span warna hijau , kuning , merah
                if ($data->kategori == 'ringan') {
                    return '<span class="badge badge-success">' . $data->kategori . '</span>';
                } elseif ($data->kategori == 'sedang') {
                    return '<span class="badge badge-warning">' . $data->kategori . '</span>';
                } elseif ($data->kategori == 'berat') {
                    return '<span class="badge badge-danger">' . $data->kategori . '</span>';
                }
            })
            ->editColumn('action', function ($query) {
                $user = auth()->user();
                $button = '';
                $button .= '<a href="#" type="button" class="btn btn-sm btn-primary">Show</a>';
                //check role only admin
                if ($user->getRoleNames()->first() == 'admin') {

                    $button .= '<a href="' . route('pelanggaran.edit', $query->id) . '" type="button" class="m-1 btn btn-sm btn-warning">Edit</a>';
                    $button .= '<button type="button" data-type="delete" data-id=' . $query->id . ' class="m-1 btn btn-sm btn-danger action">Delete</button>';
                }
                return $button;

            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pelanggaran $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pelanggaran-table')
            ->columns($this->getColumns())
        // ->minifiedAjax()
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
            Column::make('siswa_id')->title('Nama Siswa'),
            Column::make('nama_pelanggaran'),
            Column::make('keterangan'),
            Column::make('tanggal'),
            Column::make('kategori'),
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
        return 'Pelanggaran_' . date('YmdHis');
    }
}
