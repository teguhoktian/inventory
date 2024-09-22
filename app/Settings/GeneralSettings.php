<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public string $site_url;
    public string $timezone;
    public string $locale;
    public int $per_page;
    
    public static function group(): string
    {
        return 'general';
    }
}