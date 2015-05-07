<?php

namespace actions\post;

use \utils\Utils;
use \db\DbPost;

class ActionList extends \common\AjaxAction
{

    const NAME = 'post.list';

    function getName()
    {
        return self::NAME;
    }
    
    function applyFilter($posts, $filter)
    {
        
        if($filter == "")
            return $posts;
        

        $filtered_posts= array();
        foreach ($posts as $post)
        {
            $postFilter= $post[DbPost::FILTER];
            $searchStrings= explode (";", $filter);
            foreach ($searchStrings as $searchString)
            {
                if(strstr($postFilter, $searchString))
                {
                    array_push($filtered_posts, $post);
                    break;
                }
            }
        }
        
        return $filtered_posts;
    }

    function execute()
    {
        $bounds = explode(',', trim($this->model['bounds']));
        $tag = trim($this->model['filter']);
        $filter="";
        if(!in_array($tag, array('audio','video','photo',''))) // search is filter
        {
            $filter= $tag;
            $tag= "";
        }
    
        if (!empty($bounds) && count($bounds) == 4) {
            $posts = DbPost::getListByBounds($bounds, $tag);
        } else {
            $posts = DbPost::getList($tag);
        }
        
        $posts= $this-> applyFilter($posts, $filter);
        
        $view = new \common\View();
        $view->setModel(
            array(
                'posts' => $posts
            ));
        $html = $view->fetch('post/postList.tpl');

        $places = array();
        foreach ($posts as &$post) {
            if (!empty($post['place'])) {
                $id = $post['place'][\db\DbPlace::UUID];
                if (empty($places[$id])) {
                    $places[$id] = $post['place'];
                    $places[$id]['posts'] = array();
                }
                array_push($places[$id]['posts'], $post[DbPost::ID]);

                $postTags = explode(',', $post['post_tags']);
                if (count($postTags) == 1 && $postTags[0] == '') {
                    $postTags[0] = 'text';
                }

                if (! empty($places[$id]['postType']) && $places[$id]['postType'] !== 'various') {
                    if (count($postTags) > 1) {
                        $places[$id]['postType'] = 'various';
                    } else {
                        if ($places[$id]['postType'] !== $postTags[0]) {
                            $places[$id]['postType'] = 'various';
                        }
                    }
                } else {
                    if (count($postTags) > 1) {
                        $places[$id]['postType'] = 'various';
                    } else {
                        $places[$id]['postType'] = $postTags[0];
                    }
                }
            }
        }

        Utils::json(array(
            self::STATUS => self::OK,
            'places' => $places,
            'html' => $html
        ));
    }
}
