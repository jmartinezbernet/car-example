<?php

namespace Car\Infrastructure\Query\InMemory;


use Car\Application\Query\FindAllCarsQuery;

class InMemoryFindAllCarsQuery implements FindAllCarsQuery
{
    /**
     * @var array
     */
    private $carList;

    public static function withFixedCars(array ...$cars)
    {
        $carList = [];

        foreach ($cars as $car) {
            $carList[$car['id']] = $car;
        }

        return new self($carList);
    }

    public function __construct(array $carList)
    {
        $this->carList = $carList;
    }

    public function find(): ?array
    {
        return $this->carList;
    }
}