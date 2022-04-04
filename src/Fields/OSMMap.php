<?php

namespace Humaidem\FilamentMapPicker\Fields;

use Filament\Forms\Components\Field;
use Humaidem\FilamentMapPicker\Interfaces\MapOptions;

class OSMMap extends Field implements MapOptions
{
    /**
     * Field view
     * @var string
     */
    public string $view = 'filament-map-picker::fields.osm-map-picker';

    /**
     * Main field config variables
     * @var array
     */
    private array $mapConfig = [
        'statePath'    => '',
        'draggable'    => false,
        'showMarker'   => false,
        'tilesUrl'     => 'http://tile.openstreetmap.org/{z}/{x}/{y}.png',
        'attribution'  => null,
        'zoomOffset'   => -1,
        'tileSize'     => 512,
        'detectRetina' => false,
        'minZoom'      => 0,
        'maxZoom'      => 18,
    ];

    /**
     * Leaflet controls variables
     * @var array
     */
    private array $controls = [
        'zoomControl'     => false,
        'scrollWheelZoom' => 'center',
        'doubleClickZoom' => 'center',
        'touchZoom'       => 'center',
        'minZoom'         => 1,
        'maxZoom'         => 20,
        'zoom'            => 17,
    ];

    /**
     * Extra leaflet controls variables
     * @var array
     */
    private array $extraControls = [];

    /**
     * Create json configuration string
     * @return string
     */
    public function getMapConfig(): string
    {
        return json_encode(
            array_merge($this->mapConfig, [
                'statePath' => $this->getStatePath(),
                'controls'  => array_merge($this->controls, $this->extraControls)
            ])
        );
    }

    /**
     * Determine if user can drag map around or not.
     * @param bool $draggable
     * @return MapOptions
     * @note Default value is false
     */
    public function draggable(bool $draggable = true): self
    {
        $this->mapConfig['draggable'] = $draggable;
        return $this;
    }

    /**
     * Set default zoom
     * @param int $zoom
     * @return MapOptions
     * @note Default value 19
     */
    public function zoom(int $zoom): self
    {
        $this->controls['zoom'] = $zoom;
        return $this;
    }

    /**
     * Set max zoom
     * @param int $maxZoom
     * @return $this
     * @note Default value 20
     */
    public function maxZoom(int $maxZoom): self
    {
        $this->controls['maxZoom'] = $maxZoom;
        return $this;
    }

    /**
     * Set min zoom
     * @param int $maxZoom
     * @return $this
     * @note Default value 1
     */
    public function minZoom(int $minZoom): self
    {
        $this->controls['minZoom'] = $minZoom;
        return $this;
    }

    /**
     * Determine if marker is visible or not.
     * @param bool $show
     * @return $this
     * @note Default value is false
     */
    public function showMarker(bool $show = true): self
    {
        $this->mapConfig['showMarker'] = $show;
        return $this;
    }

    /**
     * Set tiles url
     * @param string $url
     * @return $this
     * @note refer to https://www.spatialbias.com/2018/02/qgis-3.0-xyz-tile-layers/
     */
    public function tilesUrl(string $url): self
    {
        $this->mapConfig['tilesUrl'] = $url;
        return $this;
    }

    /**
     * Determine if zoom box is visible or not.
     * @param bool $show
     * @return $this
     * @note Default value is false
     */
    public function showZoomControl(bool $show = true): self
    {
        $this->controls['zoomControl'] = $show;
        return $this;
    }

    /**
     * Append extra controls to be passed to leaflet map object
     * @param array $control
     * @return $this
     */
    public function extraControl(array $control): self
    {
        $this->extraControls = array_merge($this->extraControls, $control);
        return $this;
    }

    /**
     * Append extra controls to be passed to leaflet tileLayer object
     * @param array $control
     * @return $this
     */
    public function extraTileControl(array $control): self
    {
        $this->mapConfig = array_merge($this->mapConfig, $control);
        return $this;
    }

    public function hasJs(): bool
    {
        return true;
    }

    public function jsUrl(): string
    {
        $manifest = json_decode(file_get_contents(__DIR__ . '/../../dist/mix-manifest.json'), true);
        return url($manifest['/humaidem/map-picker/map-picker.js']);
    }

    public function hasCss(): bool
    {
        return true;
    }

    public function cssUrl(): string
    {
        $manifest = json_decode(file_get_contents(__DIR__ . '/../../dist/mix-manifest.json'), true);
        return url($manifest['/humaidem/map-picker/map-picker.css']);
    }

    /**
     * Setup function
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->default(['lat' => 0, 'lng' => 0]);
    }
}

