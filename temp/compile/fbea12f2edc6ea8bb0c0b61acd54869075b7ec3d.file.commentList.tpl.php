<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 03:51:02
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1449173928549b89a657bc12-27935538%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbea12f2edc6ea8bb0c0b61acd54869075b7ec3d' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/commentList.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1449173928549b89a657bc12-27935538',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/Users/andrehsu/public/web_development/noisymap/src/classes/smarty/plugins/modifier.escape.php';
?><div class="nm-Comment-title" id="comments">Comments</div>
<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
    <?php if ($_smarty_tpl->tpl_vars['comment']->value['user_id']==$_smarty_tpl->getVariable('post')->value['user_id']){?>
        <?php $_smarty_tpl->tpl_vars['commentStyle'] = new Smarty_variable('nm-Comment nm-Comment-author', null, null);?>
        <?php }else{ ?>
        <?php $_smarty_tpl->tpl_vars['commentStyle'] = new Smarty_variable('nm-Comment', null, null);?>
    <?php }?>
<div id="<?php echo $_smarty_tpl->tpl_vars['comment']->value['comment_id'];?>
" class="<?php echo $_smarty_tpl->getVariable('commentStyle')->value;?>
">
    <?php if ($_smarty_tpl->getVariable('USER')->value['user_level']==1){?>
    <div class="nm-Comment-adminButtons">
        <span class="nm-Comment-editButton" data-post-uuid="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
" data-comment-id="<?php echo $_smarty_tpl->tpl_vars['comment']->value['comment_id'];?>
">Edit</span>
        <span class="nm-Comment-deleteButton" data-post-uuid="<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
" data-comment-id="<?php echo $_smarty_tpl->tpl_vars['comment']->value['comment_id'];?>
">Delete</span>
    </div>
    <?php }?>
    <div class="nm-Comment-content"><?php echo nl2br($_smarty_tpl->tpl_vars['comment']->value['comment_text']);?>
</div>
    <?php if ($_smarty_tpl->getVariable('USER')->value['user_level']==1){?>
        <?php $_template = new Smarty_Internal_Template('post/commentFormEdit.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php }?>
    <div class="nm-Comment-info"><a href="/posts/<?php echo $_smarty_tpl->getVariable('post')->value['post_uuid'];?>
#<?php echo $_smarty_tpl->tpl_vars['comment']->value['comment_uuid'];?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value['comment_time'];?>
</a>
        - <a href="/users/<?php echo $_smarty_tpl->tpl_vars['comment']->value['user_uuid'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['comment']->value['user_name']);?>
</a></div>
</div>
<?php }} ?>
<script type="text/javascript">
    require(['widgets/post/form', 'common/utils'], function (form, utils) {
        $.each($('.CommentFormEdit'), function() {
            var commentId = $(this).attr('data-comment-id');

            form.init({
                form: 'CommentForm-' + commentId,
                text: 'CommentField-' + commentId,
                action: 'post.comment',
                resize: true
            });
        });

        $('.nm-Comment-editButton').click(function() {
            $('.CommentFormEdit').parent().hide();
            $('.nm-Comment-content').show();

            var commentId = $(this).attr('data-comment-id');
            var $commentContent = $('#' + commentId + ' .nm-Comment-content').hide();
            $('#CommentField-' + commentId).val($commentContent.text());
            $('#CommentForm-' + commentId).parent().show();
        });

        $('.nm-Comment-cancelEdit').click(function() {
            var commentId = $(this).parents('form').attr('data-comment-id');
            $('#CommentField-' + commentId).val('');
            $('#CommentForm-' + commentId).parent().hide();
            $('#' + commentId + ' .nm-Comment-content').show();
        });

        $('.nm-Comment-deleteButton').click(function() {
            if (confirm('Are you sure you wish to delete this comment?')) {
                var commentId = $(this).attr('data-comment-id');

                var data = {
                    comment_id: commentId,
                    doDelete: 1
                };
                utils.simpleAction('post.comment', data, function (result) {
                    if (result.result == 1) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
