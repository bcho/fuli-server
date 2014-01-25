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
        $comments = CommentModel::readMany(array(
            'link_id' => $id
        ));

        foreach ($comments as &$comment) {
            $comment['author'] = CommentModel::readAuthor($comment);
        }

        return $comments;
    }

    public function readCommentsCount($link)
    {
        $id = $link['id'];
        $cur = \CRUD\CRUD::getCursor();
        $rv = $cur->query("SELECT COUNT(*)
            FROM `comments`
            WHERE `link_id` = $id")->fetch();
        return $rv[0];
    }

    public function readAuthor($link)
    {
        return UserModel::readOne(array(
            'id' => $link['user_id']
        ));
    }
}
