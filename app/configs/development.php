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

// session setup
$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '48 hours',
    'path' => '/',
    'httponly' => true,
    'name' => 'fuli',
    'secret' => $secret_key
)));

// prepare `twig` templating
$view = $app->view();
$view->parseOptions = array(
    'debug' => true,
    'cache' =>  ROOT_PATH . '/cache'
);
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension()
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
