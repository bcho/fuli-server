<?php

$app->group('', function () use ($app) {
    // TODO resource helper
    // TODO route naming convention
    
    $app->group('/link', function () use ($app) {
        // get a link
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('simple_get_link');

        // edit a link
        $app->post('/:id', function ($id) use ($app) {
            echo 'edit ' . $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('simple_edit_link');

        // create a link
        $app->post('/', function () use ($app) {
            echo 'create link';
        })->name('simple_create_link');

        // get all links
        $app->get('/', function () use ($app) {
            echo 'get all links';
        })->name('simple_get_links');
    });

    $app->group('/category', function () use ($app) {
        // get a category
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('simple_get_category');
    });

    $app->group('/user', function () use ($app) {
        // get a user
        $app->get('/:id', function ($id) use ($app) {
            echo $id;
        })->conditions(array(
            'id' => '\d+'
        ))->name('simple_get_user');

        // TODO user auth helper & middleware
        // user login
        $app->get('/login', function () use ($app) {
            echo 'user login';
        })->name('simple_show_user_login');

        // handle user login
        $app->post('/login', function () use ($app) {
            echo 'handle user login';
        })->name('simple_login_user');

        $app->get('/logout', function () use ($app) {
            echo 'user logout';
        })->name('simple_user_logout');
    });
});
