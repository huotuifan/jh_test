<?php

namespace actions\post;

use \utils\Utils;
use \utils\Users;
use \db\DbPostRec;
use \db\DbPost;
use \db\DbUser;

class ActionPostRec extends \common\AjaxAction
{

    const NAME = 'post.postRec';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $success= True;
        // create recommend to be stored into DbPostRec
                  
        $sessionUser = Users::getSessionUser();
        if (!empty($sessionUser)) {
            $post_id = $this->getParamTrimmed('post_id');
            $rec = $this->getParamTrimmed('rec');
            if(empty($rec))
                $rec= "upvote";
            if($rec == "upvote")
                $user_action= 1;
            else
                $user_action= 0;
            $user_id= $sessionUser[DbUser::ID];
            $recommend = array(
                          DbPostRec::POST_ID => $post_id,
                          DbPostRec::USER_ID => $user_id,
                          DbPostRec::ACTION => $user_action
                   );
            
            }
        else
            $success= False;
        
        
        // insert recommend into DbPostRec
        $inserted= DbPostRec::create($recommend);
        $insertId= $inserted[DbPostRec::ID];
        
        // create update to increment or decrement post_recommend in DbPost
        $row_to_update= DbPost::getById($post_id);
        $recommend_count= $row_to_update[DbPost::RECOMMEND];
        
        if($insertId != -1)
        {
            
            if($rec == "upvote")
                $recommend_count ++;
            else
                $recommend_count --;

            $post_update= array( DbPost::RECOMMEND => $recommend_count);
             DbPost::updateById($post_id, $post_update);
        }
        else
        {
            $success= False;
        }
        
        
        if($success)
        {
            $response = array(self::STATUS => self::OK, 'count' => $recommend_count);
            Utils::json($response);
        }
        else
        {
            Utils::json(array(
                              'model' => $post,
                              'elements' => array(
                                                  'ErrorMessage' => Utils::getMessage('p005')
                                                  )
                              ));
            
        }
        
     
    }
}

