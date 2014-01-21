<?php

require_once 'BaseForm.php';


class AddCommentForm extends BaseForm
{
    public function initialize()
    {
        $this->setRule('content', new RequiredValidator());
    }
}
