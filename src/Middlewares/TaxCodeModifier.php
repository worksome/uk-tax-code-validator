<?php

namespace Worksome\UkTaxCodeValidator\Middlewares;

use Closure;
use JetBrains\PhpStorm\Pure;
use Worksome\UkTaxCodeValidator\Response;
use Worksome\UkTaxCodeValidator\Rules\AdditionalRateRule;
use Worksome\UkTaxCodeValidator\Rules\BasicPersonalAllowanceRule;
use Worksome\UkTaxCodeValidator\Rules\BasicRateRule;
use Worksome\UkTaxCodeValidator\Rules\HigherRateRule;
use Worksome\UkTaxCodeValidator\Rules\MarriageAllowanceReceivedRule;
use Worksome\UkTaxCodeValidator\Rules\MarriageAllowanceTransferredRule;
use Worksome\UkTaxCodeValidator\Rules\NegativePersonalAllowanceRule;
use Worksome\UkTaxCodeValidator\Rules\NoTaxesRule;
use Worksome\UkTaxCodeValidator\Rules\RuleInterface;
use Worksome\UkTaxCodeValidator\Rules\TemporaryTaxCodeRule;
use Worksome\UkTaxCodeValidator\Rules\TopScottishRateRule;
use Worksome\UkTaxCodeValidator\TaxCode;

class TaxCodeModifier implements ModifierInterface
{
    /** @var RuleInterface[] */
    private array $taxCodeRules;

    #[Pure]
    public function __construct()
    {
        $this->taxCodeRules = [
            new BasicPersonalAllowanceRule($this),
            new TemporaryTaxCodeRule($this),
            new NegativePersonalAllowanceRule($this),
            new BasicRateRule($this),
            new MarriageAllowanceReceivedRule($this),
            new MarriageAllowanceTransferredRule($this),
            new HigherRateRule($this),
            new AdditionalRateRule($this),
            new TopScottishRateRule($this),
            new NoTaxesRule($this),
        ];
    }

    public function handle(TaxCode $taxCode, Closure $next)
    {
        $validTaxCodeRules = collect($this->taxCodeRules)
            ->filter(fn(RuleInterface $rule) => $rule->validate($taxCode));

        if ($validTaxCodeRules->count() !== 1) {
            return Response::error("There should only be one tax code, found {$validTaxCodeRules->count()}.");
        }

        // Consume the tax code
        $taxCode = $validTaxCodeRules->first()->consume($taxCode);

        return $next($taxCode);
    }
}
