<?php

namespace Worksome\UkTaxCodeValidator\Rules;

use Worksome\UkTaxCodeValidator\TaxCode;

interface RuleInterface
{
    public function validate(TaxCode $taxCode): bool;

    public function consume(TaxCode $taxCode): TaxCode;
}
