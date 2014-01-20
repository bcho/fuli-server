<?php

// simple web interface
require_once 'views/simple.php';

// api interface
require_once 'views/api.php';

$app->group('', function () use ($app) {
    $app->group('/link', function () use ($app) {
        $app->mapCallable('simple_get_link', '/int:id', 'GET');
        $app->mapCallable('simple_edit_link', '/int:id', 'POST');
        $app->mapCallable('simple_create_link', '/create', 'GET');
        $app->mapCallable('simple_create_link_handle', '/create', 'POST');
        $app->mapCallable('simple_get_links', '/', 'GET');
        $app->mapCallable('simple_add_link_comment_handle', '/int:id/comment', 'POST');
    });

    $app->group('/category', function () use ($app) {
        $app->mapCallable('simple_get_category', '/int:id', 'GET');
    });

    $app->group('/user', function () use ($app) {
        $app->mapCallable('simple_user_login', '/login', 'GET');
        $app->mapCallable('simple_user_login_handle', '/login', 'POST');
        $app->mapCallable('simple_user_logout', '/logout', 'GET');

        $app->mapCallable('simple_get_user', '/int:id', 'GET');
    });
});

$app->group('/api', function () use ($app) {
    $app->group('/link', function () use ($app) {
        $app->mapCallable('api_get_link', '/int:id', 'GET');
        $app->mapCallable('api_edit_link', '/int:id', 'POST');
        $app->mapCallable('api_create_link', '/int', 'POST');
        $app->mapCallable('api_get_links', '/', 'GET');
    });

    $app->group('/category', function () use ($app) {
        $app->mapCallable('api_get_category', '/int:id', 'GET');
    });

    $app->group('/user', function () use ($app) {
        $app->mapCallable('api_get_user', '/int:id', 'GET');
    });
});

$app->get('/', function () use ($app) {
    $app->redirect($app->urlFor('simple_get_links'));
});
