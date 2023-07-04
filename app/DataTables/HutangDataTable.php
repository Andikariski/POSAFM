<?php

namespace App\DataTables;

use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HutangDataTable extends DataTable
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
            ->editColumn('hutang', function(TransaksiPenjualan $hutang){
                // $hutang->groupBy('fkid_pelanggan');
                // $totalPembayaran = TransaksiPenjualan::select('total_pembayaran',TransaksiPenjualan::raw('sum(total_pembayaran) as totalPembayaran'));
                $jumlahHutang = $hutang->total_pembayaran - $hutang->uang_terbayar;
                // return number_format($jumlahHutang);
                return number_format($jumlahHutang);
            })
            ->escapeColumns([])
            ->editColumn('action', function($row){
                return '<a class="mr-1 action" href="#" data-jenis="detail" data-id=' . Crypt::encrypt($row->faktur) . '>
                            <span class="badge badge-primary">
                                <i style="color:rgb(255,255,255); text-align:center" class="fas fa-eye fa-1x " data-toggle="tooltip" data-placement="top" title="Detail Transaksi"></i>
                            </span>
                        </a>'.
                        '<a class="m-1 action" href="#" data-jenis="bayar" data-id=' . Crypt::encrypt($row->faktur) . '>
                                <span class="badge badge-success"><i style="color:rgb(255,255,255)" class="fas fa-check fa-1x" data-toggle="tooltip" data-placement="top" title="Bayar Hutang"></i></span>
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
        return $model->newQuery()->where('status_transaksi','=','Belum Lunas')->groupBy('fkid_pelanggan')->with(['pelanggan','kasir']);
    }
    
    /**
    * Optional method if you want to use html builder.
    *
    * @return \Yajra\DataTables\Html\Builder
    */
    public function html()
    {
        return $this->builder()
                ->setTableId('hutang-table')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            // Column::make('faktur'),
            Column::make('')->title('Pelanggan')->data('pelanggan.nama_pelanggan')->name('pelanggan.nama_pelanggan'),
            Column::make('tanggal')->title('Tanggal'),
            Column::make('hutang')->title('Jumlah Hutang')->searchable(false)->orderable(false),
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
        return 'Hutang_' . date('YmdHis');
    }
}
