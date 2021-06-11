<?php

namespace Worksome\UkTaxCodeValidator\Middlewares;

use Closure;
use JetBrains\PhpStorm\Pure;
use Worksome\UkTaxCodeValidator\Response;
use Worksome\UkTaxCodeValidator\Rules\MonthOneEmergencyRule;
use Worksome\UkTaxCodeValidator\Rules\RuleInterface;
use Worksome\UkTaxCodeValidator\Rules\WeekOneEmergencyRule;
use Worksome\UkTaxCodeValidator\Rules\WeekOneOrMonthOneEmergencyRule;
use Worksome\UkTaxCodeValidator\TaxCode;

class EmergencyCodeModifier implements ModifierInterface
{
    /** @var RuleInterface[] */
    private array $emergencyCodeRules;

    #[Pure]
    public function __construct()
    {
        $this->emergencyCodeRules = [
            new WeekOneEmergencyRule($this),
            new WeekOneOrMonthOneEmergencyRule($this),
            new MonthOneEmergencyRule($this),
        ];
    }

    public function handle(TaxCode $taxCode, Closure $next)
    {
        $validEmergencyCodeRules = collect($this->emergencyCodeRules)
            ->filter(fn(RuleInterface $rule) => $rule->validate($taxCode));

        if ($validEmergencyCodeRules->count() > 1) {
            return Response::error('Only one emergency tax code is allowed.');
        }

        $taxCode = $validEmergencyCodeRules->first()?->consume($taxCode) ?? $taxCode;

        return $next($taxCode);
    }
}
