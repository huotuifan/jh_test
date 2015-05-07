<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 01:30:59
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/postList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2022023429549b68d3df0e19-84646344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c017f9e5f403e052ee4c3c37b0ec83f5269556b6' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/postList.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2022023429549b68d3df0e19-84646344',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>
<?php $_template = new Smarty_Internal_Template("post/post.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }} else { ?>
<div class="nm-Content-empty"><?php echo $_smarty_tpl->getVariable('DIC')->value['global']['empty'];?>
</div>
<?php } ?>
<script type="text/javascript">
require(['jquery', 'global/player', 'common/utils'], function ($, player, utils) {
    player.init();

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
                    window.location.reload();
                }
            });
        }
    });
});
</script>
