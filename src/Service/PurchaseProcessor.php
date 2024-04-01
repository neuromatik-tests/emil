<?php

namespace App\Service;

use App\PaymentProcessor\PaymentProcessor;
use Symfony\Component\DependencyInjection\ServiceLocator;

class PurchaseProcessor
{
    public function __construct(
        protected ServiceLocator $serviceLocator,
        protected PriceCalculator $priceCalculator
    ) {
    }

    public function purchase(float $amount, string $paymentProcessorAlias): void
    {
        /** @var PaymentProcessor $paymentProcessor */
        $paymentProcessor = $this->serviceLocator->get($paymentProcessorAlias);
        $paymentProcessor->process($amount);
    }
}