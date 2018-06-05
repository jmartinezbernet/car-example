<?php

namespace Car\Domain;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Common\Query\QueryCriteria;
use Ddd\Domain\Specification\AbstractSpecification;

class CarNotExistsSpecification extends AbstractSpecification
{
    /**
     * @var FindCarsByCriteriaQuery
     */
    private $findCarsByCriteriaQuery;

    /**
     * CarNotExistsSpecification constructor.
     * @param FindCarsByCriteriaQuery $findCarsByCriteriaQuery
     */
    public function __construct(FindCarsByCriteriaQuery $findCarsByCriteriaQuery)
    {
        $this->findCarsByCriteriaQuery = $findCarsByCriteriaQuery;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object)
    {
        $criteria = new QueryCriteria(
            [
                ['field' => 'brand', 'value' => $object['brand']],
                ['field' => 'model', 'value' => $object['model']]
            ],
            [],
            1,
            1
        );

        $queryResult = $this->findCarsByCriteriaQuery->find($criteria);

        return $queryResult->resultCount() === 0;
    }
}