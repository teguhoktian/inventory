<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('status', function(User $user){
                if($user->status == 'active'){
                    return '<span class="label label-success">'. __('Aktif') .'</span>';
                }else{
                    return '<span class="label label-warning">'. __('Non-Aktif') .'</span>';
                }
            })
            ->addColumn('action', 'user.action')
            ->addColumn('role', function(User $user){
                return '<span class="btn btn-xs btn-info">' . $user->roles->pluck('name')->implode(', ') . '</span>';
            })
            ->addColumn('kantor_cabang', function(User $user){
                return $user->kantorCabangs->map(function ($kantorCabang) {
                    return '<span class="label label-success">' . e($kantorCabang->nama) . '</span>';
                })->implode(' ');  
            })
            ->rawColumns(['action', 'role', 'status', 'kantor_cabang'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
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
                    ->parameters([
                        'responsive' => true
                    ])
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
            // Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('username'),
            Column::computed('status'),
            Column::computed('role'),
            Column::computed('kantor_cabang'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'Users_' . date('YmdHis');
    }
}
