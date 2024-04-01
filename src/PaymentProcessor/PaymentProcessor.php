<?php

namespace App\PaymentProcessor;

abstract class PaymentProcessor
{
    abstract public function process(float $amount, mixed $parameters = []): mixed;
}