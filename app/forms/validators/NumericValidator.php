<?php

class NumericValidator extends BaseValidator
{
    public function validate($data, $name = null, $others = array())
    {
        if (!is_int($data) && !is_numeric($data)) {
            $this->errors = "$name must be numeric.";
            return false;
        }
        return true;
    }
}
