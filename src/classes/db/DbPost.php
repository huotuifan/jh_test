<?php

namespace db;

class DbPost extends \common\DbModel
{
    const ID = 'post_id';
    const UUID = 'post_uuid';
    const TITLE = 'post_title';
    const TEXT = 'post_text';
    const EVENT = 'post_event';
    const DISABLED = 'post_disabled';
    const CREATED = 'post_created';
    const LAT = 'post_lat';
    const LNG = 'post_lng';
    const TAGS = 'post_tags';
    const FILTER = 'post_filter';
    const RECOMMEND= 'post_recommend';
    const PENDING = 'post_pending';
    const COMMENTS_COUNT = 'comments_count';
    const USER_ID = DbUser::ID;
    const PLACE_ID = DbPlace::ID;

    public static function create($row)
    {
        $row[self::UUID] = \utils\Utils::genUuid();
        $row[self::CREATED] = date("Y-m-d H:i:s", time());

        return array(
            self::ID => self::getDB()->query('INSERT INTO ?_posts(?#) VALUES(?a)', array_keys($row), array_values($row)),
            self::UUID => $row[self::UUID]
        );
    }

    public static function appendResources($post_id, $resource_ids)
    {
        $tags = array();
        foreach ($resource_ids as $id) {
            self::getDB()->query('INSERT INTO ?_posts_resources(?#) VALUES(?a)', array('post_id', 'resource_id'), array($post_id, $id));
            $resource = DbResource::getById($id);
            $tags[$resource[DbResource::TYPE]] = true;
        }
        $row = array(
            DbPost::TAGS => implode(',', array_keys($tags))
        );
        DbPost::updateById($post_id, $row);
    }

    public static function getById($id)
    {
        return self::getDB()->selectRow('SELECT * FROM ?_posts WHERE post_id=? AND post_pending = 0', $id);
    }

    public static function getByHash($hash)
    {
        $post = self::getDB()->selectRow('SELECT
                ?_posts.*,
                ?_users.user_uuid,
                ?_users.user_name
            FROM ?_posts, ?_users, ?_places
            WHERE post_uuid=?
                AND ?_users.user_id=?_posts.user_id
                AND ?_posts.post_pending = 0', $hash);

        $place = DbPlace::getById($post[self::PLACE_ID]);
        $post['place'] = $place;
        self::getResources($post);
        return $post;
    }

    private static function includePlaceAndResources($posts)
    {
        foreach ($posts as &$post) {
            $place = DbPlace::getById($post[self::PLACE_ID]);
            $post['place'] = $place;
            self::getResources($post);
        }

        return $posts;
    }

    private static function getResources(&$post)
    {
        $in = array('<', '>');
        $out = array('&lt;', '&gt;');
        $text = str_replace($in, $out, $post[self::TEXT]);
        $post[self::TEXT] = IS_MOBILE ? $text : emoji_unified_to_html($text);

        $resources = self::getDb()->select('SELECT
              ?_resources.*
            FROM ?_resources, ?_posts_resources
            WHERE ?_posts_resources.post_id=?
                AND ?_resources.resource_id=?_posts_resources.resource_id',
            $post[self::ID]);
        $post['resources'] = $resources;
    }

    public static function clearResources($postId) {
        $result = self::getDB()->query('DELETE FROM ?_posts_resources WHERE post_id=?d', $postId);
        return array('result' => $result);
    }

    public static function getList($tag = '', $disabled = 0, $from = 0, $count = 100)
    {
        if (empty($tag)) {
            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND ?_users.user_id=?_posts.user_id
            ORDER BY ?_posts.post_modified DESC',
                $disabled, $from, $count);
        } else {
            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND FIND_IN_SET(?, ?_posts.post_tags) > 0
                AND ?_users.user_id=?_posts.user_id
            ORDER BY ?_posts.post_modified DESC',
                $disabled, $tag, $from, $count);
        }

