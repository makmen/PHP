<?php

abstract class Validator {

    const CODE_UNKNOWN = "UNKNOWN_ERROR";

    protected $model;
    protected $value;
    protected $data;
    protected $id;
    protected $errors = array();

    public function __construct($model, $value) {
        $this->model = $model;
        $this->value = $value;
        $this->data = $this->model->{$this->value};
        $this->id = $model->getID();
        $this->validate();
    }

    abstract protected function validate();

    public function getErrors() {
        return $this->errors;
    }

    public function isValid() {
        return count($this->errors) == 0;
    }

    protected function setError($code) {
        $this->errors[] = $code;
    }

    protected function isContainQuotes($string) {
        $array = array("\"", "'", "`", "&quot;", "&apos;");
        foreach ($array as $value) {
            if (strpos($string, $value) !== false)
                return true;
        }
        return false;
    }

}
