<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class HigherRateRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^D0/';
    }
}
