<?php

use Car\Application\Query\FindCarsByCriteriaQuery;
use Car\Application\Service\GetCarsService;
use Car\Application\Service\RegisterCarService;
use Car\Domain\CarRepository;
use Car\Infrastructure\Di\ServiceManager\Factories\CarRepositoryFactory;
use Car\Infrastructure\Di\ServiceManager\Factories\FindCarsByCriteriaQueryFactory;
use Car\Infrastructure\Di\ServiceManager\Factories\GetCarsServiceFactory;
use Car\Infrastructure\Di\ServiceManager\Factories\RegisterCarServiceFactory;
use Car\Infrastructure\Di\ServiceManager\Factories\RestFulMiddlewareAbstractFactory;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterServiceFactory;

return [
    'dependencies' => [
        'abstract_factories' => [
            RestFulMiddlewareAbstractFactory::class
        ],
        'factories' => array(
            //Framework
            Adapter::class => AdapterServiceFactory::class,
            Zend\Expressive\Router\AuraRouter::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,

            //Transaction

            //Application Service
            GetCarsService::class => GetCarsServiceFactory::class,
            RegisterCarService::class => RegisterCarServiceFactory::class,

            //Service

            //Repository
            CarRepository::class => CarRepositoryFactory::class,

            //Query
            FindCarsByCriteriaQuery::class => FindCarsByCriteriaQueryFactory::class,

            //Specification

        ),
        'aliases' => [
            'configuration' => 'config',
            \Zend\Expressive\Router\RouterInterface::class => \Zend\Expressive\Router\AuraRouter::class,
        ],
        'invokables' => []
    ],
];
