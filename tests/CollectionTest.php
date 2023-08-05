<?php

it('selects properties from nested collection objects', function () {
    $objects = collect([
        (object)['name' => 'foo', 'lastname' => 'bar', 'address' => 'foobar'],
    ]);

    $result = $objects->select('name');
    expect($result[0])->toBe(['name' => 'foo']);

    $result = $objects->select('name', 'address');
    expect($result[0])->toBe(['name' => 'foo', 'address' => 'foobar']);

    $result = $objects->select(['name', 'address']);
    expect($result[0])->toBe(['name' => 'foo', 'address' => 'foobar']);
});

it('excludes properties from nested collection objects', function () {
    $objects = collect([
        (object)['name' => 'foo', 'lastname' => 'bar'],
        (object)['name' => 'baz', 'lastname' => 'qux'],
    ]);

    $result = $objects->unselect('lastname');
    expect($result[0])->toBe(['name' => 'foo'])->and($result[1])->toBe(['name' => 'baz']);
});