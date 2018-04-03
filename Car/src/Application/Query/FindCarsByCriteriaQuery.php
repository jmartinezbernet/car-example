<?php

namespace Car\Application\Query;

use Common\Application\Query\QueryCriteria;
use Common\Application\Query\QueryResult;

interface FindCarsByCriteriaQuery
{
    public function find(QueryCriteria $criteria): QueryResult;
}