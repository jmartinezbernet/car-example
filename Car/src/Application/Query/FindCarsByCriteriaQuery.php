<?php

namespace Car\Application\Query;

use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

interface FindCarsByCriteriaQuery
{
    public function find(QueryCriteria $criteria): QueryResult;
}