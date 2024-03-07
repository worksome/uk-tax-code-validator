<?php

namespace Worksome\UkTaxCodeValidator\Rules;

use Worksome\UkTaxCodeValidator\TaxCode;

class AdvancedScottishRateRule extends RegexRule
{
    public function validate(TaxCode $taxCode): bool
    {
        // Validate against full tax code, as a D2
        // should always have a scottish regime modifier in front.
        return parent::validate(
            new TaxCode($taxCode->getOriginalTaxCode())
        );
    }

    protected function regex(): string
    {
        return /* @lang RegExp */ '/^SD2/';
    }

    protected function regexForConsume(): string
    {
        return /* @lang RegExp */ '/^D2/';
    }
}
