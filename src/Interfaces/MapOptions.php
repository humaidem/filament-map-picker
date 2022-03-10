<?php

namespace Humaidem\FilamentMapPicker\Interfaces;

interface MapOptions
{
    public function getMapConfig(): string;

    public function draggable(bool $draggable = true): self;

    public function zoom(int $zoom): self;

    public function maxZoom(int $maxZoom): self;

    public function minZoom(int $minZoom): self;

    public function showMarker(bool $show = true): self;

    public function tilesUrl(string $url): self;

    public function showZoomControl(bool $show = true): self;

    public function extraControl(array $control): self;

    public function extraTileControl(array $control): self;

    public function hasJs(): bool;

    public function jsUrl(): string;

    public function hasCss(): bool;

    public function cssUrl(): string;

}
