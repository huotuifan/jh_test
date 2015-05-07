<?php

namespace db;

class DbResource extends \common\DbModel
{
    const ID = 'resource_id';
    const UUID = 'resource_uuid';
    const FOLDER = 'resource_folder';
    const URL = 'resource_url';
    const TITLE = 'resource_title';
    const DESCRIPTION = 'resource_description';
    const IMAGE = 'resource_image';
    const IMAGE_WIDTH = 'resource_image_width';
    const IMAGE_HEIGHT = 'resource_image_height';
    const VIDEO = 'resource_video';
    const VIDEO_WIDTH = 'resource_video_width';
    const VIDEO_HEIGHT = 'resource_video_height';
    const AUDIO = 'resource_audio';
    const USER_ID = DbUser::ID;
    const TYPE = 'resource_type';

    public static function create($row)
    {
        return array(
            self::ID => self::getDB()->query('INSERT INTO ?_resources(?#) VALUES(?a)', array_keys($row), array_values($row))
        );
    }

    public static function getById($id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_resources WHERE resource_id=?', $id);
    }

    public static function getByURL($url)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_resources WHERE resource_url=?', $url);
    }

    public static function updateById($id, $row)
    {
        return self::getDB()->query('UPDATE ?_resources SET ?a WHERE resource_id=?d', $row, $id);
    }

    public static function deleteById($id)
    {
        $result = self::getDB()->query('DELETE FROM ?_resources WHERE resource_id=?d', $id);
        return array('result' => $result);
    }
}
