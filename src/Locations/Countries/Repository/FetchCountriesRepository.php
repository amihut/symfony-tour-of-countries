<?php

namespace App\Locations\Countries\Repository;

use App\Locations\Countries\Domain\Exception\CountriesNotFoundException;
use App\Locations\Countries\Domain\Model\Denormalizers\IFetchCountriesDenormalizer;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;
use App\Locations\Countries\Domain\Model\Ports\IFetchCountriesRepository;
use App\Repository\LocationsCountriesRepository;
use Doctrine\Persistence\ManagerRegistry;

class FetchCountriesRepository extends LocationsCountriesRepository implements IFetchCountriesRepository {

    /** @var IFetchCountriesDenormalizer */
    private $denormalizer;

    /**
     * @param ManagerRegistry $registry
     * @param IFetchCountriesDenormalizer $denormalizer
     */
    public function __construct(ManagerRegistry $registry, IFetchCountriesDenormalizer $denormalizer) {
        parent::__construct($registry);

        $this->denormalizer = $denormalizer;
    }

    /**
     * @inheritDoc
     */
    public function findMatching(
        array $criteria,
        ?array $order = null,
        ?int $limit = null,
        ?int $offset = null
    ): CountryCollection {
        $results = $this->findBy($criteria, $order, $limit, $offset);

        if (empty($results)) {
            throw new CountriesNotFoundException();
        }

        return $this->denormalizer->denormalize($results);
    }
}