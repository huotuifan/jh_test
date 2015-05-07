<?php

namespace actions\resource;

use \utils\Utils;
use \utils\Users;
use \db\DbResource;
use \db\DbUser;

class ActionCheck extends \common\AjaxAction
{

    const NAME = 'resource.check';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {

            function addhttp($url)
            {
                if (!preg_match("~^https?://~i", $url)) {
                    $url = "http://" . $url;
                }
                return $url;
            }

            $url = addhttp($this->getParamTrimmed('url'));

            $res = DbResource::getByURL($url);
            if (empty($res)) {

                $content = file_get_contents($url);
                if (empty($content)) {
                    Utils::json(array(
                        'errors' => array(
                            'PostResourceURL'
                        )
                    ));
                    exit;
                }

                $data = \utils\OpenGraph::fetch($content);
                $values = $data->_values;

                if (empty($values)) {
                    $values = array(
                        'url' => $url,
                        'title' => $url
                    );
                }


                function checkType($type)
                {
                    $tags_map = array(
                        'audio' => array('music', 'sound', 'song', 'album', 'playlist', 'radio_station'),
                        'video' => array('video', 'movie', 'episode', 'tv_show'),
                        'photo' => array('photo', 'image')
                    );

                    $result = '';

                    if (!empty($type)) {
                        foreach ($tags_map as $tag => $values) {
                            if (preg_match('/' . implode("|", $values) . '/i', $type)) {
                                $result = $tag;
                                break;
                            }
                        }
                    }

                    return $result;
                }

                $tag = checkType($values['type']);

                $image_url = $values['image'];
                $resource = array(
                    DbResource::UUID => \utils\Utils::genUuid(10),
                    DbResource::FOLDER => date('Ym'),
                    DbResource::URL => empty($values['url']) ? $url : $values['url'],
                    DbResource::TITLE => empty($values['title']) ? 'Untitled' : $values['title'],
                    DbResource::DESCRIPTION => empty($values['description']) ? '' : $values['description'],
                    DbResource::IMAGE => $image_url,
                    DbResource::IMAGE_WIDTH => $values['image:width'],
                    DbResource::IMAGE_HEIGHT => $values['image:height'],
                    DbResource::VIDEO => $values['video'],
                    DbResource::VIDEO_WIDTH => $values['video:width'],
                    DbResource::VIDEO_HEIGHT => $values['video:height'],
                    DbResource::AUDIO => $values['audio'],
                    DbResource::USER_ID => $sessionUser[DbUser::ID],
                    DbResource::TYPE => $tag,
                );

                $res = DbResource::getByURL($resource[DbResource::URL]);
                if (empty($res)) {
                    if (!empty($image_url)) {
                        $image_string = file_get_contents($image_url);

                        $im = imagecreatefromstring($image_string);

                        $thumbnail = \utils\Image::getThumbnail($im, 260, 260);

                        $dir = DIR_RESOURCES . DS . $resource[DbResource::FOLDER] . DS;
                        $file_path = $dir . $resource[DbResource::UUID] . '.jpg';

                        Utils::mkdir_p($dir);

                        \utils\Image::saveImage($file_path, $thumbnail, 90);
                    }

                    $r = DbResource::create($resource);
                    $resource[DbResource::ID] = $r[DbResource::ID];

                    Utils::json(array(
                        self::STATUS => self::OK,
                        'new' => true,
                        'resource' => $resource
                    ));
                    exit;
                }
            }

            Utils::json(array(
                self::STATUS => self::OK,
                'existing' => true,
                'resource' => $res
            ));
        }
    }
}