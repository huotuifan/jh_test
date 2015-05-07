<?php

namespace actions\common;

use \utils\Utils;
use \utils\Users;
use \db\DbUser;

class ActionLogout extends \common\AjaxAction
{

    const NAME = 'common.logout';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        error_log("inside logout", 3, "/var/tmp/my-errors.log");
        $user_uid = trim($this->model['user_id']);
        $session_key = trim($this->model['session_key']);
        $id= DbUser::getByUserKey($user_uid, $session_key);
        DbUser::updateById($id[DbUser::ID], array(DbUser::STATUS => 0));
        Utils::json(array(
                          self::STATUS => self::OK,
                          'message' => 'user is successfully logged out'
                          ));
    }
}
