<?php

// use for encryption.
$secret_key = 'fuli';

// TODO
// `application mode` base configuration
$configs = array(
    'mode' => 'development',
    'debug' => true,

    'log.level' => \Slim\Log::DEBUG,
    'log.enabled' => true,

    'cookies.encrypt' => true,
    'cookies.httponly' => true,
    'cookies.secret_key' => $secret_key,

    'templates.path' => APP_PATH . '/templates',
    'view' => new \Slim\Views\Twig()
);

$app->config($configs);

// prepare `twig` templating
$view = $app->view();
$view->parseOptions = array(
    'debug' => true,
    'cache' =>  ROOT_PATH . '/cache'
);

// prepare database connection
CRUD\CRUD::configure(array(
    'dsn' => 'mysql:host=localhost;dbname=fuli',
    'username' => 'fuli',
    'password' => 'fuli',
    'driver_options' => array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
));
