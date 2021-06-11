<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class WelshIncomeRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^C/';
    }
}
