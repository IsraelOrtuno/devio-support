<?php

it('selects properties from nested collection objects', function () {
    $objects = collect([
        (object)['name' => 'foo', 'lastname' => 'bar'],
        (object)['name' => 'baz', 'lastname' => 'qux'],
    ]);

    $result = $objects->select('name');
    expect($result[0])->toBe(['name' => 'foo'])->and($result[1])->toBe(['name' => 'baz']);
});

it('excludes properties from nested collection objects', function () {
    $objects = collect([
        (object)['name' => 'foo', 'lastname' => 'bar'],
        (object)['name' => 'baz', 'lastname' => 'qux'],
    ]);

    $result = $objects->unselect('lastname');
    expect($result[0])->toBe(['name' => 'foo'])->and($result[1])->toBe(['name' => 'baz']);
});