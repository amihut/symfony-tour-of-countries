<?php

namespace App\Locations\Countries\Domain\Model\Entities;

class CountryCollection {

    /** @var Country[] */
    private $countries;

    /**
     * @param array $countries
     */
    public function __construct(array $countries) {
        $this->countries = $countries;
    }

    /**
     * @return Country[]
     */
    public function getCountries(): array {
        return $this->countries;
    }

    /**
     * @return int
     */
    public function length(): int {
        return count($this->countries);
    }

    /**
     * @return int
     */
    public function lengthComments(): int {
        $count = 0;

        foreach ($this->countries as $country) {
            $count += $country->countComments();
        }

        return $count;
    }
}