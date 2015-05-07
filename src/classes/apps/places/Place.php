<?php

namespace apps\places;

use utils\HTTP;

class Place extends \common\Presenter
{

    const PATTERN = '%^/places/([A-Za-z0-9]{8})$%';

    function getPattern()
    {
        return self::PATTERN;
    }

    function init()
    {
        $params = $this->getParams();
        $result = \db\DbPost::getListByPlaceHash($params[1]);

        if (empty($result)) {
            HTTP::pageNotFound();
        } else {
            foreach ($result['posts'] as &$post) {
                $postTags = explode(',', $post['post_tags']);
                if (count($postTags) == 1 && $postTags[0] == '') {
                    $postTags[0] = 'text';
                }
                if (count($postTags) > 1) {
                    $result['place']['postType'] = 'various';
                    break;
                } else {
                    if (! empty($result['place']['postType'])) {
                        if ($result['place']['postType'] !== $postTags[0]) {
                            $result['place']['postType'] = 'various';
                            break;
                        }
                    } else {
                        if (count($postTags) > 1) {
                            $result['place']['postType'] = 'various';
                        } else {
                            $result['place']['postType'] = $postTags[0];
                        }
                    }
                }
            }

            $events = \db\DbPost::getNextEventsByPlaceHash($params[1]);

            $result['events'] = $events;

            $view = new \common\View();
            $view->setModel($result);
            $view->display(__DIR__ . DS . 'place.tpl');
        }
    }
}
