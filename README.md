# UK Tax Code validator
This package is for validating if a UK tax code is valid.  
As there are many rules for when a UK tax code is valid, we needed a way to actually check this.
This package contains all the rules for validating if the UK tax code is a valid or not.

## Usage
For validating a tax code, you can simply run the following

```php
$engine = new Engine();
$response = $engine->validate($taxCode);

$response->isValid();
```

### Laravel
The package does also contain a validation rule to be used with Laravel.

```php
Validator::make($data, [
    'tax_code' => ['required', new UkTaxCode(),],
])->fails();
```