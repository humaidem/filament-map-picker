# Filament Map Picker

A Filament field to enable you select location in map and return geo coordinates.

### Status Note

This package still in beta and not full tested. please use at your own risk.

# Supported Maps

1. Open Street Map (OSM)

More will be added to package once proven it's needed.

# Installation

You can install the package via composer:

```bash
composer require humaidem/filament-map-picker
```

# Basic usage

Resource file

```php
<?php
namespace App\Filament\Resources;
use Filament\Resources\Resource;
use Filament\Resources\Forms\Form;
use Humaidem\FilamentMapPicker\Fields\OSMMap;
...
class FilamentResource extends Resource
{
    ...
    public static function form(Form $form)
    {
        return $form->schema([
            OSMMap::make('location')
                ->label('Location')
                ->showMarker()
                ->draggable()
                ->extraControl([
                    'zoomDelta'           => 1,
                    'zoomSnap'            => 0.25,
                    'wheelPxPerZoomLevel' => 60
                ])
                // tiles url (refer to https://www.spatialbias.com/2018/02/qgis-3.0-xyz-tile-layers/)
                ->tilesUrl('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}')
           ]);
    }
    ...
}
```

### Manipulating data

We will be using grimzy/laravel-mysql-spatial:^4.0 as example, you can use any other package as you please.

#### After State Hydrated

once data loaded from database you will need to convert it to correct format as livewire don't accept class base format.

```php
...
OSMMap::make('location')
    ->afterStateHydrated(function ($state, callable $set) {
            if ($state instanceof Point) {
                /** @var Point $state */
                $set('location', ['lat' => $state->getLat(), 'lng' => $state->getLng()]);
            }
        });
...
```

#### mutate Dehydrated State

convert array to Point class before storing data.

```php
...
OSMMap::make('location')
   ->mutateDehydratedStateUsing(function ($state) {
                if (!($state instanceof Point))
                    return new Point($state['lat'], $state['lng']);

                return $state;
            });
...
```

#### After State Updated

Make sure to convert data into array after each time updated.

```php
...
OSMMap::make('location')
    ->afterStateUpdated(function ($state, callable $set) use ($name) {
            if ($state instanceof Point) {
                /** @var Point $state */
                $set($name, ['lat' => $state->getLat(), 'lng' => $state->getLng()]);
            }
        });
...
```

## Options

Option | Type   | Default                                       | Description
------------|--------|-----------------------------------------------| -------------
`draggable(bool)` | bool   | false                                         | Allow user to move map around.
`zoom(int)` | int    | 19                                            | Default zoom when map loaded.
`maxZoom(int)` | int    | 20                                            | Max zoom allowed.
`showMarker(bool)` | bool   | false                                         | Show Marker in the middle of the map
`tilesUrl(string)` | string | http://tile.openstreetmap.org/{z}/{x}/{y}.png | Tiles service/provider url.
`showZoomControl(bool)` | bool   | false                                         | Show or hide Zoom control of the map.
`extraControl(array)` | array  | []                                         | Add extra map controls (please refer to leaflet)
`extraTileControl(array)` | array  | []                                         | Add extra tileLayer controls (please refer to leaflet tileLayer())

# License

[MIT](LICENSE) © Humaid Al Mansoori

# Thanks for use

Hopefully, this package is useful to you.






