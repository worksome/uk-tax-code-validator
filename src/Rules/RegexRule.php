<?php

namespace Worksome\UkTaxCodeValidator\Rules;

use Worksome\UkTaxCodeValidator\Middlewares\ModifierInterface;
use Worksome\UkTaxCodeValidator\TaxCode;
use function Safe\preg_match;

abstract class RegexRule implements RuleInterface
{
    public function __construct(
        private ModifierInterface $modifier,
    ) {
    }

    abstract protected function regex(): string;

    protected function regexForValidate(): string
    {
        return $this->regex();
    }

    protected function regexForConsume(): string
    {
        return $this->regex();
    }

    public function validate(TaxCode $taxCode): bool
    {
        $isMatch = preg_match(
            $this->regexForValidate(),
            $taxCode,
        );

        if ($isMatch !== 1) {
            return false;
        }

        return true;
    }

    public function consume(TaxCode $taxCode): TaxCode
    {
        preg_match(
            $this->regexForConsume(),
            $taxCode,
            $matches,
        );

        return $taxCode->consume($matches[0], $this->modifier);
    }
}
