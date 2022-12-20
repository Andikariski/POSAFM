<?php

namespace App\DataTables;

use App\Models\PelangganPLN;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelangganPLNDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                // $action = '';
                // if (Gate::allows('update role')) {
                return '<a href="#" class="m-2 action" data-jenis="edit" data-id=' . $row->id_pelanggan_pln . ' data-toggle="modal" data-placement="top">
                            <span class="badge badge-success"> <i style="color:(255,255,255)" class="fas fa-edit fa-1.5x" data-toggle="tooltip" data-placement="top" title="Ubah Data Pelanggan"></i></span>
                        </a>' .
                        '<a class="tombolhapus action" action" href="#" data-jenis="detail" data-id=' . $row->id_pelanggan_pln . '>
                            <span class="badge badge-primary"> <i style="color:rgb(255,255,255)" class="fas fa-eye fa-1x" data-toggle="tooltip" data-placement="top" title="Detail Data Pelanggan"></i></span>
                        </a>' .
                        '<a class="tombolhapus m-2 action" href="#" data-jenis="delete" data-id=' . $row->id_pelanggan_pln . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Data Pelanggan"></i></span>
                        </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PelangganPLNDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PelangganPLN $model)
    {
        return $model->newQuery()->with(['nama']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pelangganpln-table')
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
            Column::make('id_pelanggan_pln')->visible(false)->searchable(false)->printable(false),
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('id_pelanggan')->title('Nama Pelanggan')->data('nama.nama_pelanggan')->name('nama.nama_pelanggan')->width(200),
            Column::make('nomer_pelanggan_pln')->title('ID PLN'),
            // Column::make('id_pelanggan')->title('No Hp')->data('nama.nomer_hp')->name('nama.nomer_hp'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'PelangganPLN_' . date('YmdHis');
    }
}
