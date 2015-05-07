<?php

namespace db;

class DbFavorites extends \common\DbModel
{
    const USER_ID_FAVORITED = 'user_id_favorited';

    public static function addUserToFavorites($row)
    {
        self::getDB()->query('INSERT INTO ?_users_users(?#) VALUES(?a)', array_keys($row), array_values($row));
    }

    public static function addPlaceToFavorites($row)
    {
        self::getDB()->query('INSERT INTO ?_users_places(?#) VALUES(?a)', array_keys($row), array_values($row));
    }

    public static function removeUserFromFavorites($row)
    {
        self::getDB()->query('DELETE FROM ?_users_users WHERE user_id=? AND user_id_favorited', $row[DbUser::ID], $row[self::USER_ID_FAVORITED]);
    }

    public static function removePlaceFromFavorites($row)
    {
        self::getDB()->query('DELETE FROM ?_users_places WHERE user_id=? AND place_id=?', $row[DbUser::ID], $row[DbPlace::ID]);
    }

    public static function isUserFavorited($id)
    {
        $sessionUser = \Utils\Users::getSessionUser();
        if (!empty($sessionUser)) {
            $row = self::getDB()->selectRow('SELECT *
            FROM ?_users_users
            WHERE user_id=?
                AND user_id_favorited=?',
                $sessionUser[DbUser::ID], $id);
            return !empty($row);
        }
        return false;
    }

    public static function isPlaceFavorited($id)
    {
        $sessionUser = \Utils\Users::getSessionUser();
        if (!empty($sessionUser)) {
            $row = self::getDB()->selectRow('SELECT *
            FROM ?_users_places
            WHERE user_id=?
                AND place_id=?',
                $sessionUser[DbUser::ID], $id);
            return !empty($row);
        }
        return false;
    }
}
