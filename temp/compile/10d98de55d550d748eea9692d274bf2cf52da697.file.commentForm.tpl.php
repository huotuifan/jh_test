<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 03:51:02
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:795956072549b89a65d5631-16844359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10d98de55d550d748eea9692d274bf2cf52da697' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentForm.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '795956072549b89a65d5631-16844359',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="padding: 0 10px;">
    <form id="CommentForm">
        <div style="padding-bottom: 10px;">
            <textarea name="comment" id="CommentField" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        </div>

        <div>
            <input type="hidden" name="post" value="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
">
            <input type="submit" value="Comment" class="f-button" style="width: 100px;"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
<script type="text/javascript">
require(['widgets/post/form'], function (form) {
    form.init({
        form: 'CommentForm',
        text: 'CommentField',
        action: 'post.comment',
        resize: true
    });
});
</script>
