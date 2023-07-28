<?php

namespace Devio\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HtmlMax implements ValidationRule
{
    public function __construct(
        protected int $max
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (mb_strlen(trim(strip_tags(html_entity_decode($value)))) > $this->max) {
            $fail('The :attribute field must not be greater than :max characters.')
                ->translate(['max' => $this->max]);
        }
    }
}
