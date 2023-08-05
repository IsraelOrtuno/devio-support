<?php

namespace Devio\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Collection::macro('select', function (...$properties) {
            return $this->map(fn(array|object $item) => Arr::only((array)$item, $properties));
        });

        Collection::macro('unselect', function (...$properties) {
            return $this->map(fn(array|object $item) => Arr::except((array)$item, $properties));
        });
    }
}