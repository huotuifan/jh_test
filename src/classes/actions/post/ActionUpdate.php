<?php

namespace actions\post;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbUser;
use \db\DbPlace;

class ActionUpdate extends \common\AjaxAction
{

    const NAME = 'post.update';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();

        if (!empty($sessionUser) && $sessionUser['user_level'] == 1) {
            $id = $this->getParam('id');
            $pending = $this->getParam('pending');

            $post = array(
                DbPost::PENDING => $pending
            );

            if ($pending == 1) {
                $post[DbPost::DISABLED] = 1;
            }

            DbPost::updateById($id, $post);

            Utils::json(array(
                self::STATUS => self::OK
            ));
        }
    }
}
