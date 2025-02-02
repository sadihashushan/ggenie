<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerTheme(asset('css/custom-theme.css'));

            Filament::registerRenderHook(
                'filament::brand',
                fn () => view('filament.brand')
            );
        });
    }
}