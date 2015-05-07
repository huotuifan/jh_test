<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 01:31:07
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/classes/apps/users/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:629477736549b68db139307-61342881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e794160b60c2cd0e1b7fe046612e6a7d7a0bf464' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/classes/apps/users/user.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '629477736549b68db139307-61342881',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/Users/andrehsu/public/web_development/noisymap/src/classes/smarty/plugins/modifier.escape.php';
?><!DOCTYPE html>
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
    <div class="nm-Content-inner" style="padding-top: 40px;">
        <h1 class="nm-User-title"><?php if (!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)&&$_smarty_tpl->getVariable('USER')->value['user_id']!=$_smarty_tpl->getVariable('user')->value['user_id']){?>
                <?php if (!empty($_smarty_tpl->getVariable('user',null,true,false)->value['favorited'])){?>
                    <div class="nm-Favorites-remove" data-user="<?php echo $_smarty_tpl->getVariable('user')->value['user_id'];?>
"><?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['favoriteRemove'];?>
</div>
                <?php }else{ ?>
                    <div class="nm-Favorites-add" data-user="<?php echo $_smarty_tpl->getVariable('user')->value['user_id'];?>
"><?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['favoriteAdd'];?>
</div>
                <?php }?>
                <script>
                    require(['global/favorites']);
                </script>
            <?php }?><?php echo $_smarty_tpl->getVariable('user')->value['user_name'];?>
</h1>
        <div class="nm-User-right">
            <?php if (!empty($_smarty_tpl->getVariable('user',null,true,false)->value['user_about'])){?>
                <div class="nm-User-about">
                    <h2>About</h2>
                    <div class="nm-User-aboutText"><?php echo nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('user')->value['user_about']));?>
</div>
                </div>
            <?php }?>
        </div>
        <div class="nm-User-left">
            <div style="padding: 0 0 32px;">
            <?php $_template = new Smarty_Internal_Template('post/postList.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            </div>
        </div>
    </div>

</div>
<?php $_template = new Smarty_Internal_Template('global/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>