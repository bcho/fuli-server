<?php

use \CRUD\CRUDModel;

class ModelNotFoundError extends Exception {}


abstract class BaseModel extends CRUDModel
{
    public static function readOneOr404($conditions)
    {
        $rv = static::readOne($conditions);
        if (!$rv) {
            \Slim\Slim::getInstance()->halt(404);
        }
        return $rv;
    }
}
