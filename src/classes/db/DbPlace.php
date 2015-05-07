<?php

namespace db;

class DbPlace extends \common\DbModel
{
    const ID = 'place_id';
    const UUID = 'place_uuid';
    const NAME = 'place_name';
    const ABOUT = 'place_about';
    const DISABLED = 'place_disabled';
    const LAT = 'place_lat';
    const LNG = 'place_lng';
    const USER_ID = DbUser::ID;

    public static function create($row)
    {
        $row[self::UUID] = \utils\Utils::genUuid();
        return array(
            self::ID => self::getDB()->query('INSERT INTO ?_places(?#) VALUES(?a)', array_keys($row), array_values($row)),
            self::UUID => $row[self::UUID]
        );
    }

    public static function getById($id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_places WHERE place_id=?', $id);
    }

    public static function searchByTerm($term)
    {
        return self::getDB()->query('SELECT * FROM ?_places WHERE place_name LIKE ?', "%{$term}%");
    }

    public static function getByHash($hash)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_places WHERE place_uuid=?', $hash);
    }

    public static function getByLatAndLng($latitude, $longtitude)
    {
        $latitude = mysql_real_escape_string($latitude);
        $longtitude = mysql_real_escape_string($longtitude);
        $result = self::getDB()->query("SELECT * FROM ?_places WHERE place_lat=$latitude AND place_lng=$longtitude;");
        return $result[0];
    }

    public static function updateById($id, $row)
    {
        self::getDB()->query('UPDATE ?_places SET ?a WHERE place_id=?d', $row, $id);

        return self::getById($id);
    }

    public static function deleteById($id)
    {
        $result = self::getDB()->query('DELETE FROM ?_places WHERE place_id=?d', $id);
        return array('result' => $result);
    }

    public static function getFFMPlaces($bounds) {
        if (! empty($bounds)) {
            $result = self::getDB()->query('SELECT * FROM ?_places
                                            WHERE place_ffm_id != 0
                                            AND place_lat>?f
                                            AND place_lng>?f
                                            AND place_lat<?f
                                            AND place_lng<?f', $bounds[0], $bounds[1], $bounds[2], $bounds[3]);

        } else {
            $result = self::getDB()->query('SELECT * FROM ?_places WHERE place_ffm_id != 0');
        }

        return $result;
    }
}
