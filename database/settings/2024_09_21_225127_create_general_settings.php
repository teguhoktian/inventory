<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', env('APP_NAME', 'Laravel'));
        $this->migrator->add('general.site_url', env('APP_URL', 'http://localhost'));
        $this->migrator->add('general.timezone', env('APP_TIMEZONE', 'Asia/Jakarta'));
        $this->migrator->add('general.locale', env('APP_LOCALE', 'en'));
        $this->migrator->add('general.per_page', env('PER_PAGE', 10));
    }

    public function down(): void
    {
        $this->migrator->delete('general.site_name');
        $this->migrator->delete('general.site_url');
        $this->migrator->delete('general.timezone');
        $this->migrator->delete('general.locale');
        $this->migrator->delete('general.per_page');
    }
};