        return self::includePlaceAndResources($posts);
    }

    public static function getPendingList($from = 0, $count = 20) {
        $posts = self::getDb()->select('SELECT
          ?_posts.*,
          ?_users.user_uuid,
          ?_users.user_name
        FROM ?_posts, ?_users
        WHERE ?_posts.post_disabled=0 AND ?_posts.post_pending = 1
            AND ?_users.user_id=?_posts.user_id
        ORDER BY ?_posts.post_modified DESC
        LIMIT ' . $from . ', ' . $count);

        return self::includePlaceAndResources($posts);
    }

    public static function getPendingPostsCount() {
        $result = self::getDb()->select('SELECT
        COUNT(?_posts.post_id) as pendingPostsCount
        FROM ?_posts
        WHERE ?_posts.post_disabled=0 AND ?_posts.post_pending = 1');

        return $result[0]['pendingPostsCount'];
    }

    public static function getListByBounds($bounds, $tag = '', $disabled = 0, $from = 0, $count = 100)
    {
        if (empty($tag)) {
            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND ?_users.user_id=?_posts.user_id
                AND ?_posts.post_lat>?f
                AND ?_posts.post_lng>?f
                AND ?_posts.post_lat<?f
                AND ?_posts.post_lng<?f
            ORDER BY ?_posts.post_modified DESC',
                $disabled, $bounds[0], $bounds[1], $bounds[2], $bounds[3], $from, $count);
        } else {
            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND FIND_IN_SET(?, ?_posts.post_tags) > 0
                AND ?_users.user_id=?_posts.user_id
                AND ?_posts.post_lat>?f
                AND ?_posts.post_lng>?f
                AND ?_posts.post_lat<?f
                AND ?_posts.post_lng<?f
            ORDER BY ?_posts.post_modified DESC',
                $disabled, $tag, $bounds[0], $bounds[1], $bounds[2], $bounds[3], $from, $count);
        }

        return self::includePlaceAndResources($posts);
    }

    public static function getListByUserHash($hash, $disabled = 0, $from = 0, $count = 100)
    {
        $user = DbUser::getByHash($hash);

        if (empty($user) || !empty($user[DbUser::DISABLED])) {

            return null;

        } else {

            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND ?_posts.user_id=?
                AND ?_users.user_id=?_posts.user_id
            ORDER BY ?_posts.post_created DESC',
                $disabled, $user[DbUser::ID], $from, $count);

            $user['favorited'] = DbFavorites::isUserFavorited($user[DbUser::ID]);

            return array(
                'posts' => self::includePlaceAndResources($posts),
                'user' => $user
            );
        }
    }

    public static function getListByPlaceHash($hash, $disabled = 0, $from = 0, $count = 100)
    {
        $place = DbPlace::getByHash($hash);

        if (empty($place) || !empty($place[DbPlace::DISABLED])) {

            return null;

        } else {

            $posts = self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND ?_posts.place_id=?
                AND ?_users.user_id=?_posts.user_id
            ORDER BY ?_posts.post_created DESC',
                $disabled, $place[DbPlace::ID], $from, $count);

            $place['favorited'] = DbFavorites::isPlaceFavorited($place[DbPlace::ID]);

            return array(
                'posts' => self::includePlaceAndResources($posts),
                'place' => $place
            );
        }
    }

    public static function getNextEventsByPlaceHash($hash, $disabled = 0, $from = 0, $count = 3)
    {
        $place = DbPlace::getByHash($hash);

        if (empty($place) || !empty($place[DbPlace::DISABLED])) {

            return null;

        } else {

            return self::getDb()->select('SELECT
              ?_posts.*,
              ?_users.user_uuid,
              ?_users.user_name
            FROM ?_posts, ?_users
            WHERE ?_posts.post_disabled=? AND ?_posts.post_pending = 0
                AND ?_posts.place_id=?
                AND ?_posts.post_event>?
                AND ?_users.user_id=?_posts.user_id
            ORDER BY ?_posts.post_event ASC
            LIMIT ?d, ?d',
                $disabled, $place[DbPlace::ID], date("Y-m-d H:i:s", time()), $from, $count);

        }
    }

    public static function updateCommentsById($count, $id)
    {
        $row = self::getDB()->selectRow('SELECT `comments_count` FROM ?_posts WHERE post_id=?d', $id);
        $sum = $row[self::COMMENTS_COUNT] + $count;
        return self::getDB()->query('UPDATE ?_posts SET comments_count=?d WHERE post_id=?d', $sum, $id);
    }

    public static function updateById($id, $row)
    {
        self::getDB()->query('UPDATE ?_posts SET ?a WHERE post_id=?d', $row, $id);

        return array(
            self::ID => $id,
            self::UUID => $row[self::UUID]
        );
    }

    public static function deleteById($id)
    {
        $result = self::getDB()->query('DELETE FROM ?_posts WHERE post_id=?d', $id);
        return array('result' => $result);
    }

}
