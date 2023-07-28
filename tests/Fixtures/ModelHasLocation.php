<?php

namespace Devio\Support\Tests\Fixtures;

use Devio\Support\Model\HasLocation;
use Illuminate\Database\Eloquent\Model;

class ModelHasLocation extends Model
{
    use HasLocation;

    protected $table = 'location_models';

    public $timestamps = false;

    protected $casts = [
        'locations' => 'json'
    ];
}