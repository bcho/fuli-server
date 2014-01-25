<?php

require_once 'BaseModel.php';


class CommentModel extends BaseModel
{
    protected static $table = 'comments';
    protected static $pk = 'id';

    public static function readAuthor($comment)
    {
        return UserModel::readOne(array(
            'id' => $comment['user_id']
        ));
    }
}
