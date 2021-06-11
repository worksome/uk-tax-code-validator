<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class MonthOneEmergencyRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^M1$/';
    }
}
