<?php

namespace Car\Domain;

interface CarRepository
{
    public function ofId(string $id): ?CarState;

    public function save(CarState $carState): void;

    public function nextId(): string;
}