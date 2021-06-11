<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class TemporaryTaxCodeRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^([0-9]+)T/';
    }
}
