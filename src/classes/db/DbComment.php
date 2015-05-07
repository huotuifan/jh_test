<?php

namespace db;

class DbComment extends \common\DbModel
{
    const ID = 'comment_id';
    const UUID = 'comment_uuid';
    const TEXT = 'comment_text';
    const DISABLED = 'comment_disabled';
    const USER_ID = DbUser::ID;
    const POST_ID = DbPost::ID;

    public static function create($row)
    {
        DbPost::updateCommentsById(1, $row[self::POST_ID]);
        $row[self::UUID] = \utils\Utils::genUuid(4);
        return array(
            self::ID => self::getDB()->query('INSERT INTO ?_comments(?#) VALUES(?a)', array_keys($row), array_values($row)),
            self::UUID => $row[self::UUID]
        );
    }

    public static function getById($id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_comments WHERE comment_id=?', $id);
    }

    public static function getByHash($hash)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_comments WHERE comment_uuid=?', $hash);
    }

    public static function getListByPostHash($hash, $disabled = 0, $from = 0, $count = 100)
    {
        $post = DbPost::getByHash($hash);

        if (empty($post) || !empty($post[DbPost::DISABLED])) {

            return null;

        } else {

            $result = self::getDb()->select('SELECT *
            FROM ?_comments, ?_users
            WHERE ?_comments.comment_disabled=?
                AND ?_comments.post_id=?
                AND ?_users.user_id=?_comments.user_id
            ORDER BY ?_comments.comment_time ASC',
                $disabled, $post[self::POST_ID], $from, $count);

            foreach ($result as &$comment) {
                $in = array('<', '>');
                $out = array('&lt;', '&gt;');
                $text = str_replace($in, $out, $comment[self::TEXT]);
                $comment[self::TEXT] = IS_MOBILE ? $text : emoji_unified_to_html($text);
            }

            return $result;
        }
    }

    public static function updateById($id, $row)
    {
        return self::getDB()->query('UPDATE ?_comments SET ?a WHERE comment_id=?d', $row, $id);
    }

    public static function deleteById($id, $postId)
    {
        DbPost::updateCommentsById(-1, $postId);
        $result = self::getDB()->query('DELETE FROM ?_comments WHERE comment_id=?d', $id);
        return array('result' => $result);
    }
}
