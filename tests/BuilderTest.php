<?php

use Devio\Support\Tests\Fixtures\TestModel;
use Illuminate\Contracts\Pagination\Paginator;

it('paginates based on request limit parameter', function() {
    TestModel::create(['name' => 'foo']);
    TestModel::create(['name' => 'bar']);

    $models = TestModel::paginateWithRequest();
    expect($models)->toBeInstanceOf(Paginator::class);

    request()->replace(['limit' => 1]);
    $models = TestModel::paginateWithRequest();
    expect($models)->toHaveCount(1);

    request()->replace(['limit' => 2]);
    $models = TestModel::paginateWithRequest();
    expect($models)->toHaveCount(2);
});