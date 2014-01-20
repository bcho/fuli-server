<?php

abstract class BaseValidator
{
    /**
     * @var mixed error result
     */
    protected $errors;

    abstract public function validate($data, $name = null, $others = array());

    public function getError() {
        return $this->errors;
    }
}
