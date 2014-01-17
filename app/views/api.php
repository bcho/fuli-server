<?php

$app->group('/api', function () use ($app) {
    // TODO resource helper
    // TODO route naming convention
    
    $app->group('/link', function () use ($app) {
        // get a link
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('api_get_link');

        // edit a link
        $app->post('/:id', function ($id) use ($app) {
            echo 'edit ' . $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('api_edit_link');

        // create a link
        $app->post('/', function () use ($app) {
            echo 'create link';
        })->name('api_create_link');

        // get all links
        $app->get('/', function () use ($app) {
            echo 'get all links';
        })->name('api_get_links');
    });

    $app->group('/category', function () use ($app) {
        // get a category
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('api_get_category');
    });

    $app->group('/user', function () use ($app) {
        // get a user
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('api_get_user');

        // TODO user auth helper & middleware
        // user login
        $app->get('/login', function () use ($app) {
            echo 'user login';
        })->name('api_show_user_login');

        // handle user login
        $app->post('/login', function () use ($app) {
            echo 'handle user login';
        })->name('api_login_user');

        $app->get('/logout', function () use ($app) {
            echo 'user logout';
        })->name('api_user_logout');
    });
});
