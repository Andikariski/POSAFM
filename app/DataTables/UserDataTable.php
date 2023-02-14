<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->escapeColumns([])
            ->editColumn('role', function(User $user){
                if($user->is_admin == 1){
                    return '<span class="badge bg-success font-17 text-white ml-1">'.'Admin'.'</span>';
                }else{
                    return '<span class="badge bg-danger font-17 text-white ml-1">'.'Karyawan'.'</span>';
                }
            })
            ->addColumn('action', function($row){
                return '<a href="#" class="m-2 action" data-jenis="edit" data-id=' . $row->id . ' data-toggle="modal" data-placement="top">
                            <span class="badge badge-success"> <i style="color:(255,255,255)" class="fas fa-edit fa-1.5x" data-toggle="tooltip" data-placement="top" title="Ubah Data Produk"></i></span>
                        </a>' .
                        '<a class="tombolhapus action" action" href="#" data-jenis="detail" data-id=' . $row->id . '>
                            <span class="badge badge-primary"> <i style="color:rgb(255,255,255)" class="fas fa-eye fa-1x" data-toggle="tooltip" data-placement="top" title="Detail Data Produk"></i></span>
                        </a>' .
                        '<a class="tombolhapus m-2 action" href="#" data-jenis="delete" data-id=' . $row->id . '>
                            <span class="badge badge-danger"><i style="color:rgb(255,255,255)" class="fas fa-trash fa-1x" data-toggle="tooltip" data-placement="top" title="Hapus Data Produk"></i></span>
                        </a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('userdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('name')->title('Nama User'),
            Column::make('email')->title('Email'),
            // Column::make('password')->title('Password'),
            Column::make('role')->title('Role User')->orderable(false)->searchable(false),
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
        return 'User_' . date('YmdHis');
    }
}
