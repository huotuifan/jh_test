<?php

namespace actions\favorites;

use \utils\Utils;
use \utils\Users;
use \db\DbUser;
use \db\DbPlace;
use \db\DbFavorites;

class ActionPlace extends \common\AjaxAction
{

    const NAME = 'favorites.place';

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
                DbPlace::ID => $this->getParamTrimmed(DbPlace::ID)
            );

            $isRemove = $this->getParamTrimmed('remove');
            if (empty($isRemove)) {
                DbFavorites::addPlaceToFavorites($row);
            } else {
                DbFavorites::removePlaceFromFavorites($row);
            }

            Utils::json(array(
                self::STATUS => self::OK
            ));
        }
    }
}
