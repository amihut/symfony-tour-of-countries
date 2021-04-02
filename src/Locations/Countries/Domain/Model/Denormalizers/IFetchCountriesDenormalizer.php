<?php

namespace App\Locations\Countries\Domain\Model\Denormalizers;

use App\Entity\LocationsCountries;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;

interface IFetchCountriesDenormalizer {

    /**
     * @param LocationsCountries[] $results
     * @return CountryCollection
     */
    public function denormalize(array $results): CountryCollection;
}