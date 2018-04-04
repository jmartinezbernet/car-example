<?php

namespace CarTest\Application;

use Car\Application\Service\RegisterCarRequest;
use Car\Application\Service\RegisterCarService;
use Car\Domain\CarCannotBeRegisteredException;
use Car\Domain\CarNotExistsSpecification;
use Car\Domain\CarRepository;
use Car\Infrastructure\Persistence\InMemory\InMemoryCarRepository;
use Car\Infrastructure\Query\InMemory\InMemoryFindCarsByCriteriaQuery;
use PHPUnit\Framework\TestCase;

class RegisterCarServiceTest extends TestCase
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * @var RegisterCarService
     */
    private $registerCarService;

    /**
     * @var CarNotExistsSpecification
     */
    private $carNotExistsSpecification;

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
        $this->carRepository = InMemoryCarRepository::withFixedCars(
            $carDataTest1,
            $carDataTest2,
            $carDataTest3
        );

        $this->carNotExistsSpecification = new CarNotExistsSpecification(
            InMemoryFindCarsByCriteriaQuery::withFixedCars($carDataTest1, $carDataTest2, $carDataTest3)
        );

        $this->registerCarService = new RegisterCarService(
            $this->carRepository,
            $this->carNotExistsSpecification
        );
    }

    /**
     * @test
     * @throws \Assert\AssertionFailedException
     */
    public function AfterRegisterACarShouldBeInRepository()
    {
        $request = new RegisterCarRequest(
            'Audi',
            'A5'
        );

        $registeredCarId = $this->registerCarService->execute($request);

        $this->assertNotNull($this->carRepository->ofId($registeredCarId));
    }

    /**
     * @test
     * @throws \Assert\AssertionFailedException
     */
    public function shouldFailOnInvalidArgument()
    {
        $request = new RegisterCarRequest(
            '',
            ''
        );

        $this->expectException(\InvalidArgumentException::class);

        $this->registerCarService->execute($request);
    }

    /**
     * @test
     * @throws \Assert\AssertionFailedException
     */
    public function shouldFailIfModelAlreadyExistsForTheGivenBrand()
    {
        $request = new RegisterCarRequest(
            'Audi',
            'A3'
        );

        $this->expectException(CarCannotBeRegisteredException::class);

        $this->registerCarService->execute($request);
    }
}