<?php

namespace App\Service;

use App\Constant\CouponType;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;

class PriceCalculator
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CouponRepository $couponRepository,
        protected TaxesGetter $taxesGetter
    ) {
    }

    public function calculate(float $price, string $taxNumber, string $couponCode = ''): float
    {
        if ($couponCode) {
            $price = $this->applyCoupon($price, $couponCode);
        }
        return $this->applyTaxes($price, $taxNumber);
    }

    protected function applyCoupon(float $price, string $couponCode): float
    {
        $coupon = $this->couponRepository->findOneBy(['code' => $couponCode]);
        if ($coupon) {
            $price = match ($coupon->getType()) {
                CouponType::FIXED => ($newPrice = $price - $coupon->getAmount()) > 0 ? $newPrice : 0,
                CouponType::PERCENTAGE => ($price * (1 - ($coupon->getAmount() / 100)))
            };
        }
        return $price;
    }

    protected function applyTaxes(float $price, string $taxNumber): float
    {
        $tax = $this->taxesGetter->getTaxByNumber($taxNumber);
        return $price * ($tax->getTaxAmount() / 100 + 1);
    }
}