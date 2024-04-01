<?php

namespace App\Tests\Service;

use App\Service\PriceCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceCalculatorTest extends KernelTestCase
{
    /**
     * @dataProvider priceProvider
     */
    public function testCalculation(float $price, string $taxNumber, string $coupon, float $expected)
    {
        self::bootKernel(['environment' => 'test']);
        $container = static::getContainer();
        $priceCalculator = $container->get(PriceCalculator::class);
        $price = $priceCalculator->calculate($price, $taxNumber, $coupon);
        $this->assertEquals($expected, $price);
    }

    public function priceProvider(): array
    {
        return [
            [
                100,
                'GR123',
                '',
                124
            ],
            [
                100,
                'GR123',
                'perc6',
                116.56
            ]
        ];
    }
}