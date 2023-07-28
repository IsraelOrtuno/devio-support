<?php

use Devio\Support\Tests\Fixtures\ModelHasLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

beforeAll(fn() => Model::unguard());

it('gets the location as array', function () {
    $m = ModelHasLocation::create(['locations' => ['foo']]);

    expect($m->getLocations())->toHaveCount(1)->toBeInstanceOf(Collection::class)
        ->and($m->getLocations()->toArray())->toBe(['foo']);

    $m = ModelHasLocation::create(['locations' => ['foo']]);
    expect($m->getLocations())->toHaveCount(1)->toBeInstanceOf(Collection::class)
        ->and($m->getLocations()->toArray())->toBe(['foo']);
});

it('provides location chunks by name', function () {
    $m = ModelHasLocation::create(['locations' => [['name' => 'Madrid, Spain'], ['name' => 'Barcelona, Spain']]]);
    expect($m->getLocationChunksAttribute())->toHaveCount(2)
        ->and($m->getLocationChunksAttribute()->toArray())->toBe(['Madrid, Spain', 'Barcelona, Spain'])
        ->and($m->getLocationChunksAttribute())->toEqual($m->locationChunks);
});

it('gets the locations as a formatted string', function () {
    $m = ModelHasLocation::create(['locations' => [['name' => 'Madrid, Spain'], ['name' => 'Barcelona, Spain']]]);

    expect($m->getFormattedLocationAttribute())->toBe('Madrid, Spain - Barcelona, Spain');
});