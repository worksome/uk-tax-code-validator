<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class ScottishIncomeRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^S/';
    }
}
