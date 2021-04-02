<?php

namespace App\Controller;

use App\Locations\Countries\Application\CommandHandlers\UpdateCountryCommand;
use App\Locations\Countries\Application\CommandHandlers\UpdateCountryCommandHandler;
use App\Locations\Countries\Application\QueryHandlers\CountriesQueryCriteria;
use App\Locations\Countries\Application\QueryHandlers\FetchCountriesQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//TODO normalize and validate request data, handle exceptions
class LocationsCountriesController extends AbstractController {

    /**
     * @var FetchCountriesQueryHandler
     */
    private $countriesQueryHandler;

    /**
     * @var UpdateCountryCommandHandler
     */
    private $updateCountryCommandHandler;

    /**
     * @param FetchCountriesQueryHandler $countriesQueryHandler
     * @param UpdateCountryCommandHandler $updateCountryCommandHandler
     */
    public function __construct(
        FetchCountriesQueryHandler $countriesQueryHandler,
        UpdateCountryCommandHandler $updateCountryCommandHandler
    ) {
        $this->countriesQueryHandler = $countriesQueryHandler;
        $this->updateCountryCommandHandler = $updateCountryCommandHandler;
    }

    /**
     * @Route("api/locations/countries", name="api_locations_countries_get_all", methods={"GET"})
     * @return Response
     */
    public function getAll(): Response {
        $countriesResponse = $this->countriesQueryHandler->handle(new CountriesQueryCriteria([]));

        return $this->json([
            'results' => $countriesResponse->response(),
            'meta' => $countriesResponse->meta(),
        ]);
    }

    /**
     * @Route("api/locations/countries/id/{id}", name="api_locations_countries_get_country", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function findById(Request $request): Response {
        $countriesResponse = $this->countriesQueryHandler->handle(
            new CountriesQueryCriteria(['id' => $request->get('id')])
        );

        return $this->json([
            'results' => $countriesResponse->response(),
            'meta' => $countriesResponse->meta(),
        ]);
    }

    /**
     * @Route("api/locations/countries/code/{code}", name="api_locations_countries_get_country_by_code", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function findByCode(Request $request): Response {
        $countriesResponse = $this->countriesQueryHandler->handle(
            new CountriesQueryCriteria(['code' => $request->get('code')])
        );

        return $this->json([
            'results' => $countriesResponse->response(),
            'meta' => $countriesResponse->meta(),
        ]);
    }

    /**
     * @Route("api/locations/countries/id/{id}", name="api_locations_countries_update_country", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response {
        $parameterBag = new ParameterBag(json_decode($request->getContent(), true));

        $this->updateCountryCommandHandler->handle(
            new UpdateCountryCommand(
                $parameterBag->get('id'),
                $parameterBag->get('name'),
                $parameterBag->get('code'),
                $parameterBag->get('prefix')
            )
        );

        //TODO handle error status code. One way is to implement an ApiExceptionListener and ApiExceptionsHttpStatusCodeMapping
        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}