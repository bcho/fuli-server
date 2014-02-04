<?php

// simple web interface
require_once 'views/simple.php';

// api interface
require_once 'views/api.php';

$app->group('', function () use ($app) {
    $app->group('/link', function () use ($app) {
        $app->route('simple_get_link', '/int:id', 'GET');
        $app->route('simple_edit_link', '/int:id', 'POST');
        $app->route('simple_create_link', '/create', 'GET');
        $app->route('simple_create_link_handle', '/create', 'POST');
        $app->route('simple_get_links', '/', 'GET');
        $app->route('simple_add_link_comment_handle', '/int:id/comment', 'POST');
    });

    $app->group('/category', function () use ($app) {
        $app->route('simple_get_category', '/int:id', 'GET');
    });

    $app->group('/user', function () use ($app) {
        $app->route('simple_user_login', '/login', 'GET');
        $app->route('simple_user_login_handle', '/login', 'POST');
        $app->route('simple_user_logout', '/logout', 'GET');

        $app->route('simple_get_user', '/int:id', 'GET');
    });
});

$app->get('/', function () use ($app) {
    $app->redirect($app->urlFor('simple_get_links'));
});
