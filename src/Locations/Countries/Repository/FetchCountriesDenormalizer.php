<?php

namespace App\Locations\Countries\Repository;

use App\Locations\Countries\Domain\Model\Denormalizers\IFetchCountriesDenormalizer;
use App\Locations\Countries\Domain\Model\Entities\Country;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;

class FetchCountriesDenormalizer implements IFetchCountriesDenormalizer {

    /**
     * @inheritDoc
     */
    public function denormalize(array $results): CountryCollection {
        $countries = [];

        foreach ($results as $result) {
            $countries[] = new Country(
                $result->getId(),
                $result->getName(),
                $result->getCode(),
                $result->getPrefix()
            );
        }

        return new CountryCollection($countries);
    }
}