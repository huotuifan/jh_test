<?php

namespace db;

class DbPostRec extends \common\DbModel
{
    const ID= 'ID';
    const POST_ID = 'post_id';
    const USER_ID = 'user_id';
    const ACTION= 'action';

    public static function create($row)
    {
        $record= DbPostRec::getByIdPair($row[self::USER_ID], $row[self::POST_ID]);
        if(empty($record))
        {
           return array(
            self::ID => self::getDB()->query('INSERT INTO ?_post_recommend(?#) VALUES(?a)', array_keys($row), array_values($row))
            );
        }
        else
        {
            return array(
                         self::ID => -1
                         );
        }
        
    }

    public static function getByIdPair($user_id, $post_id)
    {
        return self::getDB()->select('SELECT * FROM ?_post_recommend WHERE user_id=? AND post_id = ?', $user_id, $post_id);
    }

    public static function deleteById($id)
    {
        $result = self::getDB()->query('DELETE FROM ?_post_recommend(?#) WHERE ID=?d', $id);
        return array('result' => $result);
    }
}

