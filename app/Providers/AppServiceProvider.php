<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //Settings Override
        try {
            $settings = app(GeneralSettings::class);
            config(['app.timezone' => $settings->timezone]);
            config(['app.locale' => $settings->locale]);
            config(['app.url' => $settings->site_url]);
            config(['app.asset_url' => $settings->site_url]);
            config(['app.name' => $settings->site_name]);
        } catch (\Throwable $th) {
            // No Action
        }

        date_default_timezone_set(config('app.timezone'));
    }
}
