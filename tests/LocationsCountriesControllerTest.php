<?php

namespace App\Tests;

use App\Controller\LocationsCountriesController;
use App\Locations\Countries\Application\CommandHandlers\UpdateCountryCommand;
use App\Locations\Countries\Application\CommandHandlers\UpdateCountryCommandHandler;
use App\Locations\Countries\Application\QueryHandlers\CountriesQueryCriteria;
use App\Locations\Countries\Application\QueryHandlers\CountriesResponse;
use App\Locations\Countries\Application\QueryHandlers\FetchCountriesQueryHandler;
use App\Locations\Countries\Domain\Model\Entities\Country;
use App\Locations\Countries\Domain\Model\Entities\CountryCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//TODO test exceptions handling, use fixtures
class LocationsCountriesControllerTest extends TestCase {

    /**
     * @var MockObject|FetchCountriesQueryHandler
     */
    private $countriesQueryHandlerMock;

    /** @var MockObject|UpdateCountryCommandHandler */
    private $updateCountryCommandHandlerMock;

    /** @var MockObject|ContainerInterface */
    private $containerInterfaceMock;

    /** @var Request */
    private $requestMock;

    /** @var LocationsCountriesController */
    private $testObject;

    public function setUp(): void {
        $this->countriesQueryHandlerMock = $this->getMockBuilder(FetchCountriesQueryHandler::class)->disableOriginalConstructor()->getMock();
        $this->updateCountryCommandHandlerMock = $this->getMockBuilder(UpdateCountryCommandHandler::class)->disableOriginalConstructor()->getMock();

        $this->testObject = new LocationsCountriesController(
            $this->countriesQueryHandlerMock,
            $this->updateCountryCommandHandlerMock
        );

        $this->containerInterfaceMock = $this->getMockBuilder(ContainerInterface::class)->disableOriginalConstructor()->getMock();
        $this->requestMock = $this->prophesize(Request::class);
    }

    public function testGetCountriesSuccessfully(): void {
        $countryCollection = $this->getCountryCollection(null);
        $countryResponse = new CountriesResponse($countryCollection);

        $this->mockContainerInterfaceCalls();
        $this->countriesQueryHandlerMock->expects(self::once())
                                        ->method('handle')
                                        ->with(new CountriesQueryCriteria([]))
                                        ->willReturn($countryResponse);

        $actualResponse = $this->getTestObject()->getAll();

        self::assertInstanceOf(JsonResponse::class, $actualResponse);
        self::assertEquals(Response::HTTP_OK, $actualResponse->getStatusCode());
        self::assertSame($this->expectedFetchCountriesResponse($countryCollection), $actualResponse->getContent());
    }

    public function testGetCountriesSuccessfullyByCode(): void {
        $searchCode = 'RO';
        $countryCollection = $this->getCountryCollection($searchCode);
        $countryResponse = new CountriesResponse($countryCollection);

        $this->mockContainerInterfaceCalls();
        $this->requestMock->get('code')->willReturn($searchCode);
        $this->countriesQueryHandlerMock->expects(self::once())
                                        ->method('handle')
                                        ->with(new CountriesQueryCriteria(['code' => $searchCode]))
                                        ->willReturn($countryResponse);

        $actualResponse = $this->getTestObject()->findByCode($this->requestMock->reveal());

        self::assertInstanceOf(JsonResponse::class, $actualResponse);
        self::assertEquals(Response::HTTP_OK, $actualResponse->getStatusCode());
        self::assertSame($this->expectedFetchCountriesResponse($countryCollection), $actualResponse->getContent());
    }

    public function testUpdateCountrySuccessfully(): void {
        $countryId = 1;
        $countryName = 'Romania';
        $countryCode = 'RO';
        $countryPrefix = '+04000';

        $this->mockContainerInterfaceCalls();
        $this->requestMock->getContent()->willReturn(json_encode([
            'id' => $countryId,
            'name' => $countryName,
            'code' => $countryCode,
            'prefix' => $countryPrefix,
        ]));
        $this->updateCountryCommandHandlerMock->expects(self::once())
                                              ->method('handle')
                                              ->with(new UpdateCountryCommand(
                                                  $countryId,
                                                  $countryName,
                                                  $countryCode,
                                                  $countryPrefix
                                              ));

        $actualResponse = $this->getTestObject()->update($this->requestMock->reveal());

        self::assertInstanceOf(JsonResponse::class, $actualResponse);
        self::assertSame('[]', $actualResponse->getContent());
        self::assertEquals(Response::HTTP_NO_CONTENT, $actualResponse->getStatusCode());
    }

    private function getCountryCollection(?string $code): CountryCollection {
        if ($code) {
            return new CountryCollection([new Country(1, 'Romania', $code, '+40')]);
        }

        return new CountryCollection(
            [
                new Country(1, 'Romania', 'RO', '+40'),
                new Country(2, 'Finlanda', 'FI', '+358'),
            ]
        );
    }

    private function mockContainerInterfaceCalls(): void {
        $this->containerInterfaceMock
            ->expects(self::once())
            ->method('has')
            ->with('serializer')
            ->willReturn(false);
    }

    private function getTestObject(): LocationsCountriesController {
        $this->testObject->setContainer($this->containerInterfaceMock);

        return $this->testObject;
    }

    private function expectedFetchCountriesResponse(CountryCollection $countryCollection): string {
        $countries = [];

        foreach ($countryCollection->getCountries() as $country) {
            $countries[] = $country->toPrimitives();
        }

        return json_encode([
            'results' => $countries,
            'meta' => [
                'count' => $countryCollection->length(),
            ],
        ], true);
    }
}