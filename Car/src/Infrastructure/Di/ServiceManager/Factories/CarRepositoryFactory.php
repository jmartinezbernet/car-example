<?php

namespace Car\Infrastructure\Di\ServiceManager\Factories;

use Car\Infrastructure\Hydrator\CarStateHydrator;
use Car\Infrastructure\Persistence\MySql\MySqlCarRepository;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;

class CarRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return MySqlCarRepository
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new MySqlCarRepository(
            new CarStateHydrator(),
            $container->get(Adapter::class)
        );
    }
}