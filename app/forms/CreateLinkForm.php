<?php

require_once 'BaseForm.php';


class CreateLinkForm extends BaseForm
{
    public function initialize()
    {
        $this->setRule('url', new RequiredValidator());
        $this->setRule('title', new RequiredValidator());
        $this->setRule('category_id', array(
            new RequiredValidator(),
            new NumericValidator()
        ));
    }
}
