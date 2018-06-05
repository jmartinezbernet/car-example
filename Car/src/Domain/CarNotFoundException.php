<?php

namespace Car\Domain;

class CarNotFoundException extends \DomainException
{
    public static function withId(string $id)
    {
        return new self("Car with id '" . $id ."' not found.");
    }
}