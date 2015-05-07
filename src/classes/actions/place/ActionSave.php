<?php

namespace actions\place;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbUser;
use \db\DbPlace;

class ActionSave extends \common\AjaxAction
{

    const NAME = 'place.save';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {

            $id = $this->getParamTrimmed(DbPlace::ID);

            $placeExists = false;
            $existing = DbPlace::getById($id);

            $allowEdit = false;
            if (count($existing) > 0) {
                $placeExists = true;
                if ($sessionUser[DbUser::ID] == $existing['user_id'] || $sessionUser[DbUser::LEVEL] == 1) {
                    $allowEdit = true;
                }
            } else {
                $allowEdit = true;
            }

            if (! $allowEdit) {
                Utils::json(array(
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('e001')
                    )
                ));
                exit;
            }

            $place = array(
                DbPlace::NAME => $this->getParamTrimmed(DbPlace::NAME),
                DbPlace::ABOUT => $this->getParamTrimmed(DbPlace::ABOUT),
                DbPlace::LAT => $this->getParamTrimmed(DbPlace::LAT),
                DbPlace::LNG => $this->getParamTrimmed(DbPlace::LNG)
            );

            if (! $placeExists) {
                $place[DbPlace::USER_ID] = $sessionUser[DbUser::ID];
            }

            if (empty($place[DbPlace::NAME])) {
                Utils::json(array(
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('p003')
                    )
                ));
                exit;
            }

            if (empty($place[DbPlace::LAT]) || empty($place[DbPlace::LNG])) {
                Utils::json(array(
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('p004')
                    )
                ));
                exit;
            }

            if (empty($id)) {
                $placeDTO = DbPlace::create($place);
            } else {
                $placeDTO = DbPlace::updateById($id, $place);
            }

            Utils::json(array(
                'model' => array_merge($placeDTO, $place),
                self::STATUS => self::OK
            ));
        }
    }
}
