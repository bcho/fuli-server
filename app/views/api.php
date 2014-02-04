<?php

class LinkResource extends \Slim\Light\ResourceController
{
    public function get($id) {
        echo $id;
    }

    public function update($id) {
        echo $id;
    }

    public function edit($id) {
        echo $id;
    }

    public function get_all() {
        echo 'Get all links.';
    }

    public function create() {
        echo 'Create a link.';
    }
}

$app->group('/api', function () use ($app) {
    $app->resource('api_link', '/link', new LinkResource());
});
