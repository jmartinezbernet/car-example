<?php

namespace Car\Application\Service;

use Car\Domain\Car;
use Car\Domain\CarRepository;
use Ddd\Application\Service\ApplicationService;

class RegisterCarService implements ApplicationService
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * RegisterCarService constructor.
     * @param CarRepository $carRepository
     */
    public function __construct(
        CarRepository $carRepository
    )
    {

        $this->carRepository = $carRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request = null)
    {
        $carState = Car::create(
            $this->carRepository,
            $request->brand(),
            $request->model()
        );

        $this->carRepository->save($carState);

        return $carState->id();
    }
}