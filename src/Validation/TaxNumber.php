<?php

namespace App\Validation;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class TaxNumber extends Constraint
{
    public string $errorMessage = '';

    public function __construct(
        mixed $options = null,
        array $groups = null,
        mixed $payload = null,
        string $message = 'Tax number is not correct'
    ) {
        parent::__construct($options, $groups, $payload);

        $this->errorMessage = $message;
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}