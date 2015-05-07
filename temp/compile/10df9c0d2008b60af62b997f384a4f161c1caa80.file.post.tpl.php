<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 03:51:02
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/classes/apps/posts/post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:523410697549b89a64df178-65039699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10df9c0d2008b60af62b997f384a4f161c1caa80' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/classes/apps/posts/post.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '523410697549b89a64df178-65039699',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
<head>
    <title>Noisymap</title>
<?php $_template = new Smarty_Internal_Template('global/scripts.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
<body class="nm-Page">
<?php $_template = new Smarty_Internal_Template('global/header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div class="nm-Content">
    <div class="nm-Content-inner">
    <?php $_template = new Smarty_Internal_Template("post/post.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <script type="text/javascript">
            require(['global/player'], function (player) {
                player.init();
            });
        </script>
    <?php if (!empty($_smarty_tpl->getVariable('post',null,true,false)->value['post_id'])){?>
        <?php $_template = new Smarty_Internal_Template('post/commentList.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php if (!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)){?>
            <div style="padding: 32px 0;">
            <?php $_template = new Smarty_Internal_Template('post/commentForm.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            </div>
        <?php }?>
    <?php }?>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template('global/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<script type="text/javascript">
    require(['jquery', 'common/utils'], function ($, utils) {
        $('.nm-Post-editButton').click(function () {
            var $form = $('#post-' + $(this).attr('data-post-uuid'));
            require(['global/post'], function (editor) {
                editor.editArray($form.serializeArray(), function () {

                });
            });
        });

        $('.nm-Post-deleteButton').click(function () {
            if (confirm('Are you sure you wish to delete this post?')) {
                var postHash = $(this).attr('data-post-uuid');
                utils.simpleAction('post.delete', {post_hash: postHash}, function (result) {
                    if (result.result == 1) {
                        window.history.back();
                    }
                });
            }
        });
    });
</script>
</body>
</html>