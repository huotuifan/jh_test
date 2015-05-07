<?php /* Smarty version Smarty-3.0.8, created on 2015-01-20 02:12:25
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentFormEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214213029154bdb989f0ac13-24746151%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bcc7c3c76fd6bed598f8e74630daba7b1182728' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentFormEdit.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214213029154bdb989f0ac13-24746151',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="padding: 0 32px; display: none;">
    <form id="CommentForm-<?php echo $_smarty_tpl->getVariable('comment')->value['comment_id'];?>
" class="CommentFormEdit" data-comment-id="<?php echo $_smarty_tpl->getVariable('comment')->value['comment_id'];?>
">
        <div style="padding-bottom: 10px;">
            <textarea name="comment" id="CommentField-<?php echo $_smarty_tpl->getVariable('comment')->value['comment_id'];?>
" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        </div>
        <div>
            <input type="hidden" name="post" value="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
">
            <input type="hidden" name="comment_id" value="<?php echo $_smarty_tpl->getVariable('comment')->value['comment_id'];?>
">
            <input type="submit" value="Save" class="f-button" style="width: 100px;"/>
            <input type="button" value="Cancel" class="f-button nm-Comment-cancelEdit" style="width: 100px;"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
