<?php

require_once 'BaseModel.php';


class UserModel extends BaseModel
{
    protected static $table = 'users';
    protected static $pk = 'id';

    public static function readLinks($user)
    {
        return LinkModel::readMany(array(
            'user_id' => $user['id']
        ));
    }

    public static function readComments($user)
    {
        return CommentModel::readMany(array(
            'user_id' => $user['id']
        ));
    }

    public static function readCommentsCount($user)
    {
        $id = $user['id'];
        $cur = \CRUD\CRUD::getCursor();
        $rv = $cur->query("SELECT COUNT(*)
            FROM `comments`
            WHERE `user_id` = $id")->fetch();
        return $rv[0];
    }
}
