<?php

use Worksome\UkTaxCodeValidator\Engine;

it('has valid tax code', function (string $taxCode) {
    $engine = new Engine();

    $response = $engine->validate($taxCode);

    expect($response->isValid())->toBeTrue();
})->with([
    // Basic personal allowance
    '1257L', '1257L X', '1257LW1', '1257LM1', 'C11257L', 'C1257LM1',
    // Temporary tax code
    'S1257T', '0T',
    // Basic Rate
    'BR', 'BRM1', 'SBR',
    // Negative personal allowance
    'K0W1', 'K0', 'SK100',
    // Marriage allowance received
    '130M',
    // Marriage allowance transferred
    '130N',
    // Higher rate
    'D0', 'D0W1', 'CD0',
    // Additional rate
    'D1', 'CD1', 'D1X', 'SD1M1',
    // Not taxed
    'NT', 'NTX', 'NTM1',
    // Top scottish rates
    'SD2', 'SD2X',
    // Random tests
    'S 123 3 L',
]);

it('can check that tax codes are invalid', function (string $taxCode) {
    $engine = new Engine();

    $response = $engine->validate($taxCode);

    expect($response->isValid())->toBeFalse();
})->with([
    'K1257L', // Only one tax code modifier is allowed
    '1257LM', // Only one tax code modifier is allowed
    'CS1257L', // Only one regime income modifier is allowed
    'BR100', // Special tax codes does not allow integer value
    '100BR', // Special tax codes does not allow integer value
    '1257L W1 M1', // Only one emergency code is allowed
    '', // Not valid as there is no data
    '1233242342', // Not valid as that is just some random numbers.
    'S', // Not valid as it only contains a regime modifier.
    'M', // tax code modifier needs a value
    '130MN', // Can only have one modifier
    'C1257M1', // Missing tax code modifier, but has number
    'CM1', // Missing tax code modifier
    '200D1', // No number allowed for D1
    'SNT', // Cannot have regime modifier when NT tax code
    'D2', // D2 should always be regime modifier
    'CD2', // D2 should only be with scottish modifier
    'NTNTNT', // Repeating NT is not valid
]);
