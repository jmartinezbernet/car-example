<?php

use Phpmig\Adapter\Zend\DbAdapter;
use Zend\Db\Adapter\Adapter as ZendAdapter;

require __DIR__ . '/../../../../../../vendor/autoload.php';
$container = require __DIR__ . '/../../../Di/ServiceManager/config/container.php';

$array = new ArrayObject();
$array->offsetSet('container', $container);
$array->offsetSet('phpmig.migrations_path', __DIR__ . '/Migrations');
$array->offsetSet('phpmig.migrations_template_path', __DIR__ . '/Template/Template.php');
$array->offsetSet('phpmig.adapter', new DbAdapter($container->get(ZendAdapter::class), 'migrations'));

return $array;