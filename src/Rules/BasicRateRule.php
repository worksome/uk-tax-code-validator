<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class BasicRateRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^BR/';
    }
}
