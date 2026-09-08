<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
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
    }
}
