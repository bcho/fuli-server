<?php

class RequiredValidator extends BaseValidator
{
    public function validate($data, $name = null, $others = array())
    {
        if (!$data) {
            $this->errors = "$name is required.";
            return false;
        }
        return true;
    }
}
