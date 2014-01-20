<?php

require_once 'BaseModel.php';


class CommentModel extends BaseModel
{
    protected static $table = 'comments';
    protected static $pk = 'id';
}
