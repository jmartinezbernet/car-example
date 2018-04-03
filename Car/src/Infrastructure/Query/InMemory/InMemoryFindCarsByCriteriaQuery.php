<?php

namespace Car\Infrastructure\Query\InMemory;


use Car\Application\Query\FindCarsByCriteriaQuery;
use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

class InMemoryFindCarsByCriteriaQuery implements FindCarsByCriteriaQuery
{
    /**
     * @var array
     */
    private $carList;

    public static function withFixedCars(array ...$cars)
    {
        $carList = [];

        foreach ($cars as $car) {
            $carList[$car['id']] = $car;
        }

        return new self($carList);
    }

    public function __construct(array $carList)
    {
        $this->carList = $carList;
    }

    public function find(QueryCriteria $criteria): QueryResult
    {
        $resultsCount = 0;
        $results = [];
        $totalResults = 0;
        $totalPages = 0;
        $page = $criteria->page();
        $filterList = $criteria->filter();

        foreach ($this->carList as $car) {
            $found = true;
            while ($filter = next($filterList) && $found) {
                if ($car[$filter['field']] !== $filter['value']) {
                    $found = false;
                }
            }

            if ($found) {
                $totalResults++;
            }

            $totalPages = (int)ceil($totalResults / $criteria->pageSize());

            if ($found && $resultsCount <= $criteria->pageSize() && $totalPages === $criteria->page()) {
                $resultsCount++;
                array_push($results, $car);
            }
        }

        return new QueryResult($resultsCount, $totalResults, $page, $totalPages, new \ArrayIterator($results));
    }
}