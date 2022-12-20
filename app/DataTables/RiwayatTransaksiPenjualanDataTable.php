<?php

namespace App\DataTables;

use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RiwayatTransaksiPenjualanDataTable extends DataTable
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
            ->editColumn('tanggal', function(TransaksiPenjualan $transaksi){
                    return  \Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->tanggal)->isoFormat('D MMMM YYYY');
            })
            ->editColumn('status', function(TransaksiPenjualan $status){
                    if($status->total_pembayaran <= $status->uang_terbayar){
                        return '<span class="badge bg-success font-15 text-white ml-2">'.'Lunas'.'</span>';
                    }else{
                        return '<span class="badge bg-danger font-15 text-white ml-2">'.'Belum Lunas'.'</span>';
                    }
            })
            ->escapeColumns([])
            ->editColumn('action', function($row){
                return '<a class="" href=' ."detail-riwayat".'/'. Crypt::encrypt($row->faktur).'">
                            <span class="badge badge-primary">
                                <i style="color:rgb(255,255,255); text-align:center" class="fas fa-eye fa-1x " data-toggle="tooltip" data-placement="top" title="Detail Transaksi"></i>
                            </span>
                        </a>'.
                        '<a class="tombolhapus m-2 action" href="#" data-jenis="delete" data-id=' . Crypt::encrypt($row->faktur) . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Data Pelanggan"></i></span>
                        </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RiwayatTransaksiPenjualanDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TransaksiPenjualan $model)
    {
        return $model->newQuery()->with(['pelanggan','kasir']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('riwayattransaksipenjualan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('faktur'),
            Column::make('')->title('Pelanggan')->data('pelanggan.nama_pelanggan')->name('pelanggan.nama_pelanggan'),
            // Column::make('tanggal'),
            Column::make('status')->title('Status')->searchable(false)->orderable(false)->print(false),
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
        return 'RiwayatTransaksiPenjualan_' . date('YmdHis');
    }
}
