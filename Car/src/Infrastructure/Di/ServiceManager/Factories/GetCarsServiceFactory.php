<?php

namespace Car\Infrastructure\Di\ServiceManager\Factories;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Car\Application\Service\GetCarsService;
use Psr\Container\ContainerInterface;

class GetCarsServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return GetCarsService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new GetCarsService($container->get(FindCarsByCriteriaQuery::class));
    }
}