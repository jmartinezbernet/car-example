<?php

namespace Car\Domain;

class Car
{
    public static function create(
        CarRepository $carRepository,
        $brand,
        $model
    )
    {
        $id = $carRepository->nextId();

        $carState = new CarState(
            $id,
            $brand,
            $model
        );

        return $carState;
    }
}