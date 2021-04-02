<?php

namespace App\Locations\Countries\Domain\Exception;

use DomainException;

class CountriesNotFoundException extends DomainException {

    /** @var string */
    private const ERROR_CODE = 'COUNTRY_NOT_FOUND';

    public function __construct() {
        parent::__construct('Country not found!');
    }

    /**
     * @return string
     */
    public function errorCode(): string {
        return self::ERROR_CODE;
    }
}