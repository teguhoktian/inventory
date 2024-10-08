<?php

namespace App\Providers;

use App\Models\BarangKeluarDetail;
use App\Models\BarangMasukDetail;
use App\Observers\BarangKeluarDetailObserver;
use App\Observers\BarangMasukDetailObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        BarangMasukDetail::observe(BarangMasukDetailObserver::class);
        BarangKeluarDetail::observe(BarangKeluarDetailObserver::class);
    }
}
