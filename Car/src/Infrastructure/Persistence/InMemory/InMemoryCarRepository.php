<?php

namespace Car\Infrastructure\Persistence\InMemory;

use Car\Domain\CarNotFoundException;
use Car\Domain\CarRepository;
use Car\Domain\CarState;
use Ramsey\Uuid\Uuid;

class InMemoryCarRepository implements CarRepository
{
    /**
     * @var CarState[]
     */
    private $carList;

   public static function withFixedCars(array ...$carList)
    {
        $inMemoryCarList = [];

        foreach ($carList as $car) {
            $inMemoryCarList[$car['id']] = new CarState($car['id'], $car['brand'], $car['model']);
        }

        return new self($inMemoryCarList);
    }

    public function __construct(array $carList)
    {
        $this->carList = $carList;
    }

    public function ofId(string $id): ?CarState
    {
        if (!isset($this->carList[$id])) {
            throw CarNotFoundException::withId($id);
        }

        return $this->carList[$id];
    }

    public function save(CarState $carState): void
    {
        $this->carList[$carState->id()] = $carState;
    }

    public function nextId(): string
    {
        return Uuid::uuid4()->toString();
    }
}