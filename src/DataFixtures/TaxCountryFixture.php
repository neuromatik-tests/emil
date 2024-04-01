<?php

namespace App\DataFixtures;

use App\Entity\TaxCountry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxCountryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tax = (new TaxCountry())
            ->setTaxAmount(22)
            ->setCountryCode('IT')
            ->setCountryName('Italy');
        $manager->persist($tax);

        $tax = (new TaxCountry())
            ->setTaxAmount(19)
            ->setCountryCode('DE')
            ->setCountryName('Germany');

        $tax = (new TaxCountry())
            ->setTaxAmount(24)
            ->setCountryCode('GR')
            ->setCountryName('Greece');
        $manager->persist($tax);


        $manager->flush();
    }
}
