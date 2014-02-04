<?php

function userView() {
    if (Auth::isLogin()) {
        Slim::getInstance()->view->setData('current_user', Auth::getUser());
    }
}

function needLogin() {
    if (!Auth::isLogin()) {
        $app = Slim::getInstance();

        // TODO redirect to flash url after login
        return $app->redirect($app->urlFor('simple_user_login'));
    }
}


$app->set('simple_get_link', 'userView',
function ($id) use ($app) {
    $link = LinkModel::readOneOr404($id);
    $author = LinkModel::readAuthor($link);

    return $app->render('simple/link.html', array(
        'link' => $link,
        'author' => $author,
        'comments' => LinkModel::readComments($id)
    ));
});

$app->set('simple_edit_link', 'userView', function ($id) use ($app) {
    $app->halt(403);
});

$app->set('simple_create_link', 'needLogin', 'userView',
function () use ($app) {
    return $app->render('simple/link.add.html', array(
        'categories' => CategoryModel::readMany()
    ));
});

$app->set('simple_create_link_handle', 'needLogin',
function () use ($app) {
    $data = $app->request->post();

    $form = new CreateLinkForm();
    $errors = $form
        ->populate($data)
        ->validate();
    if ($errors) {
        return $app->redirect($app->urlFor('simple_create_link'));
    }

    $data['category_id'] = intval($data['category_id']);
    $user = Auth::getUser();
    $data['user_id'] = $user['id'];
    LinkModel::create($data);
    return $app->redirect($app->urlFor('simple_get_links'));
});

$app->set('simple_get_links', 'userView',
function () use ($app) {
    $links = LinkModel::readMany();
    foreach ($links as &$link) {
        $link['comments_count'] = LinkModel::readCommentsCount($link['id']);
    }

    return $app->render('simple/index.html', array(
        'links' => $links,
        'categories' => CategoryModel::readMany()
    ));
});

$app->set('simple_add_link_comment_handle', 'needLogin',
function ($id) use ($app) {
    $data = $app->request->post();

    $form = new AddCommentForm();
    $errors = $form
        ->populate($data)
        ->validate();
    if ($errors) {
        return $app->redirect($app->urlFor('simple_get_link', array(
            'id' => $id
        )));
    }

    $data['link_id'] = $id;
    $user = Auth::getUser();
    $data['user_id'] = $user['id'];
    CommentModel::create($data);

    return $app->redirect($app->urlFor('simple_get_link', array('id' => $id)));
});

$app->set('simple_get_category', 'userView',
function ($id) use ($app) {
    $category = CategoryModel::readOneOr404($id);
    $links = LinkModel::readMany(array(
        'category_id' => $id
    ));
    foreach ($links as &$link) {
        $link['comments_count'] = LinkModel::readCommentsCount($link);
    }

    return $app->render('simple/index.html', array(
        'links' => $links,
        'current_category' => $category,
        'categories' => CategoryModel::readMany()
    ));
});

$app->set('simple_user_login', function () use ($app) {
    if (Auth::isLogin()) {
        return $app->redirect($app->urlFor('simple_get_links'));
    }

    return $app->render('simple/user.login.html');
});

$app->set('simple_user_login_handle', function () use ($app) {
    $stuid = $app->request->post('stuid');
    $password = $app->request->post('password');

    if (Auth::login($stuid, $password)) {
        $infos = Auth::getUserInfos();
        $rv = UserModel::readOne($infos);
        if (!$rv) {
            UserModel::create($infos);
        }

        return $app->redirect($app->urlFor('simple_get_links'));
    }

    return $app->redirect($app->urlFor('simple_user_login'));
});

$app->set('simple_user_logout', function () use ($app) {
    Auth::logout();

    return $app->redirect($app->urlFor('simple_get_links'));
});

$app->set('simple_get_user', 'userView',
function ($id) use ($app) {
    $user = UserModel::readOneOr404($id);
    $user['links'] = UserModel::readLinks($user);
    foreach ($user['links'] as &$link) {
        $link['comments_count'] = LinkModel::readCommentsCount($link);
    }

    $user['comments_count'] = UserModel::readCommentsCount($user);

    return $app->render('simple/user.html', array(
        'user' => $user
    ));
});
