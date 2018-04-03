<?php

namespace CarTests\Application;

use Car\Application\Service\GetCarsRequest;
use Car\Application\Service\GetCarsService;
use Car\Infrastructure\Query\InMemory\InMemoryFindCarsByCriteriaQuery;
use PHPUnit\Framework\TestCase;

class GetCarsServiceTest extends TestCase
{
    /**
     * @var GetCarsService
     */
    private $getCarsService;

    public function setUp()
    {
        $carDataTest1 = [
            'id' => 'an id1',
            'brand' => 'Renault',
            'model' => 'Megane'
        ];

        $carDataTest2 = [
            'id' => 'an id2',
            'brand' => 'Audi',
            'model' => 'A4'
        ];

        $carDataTest3 = [
            'id' => 'an id3',
            'brand' => 'Audi',
            'model' => 'A3'
        ];

        $findAllCarsQuery = InMemoryFindCarsByCriteriaQuery::withFixedCars(
            $carDataTest1,
            $carDataTest2,
            $carDataTest3
    );

        $this->getCarsService = new GetCarsService(
            $findAllCarsQuery
        );
    }

    /**
     * @test
     */
    public function shouldReturnAListOfCarsWithThreeCars()
    {
        $request = new GetCarsRequest(
            [],
            [],
            1,
            3
        );

        $result = $this->getCarsService->execute($request);

        $this->assertEquals(3, $result->resultCount());
    }
}