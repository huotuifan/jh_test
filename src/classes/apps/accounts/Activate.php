<?php

namespace apps\accounts;

use \utils\Utils;
use \db\DbUser;

class Activate extends \common\Presenter
{

    const PATTERN = '#^/accounts/activate/([0-9a-zA-Z]{16})$#';
    const URL = '/accounts/activate/%s';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $user = DbUser::getByActivationCode($this->params[1]);
        if (empty($user)) {
            Utils::sendError("Activation Failed");
        } else {
            DbUser::activate($user[DbUser::ID]);
            \utils\Users::setSession(DbUser::getById($user[DbUser::ID]));
            Utils::redirectToHome();
        }
    }
}
