<?php

namespace App\Validation;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ProductExists extends Constraint
{
    public string $errorMessage = '';

    public function __construct(
        mixed $options = null,
        array $groups = null,
        mixed $payload = null,
        string $message = 'Product not found'
    ) {
        parent::__construct($options, $groups, $payload);

        $this->errorMessage = $message;
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}