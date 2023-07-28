<?php

use Devio\Support\Model\ModelFactory;
use Devio\Support\Tests\Fixtures\TestModel;
use Illuminate\Database\Eloquent\Relations\Relation;

beforeAll(fn () => Relation::morphMap(['test' => TestModel::class]));

it('finds a model by its morph name', function() {
    $model = TestModel::create(['name' => 'foo']);
    $m = ModelFactory::findMorph('test', $model->getKey());
    expect($m)->toBeInstanceOf(TestModel::class)
    ->and($m->getKey())->toBe($model->getKey());
});

it('returns null when no morph is found', function () {
    $m = ModelFactory::findMorph('foo', 1);
    expect($m)->toBeNull();
});