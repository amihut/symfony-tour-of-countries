<?php

namespace App\DataFixtures;

use App\Entity\LocationsCountries;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocationsCountriesFixtures extends Fixture {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 10; $i++) {
            $country = new LocationsCountries();
            $country->setName('Romania');
        }

        $manager->flush();
    }
}