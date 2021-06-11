<?php

namespace Worksome\UkTaxCodeValidator;

use Illuminate\Contracts\Validation\Rule;

class UkTaxCode implements Rule
{
    public function passes($attribute, $value)
    {
        $engine = new Engine();
        $response = $engine->validate($value);

        return $response->isValid();
    }

    public function message(): string
    {
        return "The :attribute must be a valid UK tax code.";
    }
}
