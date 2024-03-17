<?php

namespace App\Observers;

use App\Models\BarangMasukDetail;

class BarangMasukDetailObserver
{
    /**
     * Handle the BarangMasukDetail "created" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function created(BarangMasukDetail $barangMasukDetail)
    {
        $barang = $barangMasukDetail->barang;
        $barang->stok += $barangMasukDetail->quantity;
        $barang->save();
    }

    /**
     * Handle the BarangMasukDetail "updated" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function updated(BarangMasukDetail $barangMasukDetail)
    {
        //
    }

    /**
     * Handle the BarangMasukDetail "deleted" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function deleted(BarangMasukDetail $barangMasukDetail)
    {
        //
        $barang = \App\Models\Barang::find($barangMasukDetail->id_barang);
        $barang->stok -= $barangMasukDetail->quantity;
        $barang->save();
    }

    /**
     * Handle the BarangMasukDetail "restored" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function restored(BarangMasukDetail $barangMasukDetail)
    {
        //
    }

    /**
     * Handle the BarangMasukDetail "force deleted" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function forceDeleted(BarangMasukDetail $barangMasukDetail)
    {
        //
    }
}
