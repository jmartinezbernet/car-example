<?php

namespace Car\Infrastructure\Di\ServiceManager\Factories;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Car\Application\Service\RegisterCarService;
use Car\Domain\CarNotExistsSpecification;
use Car\Domain\CarRepository;
use Psr\Container\ContainerInterface;

class RegisterCarServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return RegisterCarService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new RegisterCarService(
            $container->get(CarRepository::class),
            new CarNotExistsSpecification(
                $container->get(FindCarsByCriteriaQuery::class)
            )
        );
    }
}