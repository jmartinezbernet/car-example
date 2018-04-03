<?php

namespace Car\Application\Service;

class RegisterCarRequest
{
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $model;

    /**
     * RegisterCarRequest constructor.
     * @param string $brand
     * @param string $model
     */
    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function brand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return $this->model;
    }
}