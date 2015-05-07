<?php

namespace db;

class DbUser extends \common\DbModel
{
    const ID = 'user_id';
    const UUID = 'user_uuid';
    const NAME = 'user_name';
    const EMAIL = 'user_email';
    const ABOUT = 'user_about';
    const PASS = 'user_password';
    const DISABLED = 'user_disabled';
    const ACTIVATION = 'user_activation';
    const FORGOT = 'user_forgot';
    const SUBSCRIBE = 'user_subscribe';
    const IP = 'user_ip';
    const COUNTRY = 'user_country';
    const CITY = 'user_city';
    const LAT = 'user_lat';
    const LNG = 'user_lng';
    const LEVEL = 'user_level';
    const KEY= 'user_session_key';
    const STATUS= 'user_login_status';

    public static function getRow($name, $email, $password, $disabled = false)
    {
        return array(
            self::NAME => $name,
            self::EMAIL => $email,
            self::PASS => \utils\Utils::genPass($password),
            self::DISABLED => 0 // $disabled ? 1 : 0
        );
    }

    public static function create($row)
    {
        $row[self::UUID] = \utils\Utils::genUuid();
        $row[self::KEY]= \utils\Users::getUserKey($row[self::UUID], $row[self::EMAIL], $row[self::PASS]);
        $row[self::NAME] = strip_tags($row[self::NAME]);
        return array(
            self::ID => self::getDB()->query('INSERT INTO ?_users(?#) VALUES(?a)', array_keys($row), array_values($row)),
            self::UUID => $row[self::UUID],
            self::KEY => $row[self::KEY]
        );
    }

    public static function getById($id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_users WHERE user_id=?', $id);
    }

    public static function getByHash($hash)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_users WHERE user_uuid=?', $hash);
    }

    public static function getByEmail($email)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_users WHERE user_email=?', $email);
    }

    public static function getByPassword($email, $password)
    {
        return self::getDB()->selectRow('SELECT user_id FROM ?_users WHERE user_disabled=? and user_email=? and user_password=?', 0, $email, $password);
    }
    
    public static function getByUserKey($user_uid, $session_key)
    {
        return self::getDB()->selectRow('SELECT user_id FROM ?_users WHERE user_uuid=? AND user_session_key=?',$user_uid, $session_key);
    }
    
    public static function isUserLoggedIn($user_id)
    {
        $r= self::getDB()->selectRow('SELECT user_id FROM ?_users WHERE user_id=? AND user_login_status=?',$user_id, 1);
        if(empty($r))
            return False;
        else
            return True;
        
    }

    public static function getByActivationCode($code)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_users WHERE user_activation=?', $code);
    }

    public static function getByForgotCodeAndId($code, $id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_users WHERE user_forgot=? and user_id=?d', $code, $id);
    }

    public static function activate($id)
    {
        $row = array(
            self::ACTIVATION => '',
            self::DISABLED => 0
        );
        return self::updateById($id, $row);
    }

    public static function updateById($id, $row)
    {
        if (!empty($row[self::NAME])) {
            $row[self::NAME] = strip_tags($row[self::NAME]);
        }
        return self::getDB()->query('UPDATE ?_users SET ?a WHERE user_id=?d', $row, $id);
    }

    public static function deleteById($id)
    {
        $result = self::getDB()->query('DELETE FROM ?_users WHERE user_id=?d', $id);
        return array('result' => $result);
    }
}
