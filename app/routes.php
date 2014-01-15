<?php

$app->get('/', function () use ($app) {
    $app->response->write('<h1>Hello, World</h1>');
});
