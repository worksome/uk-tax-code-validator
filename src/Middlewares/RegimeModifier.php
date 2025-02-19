<?php

namespace Worksome\UkTaxCodeValidator\Middlewares;

use Closure;
use Worksome\UkTaxCodeValidator\Response;
use Worksome\UkTaxCodeValidator\Rules\RuleInterface;
use Worksome\UkTaxCodeValidator\Rules\ScottishIncomeRule;
use Worksome\UkTaxCodeValidator\Rules\WelshIncomeRule;
use Worksome\UkTaxCodeValidator\TaxCode;

class RegimeModifier implements ModifierInterface
{
    /** @var RuleInterface[]  */
    private array $countryModifierRules;

    public function __construct()
    {
        $this->countryModifierRules = [
            new ScottishIncomeRule($this),
            new WelshIncomeRule($this),
        ];
    }

    public function handle(TaxCode $taxCode, Closure $next)
    {
        $validCountryRules = collect($this->countryModifierRules)
            ->filter(fn (RuleInterface $rule) => $rule->validate($taxCode));

        if ($validCountryRules->count() > 1) {
            return Response::error('Only one regime modifier is allowed.');
        }

        // Consume the country modifier.
        $taxCode = $validCountryRules->first()?->consume($taxCode) ?? $taxCode;

        return $next($taxCode);
    }
}
