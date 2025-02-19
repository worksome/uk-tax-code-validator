<?php

namespace Worksome\UkTaxCodeValidator\Middlewares;

use Closure;
use Worksome\UkTaxCodeValidator\TaxCode;

class RemoveSpaces
{
    public function handle(TaxCode $taxCode, Closure $next)
    {
        $cleaned = str_replace(' ', '', $taxCode->getOriginalTaxCode());

        $newTaxCode = new TaxCode(
            $cleaned,
            $taxCode->getOriginalTaxCode()
        );

        return $next($newTaxCode);
    }
}
