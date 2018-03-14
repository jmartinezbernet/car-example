<?php

namespace Status\Infrastructure\Query\MySql;

use Status\Application\Query\FindDemoByIdQuery;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class MySqlFindDemoByIdQuery implements FindDemoByIdQuery
{
    const TABLE_NAME = 'demo';

    /**
     * @var Adapter
     */
    private $adapter;

    /**
     * MySqlFindProposalByIdQuery constructor.
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function find(string $id): ?array
    {
        $sql = new Sql($this->adapter);

        $select = $sql->select();
        $select->from(self::TABLE_NAME);

        $select->where(['id = ' . $id]);

        $selectString = $sql->buildSqlString($select);
        $result = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE)->current();

        return $result ? json_decode($result->getArrayCopy()['data'], true) : null;
    }
}