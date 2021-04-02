<?php

namespace App\Locations\Countries\Domain\Model\Ports;

use App\Locations\Countries\Domain\Exception\CountriesNotFoundException;
use App\Locations\Countries\Domain\Exception\InternalErrorException;

interface IStoreCountriesRepository {

    /**
     * @param int $id
     * @param string|null $code
     * @param string|null $name
     * @param string|null $prefix
     * @throws CountriesNotFoundException | InternalErrorException
     */
    public function update(int $id, ?string $code, ?string $name, ?string $prefix): void;
}