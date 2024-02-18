<?php

namespace App\DataTables;

use App\Models\Produk;
use Milon\Barcode\DNS1D;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProdukDataTable extends DataTable
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
            ->editColumn('harga_jual_produk', function(Produk $produk){
                return number_format($produk->harga_jual_produk);
            })
            ->editColumn('nama_produk',function(Produk $namaProduk){
                return strtoupper($namaProduk['nama_produk']);
            })
            // ->editColumn('barcode_produk', function(Produk $barcodeProduk){
            //     return '{{!! DNS1D::getBarcodeHTML("'.$barcodeProduk['barcode_produk'].'",'. 'PHARMA'.',2,50) !!}}';
            //     // return '<img src="data:image/png,' . 'DNS1D::getBarcodePNG('."4".', '."C39+".')' . '" alt="barcode"   />';
            // })
            ->addIndexColumn()
            ->addColumn('fkid_tempat_produk', function(Produk $produk){
                return $produk->tempatproduk->kode_rak;
            })
            ->addColumn('action', function($row){
                return '<a href="#" class="m-2 action" data-jenis="edit" data-id=' . $row->barcode_produk . ' data-toggle="modal" data-placement="top">
                            <span class="badge badge-success"> <i style="color:(255,255,255)" class="fas fa-edit fa-1.5x" data-toggle="tooltip" data-placement="top" title="Ubah Data Produk"></i></span>
                        </a>' .
                    '<a class="tombolhapus action" action" href="#" data-jenis="detail" data-id=' . $row->barcode_produk . '>
                            <span class="badge badge-primary"> <i style="color:rgb(255,255,255)" class="fas fa-eye fa-1x" data-toggle="tooltip" data-placement="top" title="Detail Data Produk"></i></span>
                        </a>' .
                    '<a class="tombolhapus m-2 action" href="#" data-jenis="delete" data-id=' . $row->barcode_produk . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Data Produk"></i></span>
                        </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProdukDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Produk $model)
    {
        return $model->newQuery()->with(['kategori','tempatproduk'])->orderBy('nama_produk','asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('produk-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('frtip')
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
            // Column::make('id_produk')->visible(false)->searchable(false)->printable(false),
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('nama_produk')->orderable(true),
            // Column::make('barcode_produk')->title('Barcode Produk'),
            // Column::make('')->title('Jenis Produk')->data('kategori.kategori_produk')->name('kategori.kategori_produk')->width(50),
            Column::make('harga_jual_produk')->title('Harga Produk')->width(50),
            Column::make('stok_produk')->width(50),
            Column::make('')->title('Tempat Produk')->data('tempatproduk.kode_rak')->name('tempatproduk.kode_rak')->width(20)->printable(false),
            // Column::make('id_jenis_produk')->title('Jenis Barang')->data('kategoriProduk.kategori_barang')->name('kategoriProduk.kategori_barang'),
            Column::make('fkid_tempat_produk')->visible(false)->title('Tempat Produk'),
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
        return 'Produk_' . date('YmdHis');
    }
}
