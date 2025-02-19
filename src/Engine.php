<?php

namespace Worksome\UkTaxCodeValidator;

use Illuminate\Pipeline\Pipeline;
use Worksome\UkTaxCodeValidator\Middlewares\EmergencyCodeModifier;
use Worksome\UkTaxCodeValidator\Middlewares\ModifierInterface;
use Worksome\UkTaxCodeValidator\Middlewares\RegimeModifier;
use Worksome\UkTaxCodeValidator\Middlewares\RemoveSpaces;
use Worksome\UkTaxCodeValidator\Middlewares\TaxCodeModifier;

class Engine
{
    public function validate(string|TaxCode $taxCode): Response
    {
        $taxCode = $taxCode instanceof TaxCode ? $taxCode : new TaxCode($taxCode);

        return $this->validationPipeline($taxCode)
            ->then(
                fn (TaxCode $taxCode) => $taxCode->getTaxCode() !== ''
                ? Response::error('Invalid tax code.')
                : Response::success('Tax code is valid.')
            );
    }

    /**
     * @return array<class-string<ModifierInterface>, string>
     */
    public function getModifiers(string $taxCode): array
    {
        return $this->validationPipeline(
            new TaxCode($taxCode)
        )->then(fn (TaxCode $taxCode) => $taxCode->getModifiers());
    }

    private function validationPipeline(TaxCode $taxCode): Pipeline
    {
        return (new Pipeline())
            ->send($taxCode)
            ->through([
                new RemoveSpaces(),
                new RegimeModifier(),
                new TaxCodeModifier(),
                new EmergencyCodeModifier(),
            ]);
    }
}
