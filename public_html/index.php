<?php

require_once '../vendor/autoload.php';

$app = new \Slim\Slim();

// setup configuraions
require_once '../app/configs/app.php';

// setup routes
require_once '../app/routes.php';

$app->log->info('app loaded');

$app->run();
