<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class BasicPersonalAllowanceRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^([0-9]+)L/';
    }
}
