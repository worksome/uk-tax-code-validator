<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class MarriageAllowanceReceivedRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^([0-9]+)M/';
    }
}
