<?php

namespace Car\Application\Service;

use Car\Domain\Car;
use Car\Domain\CarNotExistsSpecification;
use Car\Domain\CarRepository;
use Ddd\Application\Service\ApplicationService;

class RegisterCarService implements ApplicationService
{
    /**
     * @var CarRepository
     */
    private $carRepository;
    /**
     * @var CarNotExistsSpecification
     */
    private $carNotExistsSpecification;

    /**
     * RegisterCarService constructor.
     * @param CarRepository $carRepository
     * @param CarNotExistsSpecification $carNotExistsSpecification
     */
    public function __construct(
        CarRepository $carRepository,
        CarNotExistsSpecification $carNotExistsSpecification
    )
    {

        $this->carRepository = $carRepository;
        $this->carNotExistsSpecification = $carNotExistsSpecification;
    }

    /**
     * @param RegisterCarRequest $request
     * @return mixed
     * @throws \Assert\AssertionFailedException
     */
    public function execute($request = null)
    {
        $carState = Car::create(
            $this->carRepository,
            $this->carNotExistsSpecification,
            $request->brand(),
            $request->model()
        );

        $this->carRepository->save($carState);

        return $carState->id();
    }
}