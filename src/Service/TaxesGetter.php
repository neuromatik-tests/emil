<?php

namespace App\Service;

use App\Entity\TaxCountry;
use App\Repository\TaxCountryRepository;

class TaxesGetter
{
    public function __construct(
        protected TaxCountryRepository $taxCountryRepository
    ) {
    }

    public function getTaxByNumber(string $taxCode): ?TaxCountry
    {
        $countryCode = substr($taxCode, 0, 2);
        return $this->taxCountryRepository->findOneBy(['countryCode' => $countryCode]);
    }
}