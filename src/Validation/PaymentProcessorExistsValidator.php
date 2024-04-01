<?php

namespace App\Validation;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PaymentProcessorExistsValidator extends ConstraintValidator
{

    public function __construct(
        protected ServiceLocator $serviceLocator
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value) {
            try {
                $exists = !!$this->serviceLocator->get($value);
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                $exists = false;
            }
            if (!$exists) {
                $this->context->addViolation($constraint->errorMessage);
            }
        }
    }
}