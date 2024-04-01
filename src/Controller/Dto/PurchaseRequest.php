<?php

namespace App\Controller\Dto;

use App\Validation\PaymentProcessorExists;
use Symfony\Component\Validator\Constraints\NotBlank;

class PurchaseRequest extends CalculatePriceRequest
{
    #[NotBlank]
    #[PaymentProcessorExists]
    protected string $paymentProcessor = '';

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(string $paymentProcessor): self
    {
        $this->paymentProcessor = $paymentProcessor;
        return $this;
    }
}