<?php

namespace Worksome\UkTaxCodeValidator\Rules;

use Worksome\UkTaxCodeValidator\TaxCode;

class NoTaxesRule extends RegexRule
{
    public function validate(TaxCode $taxCode): bool
    {
        // Validate the regex against the original,
        // as the whole tax code has to start with NT.
        return parent::validate(
            new TaxCode($taxCode->getOriginalTaxCode())
        );
    }

    protected function regex(): string
    {
        return /* @lang RegExp */ '/^NT/';
    }
}
