<?php

namespace App\PaymentProcessor;

class BluesnapProcessor extends PaymentProcessor
{

    public function process(float $amount, mixed $parameters = []): mixed
    {
        return true;
    }
}