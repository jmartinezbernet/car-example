<?php

namespace Car\Infrastructure\Query\MySql;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Common\Query\QueryCriteria;
use Common\Query\QueryParser;
use Common\Query\QueryResult;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class MySqlFindCarsByCriteriaQuery implements FindCarsByCriteriaQuery
{
    private CONST TABLE_NAME = 'car';

    private CONST FIELDS_CORRELATION = [
        'id' => 'id',
        'brand' => 'brand',
        'model' => 'model'
    ];
    /**
     * @var Adapter
     */
    private $adapter;

    /**
     * MySqlFindBankMovementsByCriteriaQuery constructor.
     * @param Adapter $adapter
     */
    public function __construct(
        Adapter $adapter
    )
    {
        $this->adapter = $adapter;
    }

    /**
     * @param QueryCriteria $criteria
     * @return QueryResult
     */
    public function find(QueryCriteria $criteria): QueryResult
    {
        $criteria = QueryParser::parseCriteria($criteria, self::FIELDS_CORRELATION);

        $sql = new Sql($this->adapter);

        $select = $sql->select();
        $select->from(self::TABLE_NAME);

        $where = [];
        $order = [];

        foreach ($criteria->filter() as $filter) {
            switch ($filter['field']) {
                case 'brand':
                case 'model':
                    $predicate =
                        new Expression("UPPER(JSON_EXTRACT(data, '$." . $filter['field'] . "')) LIKE UPPER('%"
                            . $filter['value'] . "%')");
                    break;
                default:
                    $predicate =
                        new Expression("JSON_EXTRACT(data, '$." . $filter['field'] . "') = '"
                            . $filter['value'] . "'");
                    break;
            }

            array_push($where, $predicate);
        }

        $select->columns(array('data'));
        $select->where($where);

        foreach ($criteria->ordination() as $ordination) {
            switch ($ordination['field']) {
                default:
                    if ($ordination['value'] === 'ASC') {
                        $predicate =
                            new Expression("JSON_EXTRACT(data, '$." .
                                $ordination['field']
                                . "') ASC");
                    } else {
                        $predicate =
                            new Expression("JSON_EXTRACT(data, '$." .
                                $ordination['field']
                                . "') DESC");
                    }
                    break;
            }

            array_push($order, $predicate);
        }

        $select->order($order);

        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $paginator = new Paginator($paginatorAdapter);
        $paginator
            ->setItemCountPerPage($criteria->pageSize())
            ->setCurrentPageNumber($criteria->page());

        return new QueryResult(
            $paginator->getCurrentItemCount(),
            $paginator->getTotalItemCount(),
            $paginator->getCurrentPageNumber(),
            $paginator->count(),
            $paginator->getCurrentItems()
        );
    }
}