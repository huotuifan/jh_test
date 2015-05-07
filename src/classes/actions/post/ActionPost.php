<?php

namespace actions\post;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbUser;
use \db\DbPlace;

class ActionPost extends \common\AjaxAction
{

    const NAME = 'post.post';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {
            $id = $this->getParamTrimmed('id');
            $filter= $this->getParamTrimmed('postFilter');
            $title = $this->getParamTrimmed('title');
            $text = $this->getParamTrimmed('text');
            $event = $this->getParamTrimmed('event');
            $place = $this->getParamTrimmed('place');

            $postExists = false;
            $allowEdit = true;

            if (! empty($id)) {
                $existing = DbPost::getById($id);
                if (count($existing) > 0) {
                    $postExists = true;
                    if ($sessionUser[DbUser::LEVEL] != 1) {
                        $allowEdit = false;
                    }
                }
            }

            if (! $allowEdit) {
                Utils::json(array(
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('e001')
                    )
                ));
                exit;
            }

            if($event == '')
            {
                $post = array(
                              DbPost::TITLE => $title,
                              DbPost::TEXT => $text,
                              DbPost::FILTER => $filter
                              );
            }
            else
            {
                $post = array(
                              DbPost::TITLE => $title,
                              DbPost::TEXT => $text,
                              DbPost::FILTER => $filter,
                              DbPost::EVENT => $event
                              );
            }

            if (! $postExists) {
                $post[DbPost::USER_ID] = $sessionUser[DbUser::ID];
            }

            if (empty($post[DbPost::TITLE])) {
                Utils::json(array(
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('p001')
                    )
                ));
                exit;
            }

            if (empty($post[DbPost::TEXT])) {
                Utils::json(array(
                    'model' => $post,
                    'elements' => array(
                        'ErrorMessage' => Utils::getMessage('p002')
                    )
                ));
                exit;
            }

            if (!empty($place)) {
                $p = DbPlace::getById($place);
                if (!empty($p)) {
                    $post[DbPost::PLACE_ID] = $p[DbPlace::ID];
                    $post[DbPost::LAT] = $p[DbPlace::LAT];
                    $post[DbPost::LNG] = $p[DbPlace::LNG];
                }
            }

            if ($sessionUser['user_level'] == 1) {
                $post[DbPost::PENDING] = 0;
            }

            if ($postExists) {
                $p = DbPost::updateById($id, $post);
            } else {
                $p = DbPost::create($post);
            }

            DbPost::clearResources($id);
            $resource_ids = $this->getParam('resource');
            if (!empty($resource_ids)) {
                DbPost::appendResources($p[DbPost::ID], $resource_ids);
            }

            $response = array(self::STATUS => self::OK);
            if (! $postExists) {
                $response[DbPost::UUID] = $p[DbPost::UUID];
            }

            Utils::json($response);
        }
    }
}
