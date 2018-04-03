<?php

namespace Car\Domain;

use Assert\Assertion;

class Car
{
    /**
     * @param CarRepository $carRepository
     * @param $brand
     * @param $model
     * @return CarState
     * @throws \Assert\AssertionFailedException
     */
    public static function create(
        CarRepository $carRepository,
        $brand,
        $model
    )
    {
        Assertion::notEmpty($brand, "Sorry brand can be empty.");
        Assertion::notEmpty($model, "Sorry model can be empty.");
        $id = $carRepository->nextId();

        $carState = new CarState(
            $id,
            $brand,
            $model
        );

        return $carState;
    }
}