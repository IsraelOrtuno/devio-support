<?php

namespace Devio\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class UrlOrEmail implements ValidationRule
{
    use ValidatesAttributes;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validateEmail($attribute, $value, []) && !$this->validateUrl($attribute, $value)) {
            $fail('The :attribute field must contain a valid e-mail or URL.');
        }
    }
}
