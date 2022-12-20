<?php

namespace App\DataTables;

use App\Models\TempTransaksiPenjualan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\Produk;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TempTransaksiDatatable extends DataTable
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
            ->editColumn('harga_produk', function(TempTransaksiPenjualan $temp){
                return number_format($temp->produk->harga_jual_produk);
            })
            ->editColumn('sub_total', function(TempTransaksiPenjualan $produk){
                return number_format($produk->sub_total);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return 
                    '<a href="#" class="m-1 action" data-jenis="tambahJumlah" data-id=' . $row->id_temp_transaksi_penjualan . ' data-toggle="modal" data-placement="top">
                            <span class="badge badge-success"> <i style="color:(255,255,255)" class="fas fa-plus fa-1.5x" data-toggle="tooltip" data-placement="top" title="Tambah Produk"></i></span>
                        </a>' .
                    '<a class="btn-hapus m-1 action" href="#" data-jenis="delete" data-id=' . $row->id_temp_transaksi_penjualan . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Produk"></i></span>
                    </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TempTransaksiDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TempTransaksiPenjualan $model)
    {
        return $model->newQuery()->with(['pelanggan','kasir','produk']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('temptransaksi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('fkid_barcode_produk')->Title('Nama Produk')->data('produk.nama_produk')->name('produk.nama_produk')->orderable(false),
            Column::make('harga_produk')->Title('Harga Satuan')->orderable(false),
            Column::make('jumlah_produk')->title('Jumlah(Qty)')->orderable(false),
            Column::make('sub_total')->title('Sub Total')->orderable(false),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
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
        return 'TempTransaksi_' . date('YmdHis');
    }
}
