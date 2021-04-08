<?php

namespace App\Locations\Countries\Repository;

use App\Entity\LocationsCountriesComments;
use App\Locations\Countries\Domain\Model\Denormalizers\IFetchCountriesDenormalizer;
use App\Locations\Countries\Domain\Model\Entities\Country;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;
use function Lambdish\Phunctional\map;

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
                $result->getPrefix(),
                map($this->countryComments(), $result->getLocationsCountriesComments())
            );
        }

        return new CountryCollection($countries);
    }

    /**
     * @return callable
     */
    private function countryComments(): callable {
        return static function (LocationsCountriesComments $comment) {
            return $comment->getComment();
        };
    }
}