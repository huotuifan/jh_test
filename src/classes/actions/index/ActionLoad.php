<?php

namespace actions\index;

class ActionLoad extends \common\AjaxAction {

    const NAME = 'load';

    function getName() {
        return self::NAME;
    }

    function execute() {
        \utils\Utils::json(
            array(
                 'hello' => $this->model['hello'] . rand()
            )
        );
    }
}
