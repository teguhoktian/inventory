<?php

namespace App\Observers;

use App\Models\BarangKeluarDetail;
use App\Services\KartuStokBarangService;

class BarangKeluarDetailObserver
{
    public $service = null;

    public function __construct(KartuStokBarangService $kartuStokBarang)
    {
        $this->service = $kartuStokBarang;
    }

    /**
     * Handle the BarangKeluarDetail "created" event.
     *
     * @param  \App\Models\BarangKeluarDetail  $barangKeluarDetail
     * @return void
     */
    public function created(BarangKeluarDetail $barangKeluarDetail)
    {
        $barang = $barangKeluarDetail->barang;
        if($barang){
            $barang->stok -= $barangKeluarDetail->quantity;
            $barang->save();

            //Cetak kartu Stok
            $this->service->barangKeluarStok($barangKeluarDetail);
        }
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
        if($barang)
        {
            $barang->stok += $barangKeluarDetail->quantity;
            $barang->save();

            $this->service->barangKeluarStok($barangKeluarDetail, 'Masuk', true);
        }
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
