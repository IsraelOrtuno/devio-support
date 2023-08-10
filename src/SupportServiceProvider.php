<?php

namespace Devio\Support;

use Illuminate\Database\Eloquent\Builder;
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
            return $this->map(fn(array|object $item) => Arr::only((array)$item, Arr::flatten($properties)));
        });

        Collection::macro('unselect', function (...$properties) {
            return $this->map(fn(array|object $item) => Arr::except((array)$item, Arr::flatten($properties)));
        });

        Builder::macro('paginateWithRequest', function (int $limit = 25) {
            $limit = (int) request('limit', $limit);

            if ($limit == -1) {
                $limit = 99999999;
            }

            return $this->paginate($limit);
        });
    }
}