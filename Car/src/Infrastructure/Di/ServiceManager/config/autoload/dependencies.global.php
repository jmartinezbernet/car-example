<?php

use Status\Application\Query\FindDemoByIdQuery;
use Status\Application\Service\GetDemoStatusService;
use Status\Infrastructure\Di\ServiceManager\Factories\FindDemoByIdQueryFactory;
use Status\Infrastructure\Di\ServiceManager\Factories\GetDemoStatusServiceFactory;
use Status\Infrastructure\Di\ServiceManager\Factories\RestFulMiddlewareAbstractFactory;
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
            GetDemoStatusService::class => GetDemoStatusServiceFactory::class,
            //Service

            //Repository

            //Query
            FindDemoByIdQuery::class => FIndDemoByIdQueryFactory::class,

            //Specification

        ),
        'aliases' => [
            'configuration' => 'config',
            \Zend\Expressive\Router\RouterInterface::class => \Zend\Expressive\Router\AuraRouter::class,
        ],
        'invokables' => []
    ],
];
