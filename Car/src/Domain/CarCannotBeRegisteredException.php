<?php

namespace Car\Domain;

class CarCannotBeRegisteredException extends \DomainException
{
    public static function withError(string $error)
    {
        return new self($error);
    }
}