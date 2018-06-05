<?php

namespace Car\Application\Service;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Ddd\Application\Service\ApplicationService;

class GetCarsService implements ApplicationService
{
    /**
     * @var FindCarsByCriteriaQuery
     */
    private $findCarsByCriteriaQuery;

    /**
     * GetCarsService constructor.
     * @param FindCarsByCriteriaQuery $findCarsByCriteriaQuery
     */
    public function __construct(
        FindCarsByCriteriaQuery $findCarsByCriteriaQuery
    )
    {
        $this->findCarsByCriteriaQuery = $findCarsByCriteriaQuery;
    }

    /**
     * @param GetCarsRequest $request
     * @return mixed
     */
    public function execute($request = null)
    {

        return $this->findCarsByCriteriaQuery->find($request->criteria());
    }
}