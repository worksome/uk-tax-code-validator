<?php

namespace Worksome\UkTaxCodeValidator\Rules;

class WeekOneEmergencyRule extends RegexRule
{
    protected function regex(): string
    {
        return /* @lang RegExp */ '/^W1$/';
    }
}
