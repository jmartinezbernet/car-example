<?php

namespace Status\Infrastructure\Di\ServiceManager\Factories;

use Psr\Container\ContainerInterface;
use Status\Application\Query\FindDemoByIdQuery;
use Status\Application\Service\GetDemoStatusService;

class GetDemoStatusServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return GetDemoStatusService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new GetDemoStatusService($container->get(FindDemoByIdQuery::class));
    }
}