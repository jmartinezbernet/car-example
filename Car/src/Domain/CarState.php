<?php

namespace Car\Domain;

class CarState
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $model;

    /**
     * CarState constructor.
     * @param string $id
     * @param string $brand
     * @param string $model
     */
    public function __construct(
        string $id,
        string $brand,
        string $model
    )
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
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