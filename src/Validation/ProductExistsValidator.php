<?php

namespace App\Validation;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductExistsValidator extends ConstraintValidator
{

    public function __construct(
        protected ProductRepository $productRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value) {
            $exists = !!$this->productRepository->find($value);
            if (!$exists) {
                $this->context->addViolation($constraint->errorMessage);
            }
        }
    }
}