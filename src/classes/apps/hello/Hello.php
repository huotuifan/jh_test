<?php

namespace apps\hello;

use \common\PagesLinks;
use \utils\Users;

class Hello extends \common\Presenter {

    const PATTERN = '%^/admin/?([0-9]*)?$%';

    function getPattern() {
        return self::PATTERN;
    }

    function init() {
        $sessionUser = Users::getSessionUser();

        if (empty($sessionUser) || $sessionUser['user_level'] != 1) {
            header('HTTP/1.0 401 Unauthorised');
            die("Unauthorised");
        }

        $params = $this->getParams();

        $currentPage = (isset($params[1]) && $params[1] != '') ? $params[1] : 1;
        $itemsPerPage = 20;
        $pagesToSide = 5;
        $from = ($currentPage - 1) * $itemsPerPage;

        $pendingPostsCount = \db\DbPost::getPendingPostsCount();

        $posts = \db\DbPost::getPendingList($from, $itemsPerPage);

        $pagesLinks = new PagesLinks('/admin/', $currentPage, $pendingPostsCount, $itemsPerPage, $pagesToSide);

        $view = new \common\View();
        $view->setModel(
            array(
                 'posts' => $posts,
                 'pagesLinks' => $pagesLinks->getLinks()
            )
        );
        $view->display(__DIR__ . DS . 'hello.tpl');
    }
}
