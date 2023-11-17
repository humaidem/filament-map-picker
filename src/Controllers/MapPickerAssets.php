<?php

namespace Humaidem\FilamentMapPicker\Controllers;

use Livewire\Drawer\Utils;

class MapPickerAssets
{
    public function __invoke($file)
    {
        $basePath = __DIR__.'/../../dist/humaidem/map-picker/';

        return match ($file) {
            'map-picker.css' => Utils::pretendResponseIsFile("{$basePath}/map-picker.css", 'text/css; charset=utf-8'),
            'map-picker.css.map' => Utils::pretendResponseIsFile("{$basePath}/map-picker.css.map", 'application/json; charset=utf-8'),
            'map-picker.js' => Utils::pretendResponseIsFile("{$basePath}/map-picker.js", 'application/javascript; charset=utf-8'),
            'map-picker.js.map' => Utils::pretendResponseIsFile("{$basePath}/map-picker.js.map", 'application/json; charset=utf-8'),
            default => abort(404),
        };
    }
}
