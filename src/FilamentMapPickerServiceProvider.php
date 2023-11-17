<?php

namespace Humaidem\FilamentMapPicker;

use Humaidem\FilamentMapPicker\Controllers\MapPickerAssets;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;


class FilamentMapPickerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-map-picker';

    public function boot()
    {
        $this->bootLoaders();
        $this->bootPublishing();

        // register assets route
        Route::get('humaidem/map-picker/{file}', MapPickerAssets::class);
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-map-picker');
    }

    protected function bootPublishing()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-map-picker'),
        ], 'filament-map-picker-views');

    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasCommands($this->getCommands());

        if (file_exists($this->package->basePath('/../resources/views'))) {
            $package->hasViews();
        }
    }
}
