<?php

require_once 'BaseModel.php';


class UserModel extends BaseModel
{
    protected static $table = 'users';
    protected static $pk = 'id';
}
