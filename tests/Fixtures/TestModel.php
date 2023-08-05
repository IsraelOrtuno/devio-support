<?php

namespace Devio\Support\Tests\Fixtures;

use Devio\Support\Model\HasOptions;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasOptions;

    public $timestamps = false;

    public $casts = [
        'options' => AsArrayObject::class
    ];
}