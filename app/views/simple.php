<?php

$app->registerCallable('simple_get_link', function ($id) use ($app) {
    return $app->render('simple/link.html', array(
        'link' => LinkModel::readOneOr404($id),
        'comments' => LinkModel::readComments($id)
    ));
});

$app->registerCallable('simple_edit_link', function ($id) use ($app) {
    echo $id;
});

$app->registerCallable('simple_create_link', function () use ($app) {
    return $app->render('simple/link.add.html', array(
        'categories' => CategoryModel::readMany()
    ));
});

$app->registerCallable('simple_create_link_handle', function () use ($app) {
    $data = $app->request->post();

    $form = new CreateLinkForm();
    $errors = $form
        ->populate($data)
        ->validate();
    // FIXME better representation
    if (is_array($errors)) {
        return $app->redirect($app->urlFor('simple_create_link'));
    }

    $data['category_id'] = intval($data['category_id']);
    LinkModel::create($data);
    return $app->redirect($app->urlFor('simple_get_links'));
});

$app->registerCallable('simple_get_links', function () use ($app) {
    $links = LinkModel::readMany();
    foreach ($links as &$link) {
        $link['comments_count'] = LinkModel::readCommentsCount($link['id']);
    }

    return $app->render('simple/index.html', array(
        'links' => $links,
        'categories' => CategoryModel::readMany()
    ));
});

$app->registerCallable('simple_add_link_comment_handle',
function ($id) use ($app) {
    $data = $app->request->post();

    $form = new AddCommentForm();
    $errors = $form
        ->populate($data)
        ->validate();
    // FIXME better representation
    if (is_array($errors)) {
        return $app->redirect($app->urlFor('simple_get_link', array(
            'id' => $id
        )));
    }

    $data['link_id'] = $id;
    CommentModel::create($data);

    return $app->redirect($app->urlFor('simple_get_link', array('id' => $id)));
});

$app->registerCallable('simple_get_category', function ($id) use ($app) {
    $category = CategoryModel::readOneOr404($id);
    $links = LinkModel::readMany(array(
        'category_id' => $id
    ));
    foreach ($links as &$link) {
        $link['comments_count'] = LinkModel::readCommentsCount($link['id']);
    }

    return $app->render('simple/index.html', array(
        'links' => $links,
        'current_category' => $category,
        'categories' => CategoryModel::readMany()
    ));
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
