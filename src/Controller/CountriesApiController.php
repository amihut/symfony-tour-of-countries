<?php

namespace App\Controller;

use App\Entity\LocationsCountriesComments;
use App\Repository\LocationsCountriesCommentsRepository;
use App\Repository\LocationsCountriesRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CountriesApiController
 *
 * @package App\Controller
 *
 * This is written just for testing purposes using the symfony approach with orm.
 * I recommend building your web services / micro services based on a strong architecture pattern, make it simple & scalable, using SOLID, design patterns, etc
 */
class CountriesApiController extends AbstractController {

    /**
     * @var ServiceEntityRepositoryInterface
     */
    private $locationsCountriesRepository;

    /**
     * @var ServiceEntityRepositoryInterface
     */
    private $locationsCountriesCommentsRepository;

    /**
     * CountriesApiController constructor.
     *
     * @param LocationsCountriesRepository $locationsCountriesRepository
     * @param LocationsCountriesCommentsRepository $locationsCountriesCommentsRepository
     */
    public function __construct(
        LocationsCountriesRepository $locationsCountriesRepository,
        LocationsCountriesCommentsRepository $locationsCountriesCommentsRepository
    ) {
        $this->locationsCountriesRepository = $locationsCountriesRepository;
        $this->locationsCountriesCommentsRepository = $locationsCountriesCommentsRepository;
    }

    /**
     * @Route("api/locations/countries/comments", name="api_locations_countries_add_comment", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addCountryComment(Request $request): Response {
        $parameterBag = new ParameterBag(json_decode($request->getContent(), true));
        $country = $this->locationsCountriesRepository->find($parameterBag->get('id'));

        if (!$country) {
            // throw an exception instead and wire an exception listener
            return new Response('Country Not Found', Response::HTTP_NOT_FOUND);
        }

        try {
            $comment = new LocationsCountriesComments();
            $comment->setComment($parameterBag->get('comment'));
            $comment->setLocationsCountries($country);

            $em = $this->locationsCountriesCommentsRepository->getEm();

            $em->persist($comment);
            $em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            return new Response('Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('OK', Response::HTTP_OK);
    }

    /**
     * @Route("api/locations/countries/id/{id}", name="api_locations_countries_delete_country", methods={"DELETE"})
     * @param Request $request
     * @return Response
     */
    public function deleteCountry(Request $request): Response {
        $country = $this->locationsCountriesRepository->find($request->get('id'));

        if (!$country) {
            return new Response('Country Not Found', Response::HTTP_NOT_FOUND);
        }

        try {
            $em = $this->locationsCountriesRepository->getEm();

            $em->remove($country);
            $em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            return new Response('Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Accepted', Response::HTTP_ACCEPTED);
    }
}