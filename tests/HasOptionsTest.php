<?php

use Devio\Support\Tests\Fixtures\TestModel;

it('get options by key', function () {
    $m = TestModel::create(['name' => 'test', 'options' => ['color' => 'blue']]);
    expect($m->getOption('color'))->toBe('blue')
        ->and($m->getOption('size'))->toBeNull();

    $m = TestModel::create(['name' => 'test', 'options' => null]);
    expect($m->getOption('color'))->toBeNull();
});

it('set options by key', function () {
    $m = TestModel::create(['name' => 'test', 'options' => []]);
    $m->setOption('color', 'blue');
    expect($m->getOption('color'))->toBe('blue');

    $m = TestModel::create(['name' => 'test', 'options' => null]);
    $m->setOption('color', 'blue');
    expect($m->getOption('color'))->toBe('blue');
});

it('unsets a option by key', function () {
    $m = TestModel::create(['name' => 'test', 'options' => ['color' => 'blue']]);
    $m->unsetOption('color');
    expect($m->getOption('color'))->toBeNull();
});