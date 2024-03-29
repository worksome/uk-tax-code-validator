<?php

namespace Worksome\UkTaxCodeValidator\Rules;

use Worksome\UkTaxCodeValidator\TaxCode;

class TopScottishRateRule extends RegexRule
{
    public function validate(TaxCode $taxCode): bool
    {
        // Validate against full tax code, as a D3
        // should always have a scottish regime modifier in front.
        return parent::validate(
            new TaxCode($taxCode->getOriginalTaxCode())
        );
    }

    protected function regex(): string
    {
        return /* @lang RegExp */ '/^SD3/';
    }

    protected function regexForConsume(): string
    {
        return /* @lang RegExp */ '/^D3/';
    }
}
