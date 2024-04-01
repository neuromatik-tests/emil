<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = (new Product())
            ->setName('iPhone')
            ->setPrice(1000);
        $manager->persist($product);

        $product = (new Product())
            ->setName('AirPods')
            ->setPrice(300);
        $manager->persist($product);

        $product = (new Product())
            ->setName('iCase')
            ->setPrice(100);
        $manager->persist($product);

        $manager->flush();
    }
}
