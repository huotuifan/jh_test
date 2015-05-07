<?php

namespace apps\index;

use \db\DbPost;

class Index extends \common\Presenter
{

    const PATTERN = '%^/(index.html|tags/(.*))?$%';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $tag = '';

        if (count($this->getParams()) == 3) {
            $tags = $this->getParams();
            $tag = $tags[2];
        }

        $view = new \common\View();
        $view->setModel(
            array(
                'tag' => $tag
            ));
        $view->display(__DIR__ . DS . 'index.tpl');
    }
}
