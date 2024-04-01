<?php

namespace App\PaymentProcessor;

class PaypalProcessor extends PaymentProcessor
{

    public function process(float $amount, mixed $parameters = []): mixed
    {
        return true;
    }
}