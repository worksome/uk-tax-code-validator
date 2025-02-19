<?php

namespace Worksome\UkTaxCodeValidator;

use Stringable;
use Worksome\UkTaxCodeValidator\Middlewares\ModifierInterface;

/**
 * @internal
 */
class TaxCode implements Stringable
{
    private string $originalTaxCode;

    public function __construct(
        private string $taxCode,
        string $originalTaxCode = null,
        private array $modifiers = [],
    ) {
        $this->originalTaxCode = $originalTaxCode ?? $this->taxCode;
    }

    public function getTaxCode(): string
    {
        return $this->taxCode;
    }

    public function getOriginalTaxCode(): string
    {
        return $this->originalTaxCode;
    }

    public function __toString()
    {
        return $this->getTaxCode();
    }

    public function consume(string $consume, ModifierInterface $modifier): TaxCode
    {
        $modifiers = $this->modifiers;
        $modifiers[$modifier::class] = $consume;

        return new self(
            taxCode: substr($this->getTaxCode(), strlen($consume)),
            originalTaxCode: $this->getOriginalTaxCode(),
            modifiers: $modifiers,
        );
    }

    /**
     * @return array<class-string<ModifierInterface>, string>
     */
    public function getModifiers(): array
    {
        return $this->modifiers;
    }
}
