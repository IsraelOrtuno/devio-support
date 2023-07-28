<?php

namespace Devio\Support\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class ModelFactory
{
    public static function findMorph(?string $type, string|int|null $id): ?Model
    {
        if (!$type || !$id) {
            return null;
        }

        $class = Relation::getMorphedModel($type);

        return $class ? $class::find($id) : null;
    }
}
