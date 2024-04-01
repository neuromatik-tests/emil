<?php

namespace App\Validation;

use App\Service\TaxesGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{

    public function __construct(
        protected TaxesGetter $taxesGetter
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value) {
            if (!$this->taxesGetter->getTaxByNumber($value)) {
                $this->context->addViolation($constraint->errorMessage);
            }
        }
    }
}