<?php

namespace Car\Application\Query;

use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

interface FindCarsByCriteriaQuery
{
    const PAGE_SIZE = 20;

    public function find(QueryCriteria $criteria): QueryResult;
}