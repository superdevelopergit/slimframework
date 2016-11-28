<?php

// DIC configuration

$container = $app->getContainer();

// view renderer
$container['db'] = function ($c)
{
    $settings = $c->get('settings')['db'];
    $connection = new \mysqli($settings['host'], $settings['username'], $settings['passwrod'], $settings['database']);
    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
};

// view renderer
$container['renderer'] = function ($c)
{
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c)
{
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
