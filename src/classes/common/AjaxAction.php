<?php

namespace common;

abstract class AjaxAction implements Action
{
    protected $model;

    public function init()
    {
        if (!empty($_REQUEST)) {
            $this->model = $_REQUEST;
        }
    }

    public function getParam($name)
    {
        if (!empty($this->model) && !empty($this->model[$name])) {

            return $this->model[$name];

        } else {

            return null;

        }
    }

    public function getParamTrimmed($name)
    {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($this->getParam($name));
        } else {
            $value = $this->getParam($name);
        }
        return empty($value) ? "" : trim($value);
    }
}
