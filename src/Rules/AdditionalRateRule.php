<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class AdditionalRateRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^D1/';
    }
}
