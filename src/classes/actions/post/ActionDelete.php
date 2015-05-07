<?php

namespace actions\post;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbUser;
use \db\DbPlace;

class ActionDelete extends \common\AjaxAction
{

    const NAME = 'post.delete';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();

        if (! empty($sessionUser) && $sessionUser['user_level'] == 1) {
            $hash = $this->getParamTrimmed('post_hash');
            $post = DbPost::getByHash($hash);

            Utils::json(DbPost::deleteById($post['post_id']));
        }
    }
}
