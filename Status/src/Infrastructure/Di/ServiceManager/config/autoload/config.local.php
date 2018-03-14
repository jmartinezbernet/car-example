<?php

return [
    'db' => [
        'username'       => 'demo',
        'password'       => 'demo',
        'hostname'       => 'localhost',
        'database'       => 'demo',
        'charset'        => 'UTF8',
        'driver'         => 'PDO_Mysql',
        'driver_options' => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    ]
];
