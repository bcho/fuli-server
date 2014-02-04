<?php

define('ROOT_PATH', realpath('.'));
define('VENDOR_PATH', realpath(ROOT_PATH . '/vendor'));
define('APP_PATH', realpath(ROOT_PATH . '/app'));

require_once VENDOR_PATH . '/autoload.php';

$app = new \Slim\Light\Light();

// setup configurations
require_once APP_PATH . '/configs/app.php';

// setup routes
require_once APP_PATH . '/routes.php';

$app->log->info('app loaded');

$app->run();
