<?php

namespace Devio\Support\Model;

use Illuminate\Support\Arr;

trait HasLocation
{
    public function getLocations()
    {
        $locations = Arr::wrap($this->locations ?? $this->location ?? []);

        if (! array_key_exists(0, $locations)) {
            $locations = [$locations];
        }

        return collect($locations)->filter();
    }

    public function getFormattedLocationAttribute()
    {
        return $this->locationChunks->implode(' - ');
    }

    public function getLocationChunksAttribute()
    {
        $locations = $this->getLocations()->map(function ($location) {
            $location = (object) $location;

            return str_replace(' , ', ' ', $location->name);
        });

        return $locations->filter();
    }
}
