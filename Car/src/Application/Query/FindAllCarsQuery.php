<?php

namespace Car\Application\Query;

interface FindAllCarsQuery
{
    public function find(): ?array;
}