<?php

namespace App\Repository;

use App\Entity\LocationsCountriesComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationsCountriesComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationsCountriesComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationsCountriesComments[]    findAll()
 * @method LocationsCountriesComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationsCountriesCommentsRepository extends ServiceEntityRepository {

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, LocationsCountriesComments::class);
    }

    /**
     * @return EntityManager|EntityManagerInterface|ClassMetadata
     */
    public function getEm(): EntityManagerInterface {
        return $this->_em;
    }
}
