<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class WeekOneOrMonthOneEmergencyRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^X$/';
    }
}
