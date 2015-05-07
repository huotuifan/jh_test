<?php

namespace apps\posts;

use utils\HTTP;

class Post extends \common\Presenter
{

    const PATTERN = '%^/posts/([A-Za-z0-9]{8})$%';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $params = $this->getParams();
        $post = \db\DbPost::getByHash($params[1]);

        if (empty($post)) {
            HTTP::pageNotFound();
        } else {
            $comments = \db\DbComment::getListByPostHash($post[\db\DbPost::UUID]);
            $view = new \common\View();
            $view->setModel(
                array(
                    'post' => $post,
                    'comments' => $comments
                ));
            $view->display(__DIR__ . DS . 'post.tpl');

        }
    }
}
