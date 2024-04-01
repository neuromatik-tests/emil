<?php

namespace App\Validation;

use App\Repository\CouponRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponExistsValidator extends ConstraintValidator
{

    public function __construct(
        protected CouponRepository $couponRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value) {
            $exists = !!$this->couponRepository->findOneBy(['code' => $value]);
            if (!$exists) {
                $this->context->addViolation($constraint->errorMessage);
            }
        }
    }
}