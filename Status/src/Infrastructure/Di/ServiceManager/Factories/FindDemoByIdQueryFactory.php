<?php

namespace Status\Infrastructure\Di\ServiceManager\Factories;

use Psr\Container\ContainerInterface;
use Status\Infrastructure\Query\MySql\MySqlFindDemoByIdQuery;
use Zend\Db\Adapter\Adapter;

class FindDemoByIdQueryFactory
{
    /**
     * @param ContainerInterface $container
     * @return MySqlFindDemoByIdQuery
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new MySqlFindDemoByIdQuery($container->get(Adapter::class));
    }
}