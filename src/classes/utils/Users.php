<?php

namespace utils;

use \db\DbUser;

class Users
{
    const USER = 'user';
    const HASH = 'hash';

    public static function getSessionUser()
    {
        return isset($_SESSION[Users::USER]) ? $_SESSION[Users::USER] : null;
    }

    public static function setSession($user)
    {
        if (empty($user[DbUser::DISABLED])) {
            $_SESSION[self::USER] = $user;
            unset($_SESSION[self::USER][DbUser::PASS]);
        } else {
            unset($_SESSION[self::USER]);
        }
    }

    public static function setCookie($user)
    {
        $expire = time() + 5184000; // 60 days
        $cookie_hash = Utils::genHash(
            array(
                $user[DbUser::PASS],
                $user[DbUser::UUID],
                $user[DbUser::EMAIL]
            )
        );

        setcookie(self::USER, $user[DbUser::UUID], $expire, '/');
        setcookie(self::HASH, $cookie_hash, $expire, '/');
    }
    
    public static function getUserKey($uuid, $email, $pass)
    {
        $seed= Utils::genUuid(10);
        return Utils::genHash(
                       array(
                             $uuid,
                             $email,
                             $pass,
                             $seed
                             )
                       );

        
    }

    public static function clear()
    {
        unset($_SESSION[self::USER]);
        setcookie(self::USER, '', time() - 3600, '/');
        setcookie(self::HASH, '', time() - 3600, '/');
    }

    public static function load()
    {
        if (!empty($_SESSION[self::USER])) {

            $user = DbUser::getById($_SESSION[self::USER][DbUser::ID]);
            self::setSession($user);

        } else if (isset($_COOKIE[self::USER], $_COOKIE[self::HASH])) {

            $user = DbUser::getByHash($_COOKIE[self::USER]);

            if (!empty($user)) {
                $cookie_hash = Utils::genHash(
                    array(
                        $user[DbUser::PASS],
                        $user[DbUser::UUID],
                        $user[DbUser::EMAIL]
                    )
                );

                if ($cookie_hash == $_COOKIE[self::HASH]) {
                    self::setSession($user);
                } else {
                    self::clear();
                }
            }

        }
    }
}
