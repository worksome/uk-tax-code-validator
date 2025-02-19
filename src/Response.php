<?php

namespace Worksome\UkTaxCodeValidator;

/**
 * @internal
 */
final class Response
{
    public function __construct(
        private array $successes = [],
        private array $errors = [],
    ) {
    }

    public static function error(string ... $errors): self
    {
        return new self(errors: $errors);
    }

    public static function success(string ... $successes): self
    {
        return new self(successes: $successes);
    }

    public function isValid(): bool
    {
        return $this->errors === [];
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getSuccesses(): array
    {
        return $this->successes;
    }
}
