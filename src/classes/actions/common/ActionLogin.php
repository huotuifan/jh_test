<?php

namespace actions\common;

use \utils\Utils;
use \utils\Users;
use \db\DbUser;

class ActionLogin extends \common\AjaxAction
{

    const NAME = 'common.login';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $user_uid = trim($this->model['user_id']);
        $session_key = trim($this->model['session_key']);
        $u = DbUser::getByUserKey($user_uid, $session_key);
        $user= DbUser::getById($u[DbUser::ID]);
        if (!empty($u)) {
            $userLoggedIn= DbUser::isUserLoggedIn($u[DbUser::ID]);
            
            if($userLoggedIn)
            {
                Utils::json(array(
                                  self::STATUS => self::ERROR,
                                  'message' => 'user is already logged in'
                                  ));
            }
            else
            {
                
                if(($user_uid == $user[DbUser::UUID]) && ($session_key == $user[DbUser::KEY]))
                {
                    DbUser::updateById($u[DbUser::ID], array(DbUser::STATUS => 1));
                    Utils::json(array(
                                      self::STATUS => self::OK,
                                      'message' => 'user is successfully logged in'
                                      ));
                }
                else
                {
                    Utils::json(array(
                                      self::STATUS => self::ERROR,
                                      'message' => 'credential is wrong'
                                      ));
                }
                
         
               
            }
            
        } else {
            Utils::json(array(
                              self::STATUS => array_keys($this->model)
                              ));
        }
    }
}
