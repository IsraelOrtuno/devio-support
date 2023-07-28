<?php

namespace Devio\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class JsonObject implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $value = (array)$value;
            throw_if(array_is_list($value));
        } catch (\Throwable $e) {
            $fail(':attribute must be an object.');
        }
    }
}
