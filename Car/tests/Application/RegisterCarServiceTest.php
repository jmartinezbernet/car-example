<?php

namespace CarTest\Application;

use Car\Application\Service\RegisterCarRequest;
use Car\Application\Service\RegisterCarService;
use Car\Domain\CarRepository;
use Car\Infrastructure\Persistence\InMemory\InMemoryCarRepository;
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

        $this->registerCarService = new RegisterCarService(
            $this->carRepository
        );
    }

    /**
     * @test
     */
    public function AfterRegisterACarShouldBeInRepository()
    {
        $request = new RegisterCarRequest(
            'Audi',
            'A4'
        );

        $registeredCarId = $this->registerCarService->execute($request);

        $this->assertNotNull($this->carRepository->ofId($registeredCarId));
    }
}