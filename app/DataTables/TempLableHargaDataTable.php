<?php

namespace App\DataTables;

use App\Models\TempLableHarga;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TempLableHargaDataTable extends DataTable
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
        ->editColumn('harga_jual_produk', function(TempLableHarga $produk){
            return number_format($produk->harga_jual_produk);
        })
        ->addIndexColumn()
            ->addColumn('action', function ($row){
                return
                '<a class="btn-hapus m-1 action" href="#" data-jenis="delete" data-id=' . $row->barcode_produk . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Produk"></i></span>
                    </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TempLableHarga $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TempLableHarga $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('templableharga-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rt')
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
            Column::make('nama_produk'),
            Column::make('barcode_produk'),
            Column::make('harga_jual_produk'),
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
        return 'TempLableHarga_' . date('YmdHis');
    }
}
