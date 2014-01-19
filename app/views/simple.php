<?php

$app->registerCallable('simple_get_link', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('simple_edit_link', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('simple_create_link', function () use ($app) {
    echo 'create link';
});

$app->registerCallable('simple_get_links', function () use ($app) {
    echo 'get all links';
});

$app->registerCallable('simple_get_category', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('simple_user_login', function () use ($app) {
    echo 'user login';
});

$app->registerCallable('simple_user_login_handle', function () use ($app) {
    echo 'handle user login';
});

$app->registerCallable('simple_user_logout', function () use ($app) {
    echo 'user logout';
});

$app->registerCallable('simple_get_user', function ($id) use ($app) {
    echo $id;
});
