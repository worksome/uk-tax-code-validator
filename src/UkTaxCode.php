<?php

namespace Worksome\UkTaxCodeValidator;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UkTaxCode implements ValidationRule
{
    /** {@inheritdoc} */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $engine = new Engine();
        $response = $engine->validate($value);

        if (! $response->isValid()) {
            $fail('The :attribute must be a valid UK tax code.')->translate();
        }
    }
}
