<?php

namespace App\Locations\Countries\Domain\Exception;

use DomainException;

class InternalErrorException extends DomainException {

    /** @var string */
    private const ERROR_CODE = 'INTERNAL_ERROR';

    public function __construct() {
        parent::__construct('Error code: 500');
    }

    /**
     * @return string
     */
    public function errorCode(): string {
        return self::ERROR_CODE;
    }
}