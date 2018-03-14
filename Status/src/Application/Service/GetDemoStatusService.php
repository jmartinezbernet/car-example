<?php

namespace Status\Application\Service;

use Ddd\Application\Service\ApplicationService;
use Status\Application\Query\FindDemoByIdQuery;

class GetDemoStatusService implements ApplicationService
{
    /**
     * @var FindDemoByIdQuery
     */
    private $findDemoByIdQuery;

    /**
     * GetDemoStatusService constructor.
     * @param FindDemoByIdQuery $findDemoByIdQuery
     */
    public function __construct(
        FindDemoByIdQuery $findDemoByIdQuery
    )
    {
        $this->findDemoByIdQuery = $findDemoByIdQuery;
    }

    /**
     * @param GetDemoStatusRequest $request
     * @return mixed
     */
    public function execute($request = null)
    {
        $demo = $this->findDemoByIdQuery->find($request->id());

        return $demo;
    }
}