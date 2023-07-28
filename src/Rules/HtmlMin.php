<?php

namespace Devio\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HtmlMin implements ValidationRule
{
    public function __construct(
        protected int $min
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (mb_strlen(trim(strip_tags(html_entity_decode($value)))) < $this->min) {
            $fail('The :attribute field must be least :min characters.')
                ->translate(['min' => $this->min]);
        }
    }
}
