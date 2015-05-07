<?php

namespace common;

abstract class Presenter
{

    protected $params;

    abstract function getPattern();

    abstract function init();

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }
}
