<?php

namespace apps\users;

use utils\HTTP;

class User extends \common\Presenter
{

    const PATTERN = '%^/users/([A-Za-z0-9]{8})$%';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $params = $this->getParams();
        $result = \db\DbPost::getListByUserHash($params[1]);

        if (empty($result)) {
            HTTP::pageNotFound();
        } else {
            $view = new \common\View();
            $view->setModel($result);
            $view->display(__DIR__ . DS . 'user.tpl');
        }
    }
}
