<?php

namespace App\DataTables;

use App\Models\Pelanggan;
use Yajra\DataTables\Html\Button;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelangganDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('fkid_alamat_pelanggan', function(Pelanggan $pelanggan){
                return $pelanggan->alamat->alamat_detail;
            })
            ->addColumn('action', function ($row) {
                return '<a href="#" class="m-2 action" data-jenis="edit" data-id=' . $row->id_pelanggan . ' data-toggle="modal" data-placement="top">
                            <span class="badge badge-success"> <i style="color:(255,255,255)" class="fas fa-edit fa-1.5x" data-toggle="tooltip" data-placement="top" title="Ubah Data Pelanggan"></i></span>
                        </a>' .
                    '<a class="tombolhapus action" action" href="#" data-jenis="detail" data-id=' . $row->id_pelanggan . '>
                            <span class="badge badge-primary"> <i style="color:rgb(255,255,255)" class="fas fa-eye fa-1x" data-toggle="tooltip" data-placement="top" title="Detail Data Pelanggan"></i></span>
                        </a>' .
                    '<a class="tombolhapus m-2 action" href="#" data-jenis="delete" data-id=' . $row->id_pelanggan . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Data Pelanggan"></i></span>
                        </a>';
                // }
                // return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PelangganDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pelanggan $model): QueryBuilder
    {
        return $model->newQuery()->with(['alamat']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pelanggan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export')->className('btn btn-primary'),
                        Button::make('print')->className('btn btn-success'),
                        Button::make('reload')->className('btn btn-danger')->text('Reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id_pelanggan')->visible(false)->searchable(false)->printable(false),
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('nama_pelanggan')->width(50),
            Column::make('fkid_alamat_pelanggan')->title('Alamat Pelanggan')->data('alamat.alamat_detail')->name('alamat.alamat_detail')->width(50),
            // Print Column
            Column::make('fkid_alamat_pelanggan')->title('Alamat Pelanggan')->visible(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pelanggan_' . date('YmdHis');
    }
}
