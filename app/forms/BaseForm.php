<?php

abstract class BaseForm
{
    /**
     * @var array objects that have a`validate` and `getError` method
     */
    protected $rules = array();

    /**
     * @var array validated errors
     */
    protected $validateErrors = array();

    /**
     * @var array
     */
    protected $data = array();

    /**
     * Set rule
     *
     * @param string rule's name
     * @param mixed object that have a `validate` and `getError` method
     */
    public function setRule($name, $rules)
    {
        if (!isset($this->rules[$name])) {
            $this->rules[$name] = array();
        }
        if (is_array($rules)) {
            $this->rules[$name] = array_merge($this->rules[$name], $rules);
        } else {
            $this->rules[$name][] = $rules;
        }
    }

    /**
     * Assign data to the form.
     *
     * @param array
     * @return \BaseForm
     */
    public function populate($raw)
    {
        foreach ($raw as $k => $v) {
            $this->data[$k] = $v;
        }

        return $this;
    }

    /**
     * Validate data.
     * If all fields pass validation it will return TRUE, or it will return
     * errors fields.
     *
     * @return mixed
     */
    public function validate()
    {
        $passed = true;
        foreach ($this->data as $k => $v) {
            if (!isset($this->rules[$k])) {
                continue;
            }

            $validators = $this->rules[$k];
            if (!is_array($validators)) {
                $validators = array($validators);
            }
            foreach ($validators as $validator) {
                if (!$validator->validate($v, $k, $this->data)) {
                    $passed = false;
                    $this->validateErrors[$k] = $validator->getError();

                    // stop earlier
                    break;
                }
            }
        }

        return ($passed) ? ($passed) : ($this->validateErrors);
    }
}
