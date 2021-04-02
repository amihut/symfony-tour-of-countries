<?php

namespace App\Repository;

use App\Entity\LocationsCountries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationsCountries|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationsCountries|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationsCountries[]    findAll()
 * @method LocationsCountries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationsCountriesRepository extends ServiceEntityRepository {

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, LocationsCountries::class);
    }
}
