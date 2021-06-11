<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class MarriageAllowanceTransferredRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^([0-9]+)N/';
    }
}
