<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class NegativePersonalAllowanceRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^K([0-9]+)/';
    }
}
