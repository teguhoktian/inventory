<?php

namespace App\DataTables;

use App\Models\StokOpnameBarang;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StokOpnameBarangDataTable extends DataTable
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
            ->rawColumns(['action', 'status'])
            ->addColumn('status', function(StokOpnameBarang $stokOpnameBarang){
               if($stokOpnameBarang->status == 'Selesai'){
                return '<span class="label label-success">Selesai</span>';
               }elseif($stokOpnameBarang->status == 'Batal'){
                return '<span class="label label-danger">Batal</span>';
               }else{
                return '<span class="label label-warning">Open</span>';
               }
            })
            ->addColumn('petugas', function(StokOpnameBarang $stokOpnameBarang){
                return $stokOpnameBarang->user?->name;
             })
            ->addColumn('action', 'stokOpnameBarang.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StokOpnameBarang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StokOpnameBarang $model)
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
                    ->setTableId('stokopnamebarang-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')  
                    ->orderBy(0)
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
            Column::make('tanggal'),
            Column::make('kode'),
            Column::make('nama'),
            Column::make('petugas'),
            Column::make('status')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
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
    protected function filename()
    {
        return 'StokOpnameBarang_' . date('YmdHis');
    }
}
