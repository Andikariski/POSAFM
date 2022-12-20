<?php

namespace App\DataTables;

use App\Models\JenisProduk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JenisProdukDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', 'jenisproduk.action')
            ->addColumn('action', function ($row) {
                // $action = '';
                // if (Gate::allows('update role')) {
                return '<a href="#" class="m-3 action" data-jenis="edit" data-id=' . $row->id_jenis_produk . ' data-toggle="modal" data-placement="top">
                                <i style="color:rgb(41, 228, 94)" class="fas fa-edit fa-1x" data-toggle="tooltip" data-placement="top" title="Ubah jenis produk"></i>
                        </a>' .
                    '<a class="tombolhapus m-3 action" href="#" data-jenis="delete" data-id=' . $row->id_jenis_produk . '>
                                <i style="color:rgb(249, 37, 37)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus jenis produk"></i>
                        </a>';
                // }
                // return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\JenisProduk $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JenisProduk $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('jenis_produk')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('export')->className('btn btn-primary'),
                        Button::make('print')->className('btn btn-success'),
                        Button::make('reload')->className('btn btn-danger')->text('Reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id_jenis_produk')->visible(false)->searchable(false)->printable(false),
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30)->searchable(false),
            Column::make('kategori_produk'),
            // Column::make('updated_at'),
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
    protected function filename(): string
    {
        return 'JenisProduk_' . date('YmdHis');
    }
}
