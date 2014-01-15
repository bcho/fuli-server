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
    'cookies.secret_key' => $secret_key
);

$app->config($configs);
