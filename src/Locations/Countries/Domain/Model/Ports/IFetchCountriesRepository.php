<?php

namespace App\Locations\Countries\Domain\Model\Ports;

use App\Locations\Countries\Domain\Exception\CountriesNotFoundException;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;

interface IFetchCountriesRepository {

    /**
     * @param array $criteria
     * @param array|null $order
     * @param int|null $offset
     * @param int|null $limit
     * @throws CountriesNotFoundException
     * @return CountryCollection
     */
    public function findMatching(array $criteria, ?array $order = null, ?int $limit = null, ?int $offset = null): CountryCollection;
}