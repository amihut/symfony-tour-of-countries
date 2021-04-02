<?php

namespace App\Locations\Countries\Application\QueryHandlers;

use App\Locations\Countries\Domain\Model\Ports\IFetchCountriesRepository;

class FetchCountriesQueryHandler {

    /**
     * @var IFetchCountriesRepository
     */
    private $repository;

    /**
     * @param IFetchCountriesRepository $repository
     */
    public function __construct(IFetchCountriesRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param CountriesQueryCriteria $searchCriteria
     * @return CountriesResponse
     */
    public function handle(CountriesQueryCriteria $searchCriteria): CountriesResponse {
        $countryCollection = $this->repository->findMatching(
            $searchCriteria->getFilters(),
            $searchCriteria->getOrder(),
            $searchCriteria->getLimit(),
            $searchCriteria->getOffset()
        );

        return new CountriesResponse($countryCollection);
    }
}