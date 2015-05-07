<?php

namespace actions\place;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbUser;
use \db\DbPlace;

class ActionDelete extends \common\AjaxAction
{

    const NAME = 'place.delete';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();

        if (! empty($sessionUser)) {
            $id = $this->getParamTrimmed('place_id');
            $existing = DbPlace::getById($id);

            if (count($existing) > 0) {
                if ($sessionUser[DbUser::ID] == $existing['user_id'] || $sessionUser['user_level'] == 1) {
                    Utils::json(DbPlace::deleteById($id));
                }
            }
        }
    }
}
