<?php

namespace App\Observers;

use App\Models\BarangKeluarDetail;

class BarangKeluarDetailObserver
{
    /**
     * Handle the BarangKeluarDetail "created" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function created(BarangKeluarDetail $barangKeluarDetail)
    {
        $barang = $barangKeluarDetail->barang;
        $barang->stok -= $barangKeluarDetail->quantity;
        $barang->save();
    }

    /**
     * Handle the BarangKeluarDetail "updated" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function updated(BarangKeluarDetail $barangKeluarDetail)
    {
        //
    }

    /**
     * Handle the BarangKeluarDetail "deleted" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function deleted(BarangKeluarDetail $barangKeluarDetail)
    {
        $barang = \App\Models\Barang::find($barangKeluarDetail->id_barang);
        $barang->stok += $barangKeluarDetail->quantity;
        $barang->save();
    }

    /**
     * Handle the BarangKeluarDetail "restored" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function restored(BarangKeluarDetail $barangKeluarDetail)
    {
        //
    }

    /**
     * Handle the BarangKeluarDetail "force deleted" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function forceDeleted(BarangKeluarDetail $barangKeluarDetail)
    {
        //
    }
}
