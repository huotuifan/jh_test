<?php

namespace actions\post;

use \utils\Utils;
use \utils\Users;
use \db\DbPost;
use \db\DbComment;
use \db\DbUser;

class ActionComment extends \common\AjaxAction
{

    const NAME = 'post.comment';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {

            $post = DbPost::getByHash($this->model['post']);

            if (!empty($post) && empty($post[DbPost::DISABLED])) {
                $commentId = $this->getParamTrimmed('comment_id');
                $commentExists = false;
                $allowEdit = true;
                $existing = null;

                if (! empty($commentId)) {
                    $existing = DbComment::getById($commentId);
                    if (count($existing) > 0) {
                        $commentExists = true;
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

                if ($this->getParamTrimmed('doDelete') == 1 && $commentExists) {
                    Utils::json(DbComment::deleteById($commentId, $existing['post_id']));
                    exit;
                }

                $row = array(
                    DbComment::TEXT => trim($this->model['comment']),
                    DbComment::POST_ID => $post[DbPost::ID]
                );

                if (! $commentExists) {
                    $row[DbComment::USER_ID] = $sessionUser[DbUser::ID];
                }

                if (!empty($row[DbComment::TEXT])) {
                    if ($commentExists) {
                        DbComment::updateById($commentId, $row);
                    } else {
                        DbComment::create($row);
                    }

                    Utils::json(array(
                        self::STATUS => self::OK
                    ));
                }
            }
        }
    }
}
