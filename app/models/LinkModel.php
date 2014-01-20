<?php

require_once 'BaseModel.php';


class LinkModel extends BaseModel
{
    protected static $table = 'links';
    protected static $pk = 'id';

    /**
     * Read link's comments
     *
     * @param int link's id
     * @return mixed
     */
    public function readComments($id)
    {
        return CommentModel::readMany(array(
            'link_id' => $id
        ));
    }

    public function readCommentsCount($id)
    {
        $cur = \CRUD\CRUD::getCursor();
        $rv = $cur->query("SELECT COUNT(*)
            FROM `comments`
            WHERE `link_id` = $id")->fetch();
        return $rv[0];
    }
}
