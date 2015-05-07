<?php /* Smarty version Smarty-3.0.8, created on 2015-03-29 16:51:23
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97671442255188ffbc421e7-39292205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4317b0c3d17110160f59cb6ed63376819ca3e7d5' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/post.tpl',
      1 => 1427672810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97671442255188ffbc421e7-39292205',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/Users/andrehsu/public/web_development/noisymap/src/classes/smarty/plugins/modifier.escape.php';
?><?php if (!empty($_smarty_tpl->getVariable('post',null,true,false)->value['post_id'])){?>
<?php $_smarty_tpl->tpl_vars['is_editable'] = new Smarty_variable(!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)&&$_smarty_tpl->getVariable('USER')->value['user_level']==1, null, null);?>
<?php $_smarty_tpl->tpl_vars['encoded_resources'] = new Smarty_variable(json_encode($_smarty_tpl->getVariable('post')->value['resources']), null, null);?>
<?php $_smarty_tpl->tpl_vars['encoded_place'] = new Smarty_variable(json_encode($_smarty_tpl->getVariable('post')->value['place']), null, null);?>
<div class="nm-Post" xmlns="http://www.w3.org/1999/html">
    <div class="nm-Post-column">
        <div class="nm-Post-title">
            <a href="/posts/<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['post_title']);?>
</a>
            <?php if ($_smarty_tpl->getVariable('is_editable')->value){?>
                <span class="nm-Post-editButton" data-post-uuid="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
">Edit</span>
                <span class="nm-Post-deleteButton" data-post-uuid="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
">Delete</span>
                <form id="post-<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
">
                    <input type="hidden" name="post_id" value="<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
"/>
                    <input type="hidden" name="post_title" value="<?php echo $_smarty_tpl->getVariable('post')->value['post_title'];?>
"/>
                    <input type="hidden" name="post_text" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['post_text']);?>
"/>
                    <input type="hidden" name="post_place" value="<?php echo $_smarty_tpl->getVariable('post')->value['place']['place_id'];?>
"/>
                    <input type="hidden" name="post_event" value="<?php echo $_smarty_tpl->getVariable('post')->value['post_event'];?>
"/>
                    <input type="hidden" name="post_place_data" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('encoded_place')->value);?>
"/>
                    <input type="hidden" name="post_resources" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('encoded_resources')->value);?>
"/>
                </form>
            <?php }?>
        </div>
        <div class="nm-Post-content"><?php echo nl2br($_smarty_tpl->getVariable('post')->value['post_text']);?>
</div>
        <?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('post')->value['resources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value){
?>
            <div class="nm-Post-resource" data-audio="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_audio'];?>
" data-video="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_video'];?>
" data-video-width="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_video_width'];?>
" data-video-height="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_video_height'];?>
">
                <?php if ($_smarty_tpl->tpl_vars['resource']->value['resource_image']){?>
                    <?php if (empty($_smarty_tpl->tpl_vars['resource']->value['resource_video'])&&empty($_smarty_tpl->tpl_vars['resource']->value['resource_audio'])){?>
                        <div class="nm-Post-resourceImage"><a href="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_url'];?>
"><img src="/resources/<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_folder'];?>
/<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_uuid'];?>
.jpg" alt="" width="130"></a></div>
                    <?php }else{ ?>
                        <div class="nm-Post-resourceImage"><img src="/resources/<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_folder'];?>
/<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_uuid'];?>
.jpg" alt="" width="130"></div>
                    <?php }?>
                    <div class="nm-Post-resourceColumn">
                        <div class="nm-Post-resourceTitle"><a href="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_url'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['resource']->value['resource_title']);?>
</a></div>
                        <div class="nm-Post-resourceDescription"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['resource']->value['resource_description']);?>
</div>
                    </div>
                <?php }else{ ?>
                    <div class="nm-Post-resourceTitle"><a href="<?php echo $_smarty_tpl->tpl_vars['resource']->value['resource_url'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['resource']->value['resource_title']);?>
</a></div>
                    <div class="nm-Post-resourceDescription"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['resource']->value['resource_description']);?>
</div>
                <?php }?>
            </div>
        <?php }} ?>
    </div>
    <div class="nm-Post-info">
        <ul>
            <?php if (!empty($_smarty_tpl->getVariable('post',null,true,false)->value['post_tags'])){?>
                <li class="nm-Post-tags">
                    <?php $_smarty_tpl->tpl_vars['tags'] = new Smarty_variable(explode(",",$_smarty_tpl->getVariable('post')->value['post_tags']), null, null);?>
                    <?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tags')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['tag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['tag']->iteration=0;
if ($_smarty_tpl->tpl_vars['tag']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value){
 $_smarty_tpl->tpl_vars['tag']->iteration++;
 $_smarty_tpl->tpl_vars['tag']->last = $_smarty_tpl->tpl_vars['tag']->iteration === $_smarty_tpl->tpl_vars['tag']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tags']['last'] = $_smarty_tpl->tpl_vars['tag']->last;
?>
                        <a href="/tags/<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['tags']['last']){?>, <?php }?>
                    <?php }} ?>
                </li>
            <?php }?>
            <?php if (!empty($_smarty_tpl->getVariable('post',null,true,false)->value['place'])){?><li class="nm-Post-location"><a href="/places/<?php echo $_smarty_tpl->getVariable('post')->value['place']['place_uuid'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['place']['place_name']);?>
</a></li><?php }?>
            <li class="nm-Post-person"><a href="/users/<?php echo $_smarty_tpl->getVariable('post')->value['user_uuid'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['user_name']);?>
</a></li>
            <li class="nm-Post-comments"><a href="/posts/<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
#comments"><?php echo $_smarty_tpl->getVariable('post')->value['comments_count'];?>
 Comment</a></li>
	    
	    <li>
		<img id="upvote_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
" src="/i/decor/post-upvote.png" alt="Upvote" style="width:17px;height:17px;position:relative;left:-17px">
		<img id= "downvote_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
" src="/i/decor/post-downvote.png" alt="Downvote" style="width:17px;height:17px;position:relative;left:-17px">
		<span id="recommend_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
" style="color:#4a95c2;position:relative;left:-13px"> <?php echo $_smarty_tpl->getVariable('post')->value['post_recommend'];?>
 Recommend<span>
	    </li>
	    
        </ul>
    </div>
</div>
<?php }else{ ?>
    <div class="nm-Message-container">
        <p><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['pending'];?>
</p>
        <a href="/"><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['home'];?>
</a>
    </div>

<?php }?>
<!--- functions related to recommend --->
<script type="text/javascript">
require([
    'jquery','common/utils'
], function ($, utils) {
 
    $('#upvote_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
').click(function (e) {
        reload(<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
, 'upvote');
        e.preventDefault();
    });
    
    $('#downvote_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
').click(function (e) {
        reload(<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
, 'downvote');
        e.preventDefault();
    });

     
    function reload(post_id, rec) {
        utils.simpleAction('post.postRec', {
            post_id: post_id,
            rec: rec
            }, function (data) {
                if(data.count != null)
                {
                    $('#ErrorMessage').hide();
                    $('#recommend_<?php echo $_smarty_tpl->getVariable('post')->value['post_id'];?>
').text(data.count + " Recommend");
                }
            });
    }
     
  


});
</script>



<!--- ends here --->
