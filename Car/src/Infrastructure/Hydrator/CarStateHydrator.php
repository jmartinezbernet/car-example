<?php

namespace Car\Infrastructure\Hydrator;

use Car\Domain\CarState;

class CarStateHydrator
{
    public function hydrate(array $data): CarState
    {
        return new CarState(
            $data['id'],
            $data['brand'],
            $data['model']
        );
    }

    public function extract(CarState $carState): array
    {
        return [
            'id' => $carState->id(),
            'brand' => $carState->brand(),
            'model' => $carState->model()
        ];
    }
}