<?php

namespace apps\accounts;

use \utils\Utils;
use \db\DbUser;
use \utils\Users;

class Forgot extends \common\Presenter
{

    const PATTERN = '#^/accounts/forgot/(([0-9a-zA-Z]{16})/([0-9]+))?$#';
    const URL = '/accounts/forgot/%s/%s';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $sessionUser = Users::getSessionUser();
        if ($sessionUser != null) {
            Utils::redirectToHome();
            return;
        }

        if (sizeof($this->params) < 4) {
            $view = new \common\View();
            $view->setModel(array(
                'show_change' => false
            ));
            $view->display(__DIR__ . DS . 'forgot.tpl');
            return;
        } else {
            $user_id = $this->params[3];
            $forgot_code = $this->params[2];

            $user = DbUser::getByForgotCodeAndId($forgot_code, $user_id);

            if (empty($user)) {
                Utils::sendError("Wrong id/code combination, please try again");
                return;
            }

            $view = new \common\View();
            $view->setModel(array(
                'show_change' => true,
                'id' => $user_id,
                'code' => $forgot_code,
            ));
            $view->display(__DIR__ . DS . 'forgot.tpl');
            return;
        }
    }
}
