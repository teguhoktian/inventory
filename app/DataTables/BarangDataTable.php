<?php

namespace App\DataTables;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BarangDataTable extends DataTable
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
        ->addColumn('jenis_barang', function ($row) {
            return $row->jenis?->nama;
        })
        ->addColumn('harga_akhir', function ($row) {
            $lastStok = $row->stoks->last();
            return number_format($lastStok?->harga ?? 0, 0);
        })
        ->addColumn('posisi_kas', function ($row) {
            return number_format($row->saldo_masuk - $row->saldo_keluar, 0);
        })
        ->addColumn('satuan', function ($row) {
            return $row->satuan?->nama;
        })
        ->addColumn('action', function ($row) {
            return view('barang.action', [
                'id' => $row->id,
                'hasLastStok' => $row->stoks->last() !== null
            ]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Barang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Barang $model)
    {
        // return $model->newQuery();
        return $model->with(['stoks', 'jenis', 'satuan'])
        ->withCount([
            'stoks as saldo_masuk' => function ($query) {
                $query->select(DB::raw('SUM(jumlah * harga)'))->where('tipe', 'Masuk');
            },
            'stoks as saldo_keluar' => function ($query) {
                $query->select(DB::raw('SUM(jumlah * harga)'))->where('tipe', 'Keluar');
            }
        ])
        ->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->parameters([
            'responsive' => true
        ])
                    ->setTableId('barang-table')
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
            Column::make('kode'),
            Column::make('nama'),
            Column::make('jenis_barang'),
            Column::make('harga_akhir'),
            Column::make('satuan'),
            Column::make('stok'),
            Column::make('posisi_kas'),
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
        return 'Barang_' . date('YmdHis');
    }
}
