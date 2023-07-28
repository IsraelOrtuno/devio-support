<?php

namespace Devio\Support\Rules;

use Illuminate\Support\Arr;

class Rule
{
    /**
     * Get a collection of rules and make them optional (sometimes attribute).
     */
    public static function makeOptional(array $rules = [], array $keys = null): array
    {
        return collect($rules)->map(function ($rule, $key) use ($keys) {
            if ($keys && ! in_array($key, $keys)) {
                return $rule;
            }

            $rule = Arr::wrap($rule);

            $rule[] = 'sometimes';

            return $rule;
        })->toArray();
    }
}
