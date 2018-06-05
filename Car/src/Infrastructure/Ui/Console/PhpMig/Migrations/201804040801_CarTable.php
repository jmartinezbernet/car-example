<?php

use Phpmig\Migration\Migration;
use Zend\Db\Adapter\Adapter;

class CarTable extends Migration
{
    /**
     * Do the migration.
     */
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/../Sql/CarTable.sql');

        /** @var Psr\Container\ContainerInterface $container */
        $container = $this->getContainer()['container'];
        $container->get(Adapter::class)->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }

    /**
     * Undo the migration.
     */
    public function down()
    {
    }
}