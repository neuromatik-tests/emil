<?php

namespace App\DataFixtures;

use App\Constant\CouponType;
use App\Entity\Coupon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $coupon = (new Coupon())
            ->setName('Fixed20')
            ->setAmount(20)
            ->setCode('fixed20')
            ->setType(CouponType::FIXED);
        $manager->persist($coupon);

        $coupon = (new Coupon())
            ->setName('Percentage6')
            ->setAmount(6)
            ->setCode('perc6')
            ->setType(CouponType::PERCENTAGE);
        $manager->persist($coupon);

        $manager->flush();
    }
}
