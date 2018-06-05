<?php

namespace Car\Domain;

use Assert\Assertion;

class Car
{
    /**
     * @param CarRepository $carRepository
     * @param CarNotExistsSpecification $carNotExistsSpecification
     * @param $brand
     * @param $model
     * @return CarState
     * @throws \Assert\AssertionFailedException
     */
    public static function create(
        CarRepository $carRepository,
        CarNotExistsSpecification $carNotExistsSpecification,
        $brand,
        $model
    )
    {
        Assertion::notEmpty($brand, "Brand can be empty.");
        Assertion::notEmpty($model, "Model can be empty.");

        $specificationObject = [
            'brand' => $brand,
            'model' => $model
        ];

        if (!$carNotExistsSpecification->isSatisfiedBy($specificationObject)) {
            throw CarCannotBeRegisteredException::withError("Car cannot be registered.");
        }

        $id = $carRepository->nextId();

        $carState = new CarState(
            $id,
            $brand,
            $model
        );

        return $carState;
    }
}