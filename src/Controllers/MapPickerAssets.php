<?php

namespace Humaidem\FilamentMapPicker\Controllers;

use Livewire\Controllers\CanPretendToBeAFile;

class MapPickerAssets
{
    use CanPretendToBeAFile;

    public function __invoke($file)
    {
        switch ($file) {
            case 'map-picker.css':
                return $this->pretendResponseIsFile(__DIR__ . '/../../dist/humaidem/map-picker/map-picker.css', 'text/css; charset=utf-8');
            case 'map-picker.css.map':
                return $this->pretendResponseIsFile(__DIR__ . '/../../dist/humaidem/map-picker/map-picker.css.map', 'application/json; charset=utf-8');
            case 'map-picker.js':
                return $this->pretendResponseIsFile(__DIR__ . '/../../dist/humaidem/map-picker/map-picker.js', 'application/javascript; charset=utf-8');
            case 'map-picker.js.map':
                return $this->pretendResponseIsFile(__DIR__ . '/../../dist/humaidem/map-picker/map-picker.js.map', 'application/json; charset=utf-8');
            default:
                abort(404);
        }
    }
}
