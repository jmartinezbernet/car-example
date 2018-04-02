<?php

namespace Car\Application\Service;

use Car\Application\Query\FindAllCarsQuery;
use Ddd\Application\Service\ApplicationService;

class GetCarsService implements ApplicationService
{
    /**
     * @var FindAllCarsQuery
     */
    private $findAllCarsQuery;

    /**
     * GetCarsService constructor.
     * @param FindAllCarsQuery $findAllCarsQuery
     */
    public function __construct(
        FindAllCarsQuery $findAllCarsQuery
    )
    {
        $this->findAllCarsQuery = $findAllCarsQuery;
    }

    /**
     * @param GetCarsRequest $request
     * @return mixed
     */
    public function execute($request = null)
    {

        return $this->findAllCarsQuery->find();
    }
}