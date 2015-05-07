<?php

namespace actions\favorites;

use \utils\Utils;
use \utils\Users;
use \db\DbUser;
use \db\DbPlace;
use \db\DbFavorites;

class ActionUser extends \common\AjaxAction
{

    const NAME = 'favorites.user';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {

            $row = array(
                DbUser::ID => $sessionUser[DbUser::ID],
                DbFavorites::USER_ID_FAVORITED => $this->getParamTrimmed(DbFavorites::USER_ID_FAVORITED)
            );

            $isRemove = $this->getParamTrimmed('remove');
            if (empty($isRemove)) {
                DbFavorites::addUserToFavorites($row);
            } else {
                DbFavorites::removeUserFromFavorites($row);
            }

            Utils::json(array(
                self::STATUS => self::OK
            ));
        }
    }
}
