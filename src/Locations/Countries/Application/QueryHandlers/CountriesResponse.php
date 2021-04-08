<?php

namespace App\Locations\Countries\Application\QueryHandlers;

use App\Locations\Countries\Domain\Model\Entities\Country;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;
use function Lambdish\Phunctional\map;

class CountriesResponse {

    /** @var array */
    private $response;
    /** @var array */
    private $meta;

    /**
     * @param CountryCollection $collection
     */
    public function __construct(CountryCollection $collection) {
        $this->response = map($this->toResponse(), $collection->getCountries());
        $this->meta = [
            'count' => $collection->length(),
            'commentsCount' => $collection->lengthComments()
        ];
    }

    /**
     * @return callable
     */
    private function toResponse(): callable {
        return static function (Country $country) {
            return $country->toPrimitives();
        };
    }

    /**
     * @return array
     */
    public function response(): array {
        return $this->response;
    }

    /**
     * @return array
     */
    public function meta(): array {
        return $this->meta;
    }
}
