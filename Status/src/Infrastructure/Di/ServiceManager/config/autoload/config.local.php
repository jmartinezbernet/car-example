<?php

return [
    'db' => [
        'username'       => 'default',
        'password'       => 'default',
        'hostname'       => 'localhost',
        'database'       => 'default',
        'charset'        => 'UTF8',
        'driver'         => 'PDO_Mysql',
        'driver_options' => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    ]
];
