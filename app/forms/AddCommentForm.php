<?php

require_once 'BaseForm.php';


class AddCommentForm extends BaseForm
{
    public function __construct()
    {
        $this->setRule('content', new RequiredValidator());
    }
}
