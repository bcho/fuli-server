<?php

// simple web interface
require_once 'views/simple.php';

// api interface
require_once 'views/api.php';

$app->get('/', function () use ($app) {
    $app->render('index.html');
});
