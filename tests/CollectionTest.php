<?php

it('picks properties from nested collection objects', function () {
    $objects = collect([
        (object)['name' => 'foo', 'lastname' => 'bar'],
        (object)['name' => 'baz', 'lastname' => 'qux'],
    ]);

    $result = $objects->pick('name');
    expect($result[0])->toBe(['name' => 'foo'])->and($result[1])->toBe(['name' => 'baz']);
});