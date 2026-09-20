<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Gunakan Tailwind-friendly pagination view
        Paginator::useTailwind();

        // Aktifkan strict mode di development
        Model::shouldBeStrict(! app()->isProduction());

        // Paksa Laravel generate URL pakai HTTPS di production
        // (Railway terminate SSL di proxy, jadi Laravel perlu dipaksa tau requestnya HTTPS)
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }
}