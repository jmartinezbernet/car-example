<?php

namespace Car\Infrastructure\Di\ServiceManager\Factories;

use Car\Infrastructure\Query\MySql\MySqlFindCarsByCriteriaQuery;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;

class FindCarsByCriteriaQueryFactory
{
    /**
     * @param ContainerInterface $container
     * @return MySqlFindCarsByCriteriaQuery
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new MySqlFindCarsByCriteriaQuery(
            $container->get(Adapter::class)
        );
    }
}