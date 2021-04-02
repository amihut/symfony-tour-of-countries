<?php

namespace App\Locations\Countries\Application\CommandHandlers;

use App\Locations\Countries\Domain\Model\Ports\IStoreCountriesRepository;

class UpdateCountryCommandHandler {

    /**
     * @var IStoreCountriesRepository
     */
    private $repository;

    /**
     * @param IStoreCountriesRepository $repository
     */
    public function __construct(IStoreCountriesRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param UpdateCountryCommand $command
     */
    public function handle(UpdateCountryCommand $command): void {
        $this->repository->update(
            $command->getId(),
            $command->getCode(),
            $command->getName(),
            $command->getPrefix()
        );
    }
}