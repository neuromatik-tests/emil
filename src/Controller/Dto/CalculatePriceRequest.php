<?php

namespace App\Controller\Dto;

use App\Validation\CouponExists;
use App\Validation\ProductExists;
use App\Validation\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceRequest
{
    #[Assert\NotNull]
    #[Assert\GreaterThan(value: 0)]
    #[ProductExists]
    protected int $productId;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[TaxNumber]
    protected string $taxNumber = '';

    #[Assert\Type(type: 'string')]
    #[CouponExists]
    protected string $couponCode = '';

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode;
    }

    public function setCouponCode(string $couponCode): self
    {
        $this->couponCode = $couponCode;
        return $this;
    }
}