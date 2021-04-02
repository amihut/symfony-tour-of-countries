<?php

namespace App\Locations\Countries\Repository;

use App\Locations\Countries\Domain\Exception\CountriesNotFoundException;
use App\Locations\Countries\Domain\Exception\InternalErrorException;
use App\Locations\Countries\Domain\Model\Ports\IStoreCountriesRepository;
use App\Repository\LocationsCountriesRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class StoreCountriesRepository extends LocationsCountriesRepository implements IStoreCountriesRepository {

    /**
     * @inheritDoc
     */
    public function update(int $id, ?string $code, ?string $name, ?string $prefix): void {
        $country = $this->find($id);

        if (!$country) {
            throw new CountriesNotFoundException();
        }

        if ($code) {
            $country->setCode($code);
        }

        if ($name) {
            $country->setName($name);
        }

        if ($prefix) {
            $country->setPrefix($prefix);
        }

        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            throw new InternalErrorException();
        }

    }
}