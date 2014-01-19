<?php

$app->registerCallable('api_get_link', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('api_edit_link', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('api_create_link', function () use ($app) {
    echo 'create link';
});

$app->registerCallable('api_get_links', function () use ($app) {
    echo 'get all links';
});

$app->registerCallable('api_get_category', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('api_get_user', function ($id) use ($app) {
    echo $id;
});
