<?php

namespace App\Observers;

use App\Models\BarangMasukDetail;
use App\Models\KartuStokBarang;
use App\Services\KartuStokBarangService;

class BarangMasukDetailObserver
{
    
    public $service = null;

    public function __construct(KartuStokBarangService $kartuStokBarang)
    {
        $this->service = $kartuStokBarang;
    }
    /**
     * Handle the BarangMasukDetail "created" event.
     *
     * @param  \App\Models\BarangMasukDetail  $barangMasukDetail
     * @return void
     */
    public function created(BarangMasukDetail $barangMasukDetail)
    {
        $barang = $barangMasukDetail->barang;

        if($barang){

            //Upadate Stok Barang
            $barang->stok += $barangMasukDetail->quantity;
            $barang->save();

            //Cetak kartu Stok
            $this->service->barangMasukStok($barangMasukDetail, 'Masuk');
        }
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
        
        if($barang)
        {
            $barang->stok -= $barangMasukDetail->quantity;
            $barang->save();
            
            $this->service->barangMasukStok($barangMasukDetail, 'Keluar', true);
        }
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
