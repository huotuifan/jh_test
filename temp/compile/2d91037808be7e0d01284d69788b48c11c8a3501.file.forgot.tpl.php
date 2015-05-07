<?php /* Smarty version Smarty-3.0.8, created on 2014-12-26 23:57:33
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/classes/apps/accounts/forgot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:653143362549df5ed3242c8-10490182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d91037808be7e0d01284d69788b48c11c8a3501' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/classes/apps/accounts/forgot.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '653143362549df5ed3242c8-10490182',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_smarty_tpl->getVariable('DIC')->value['global']['title'];?>
</title>
    <?php $_template = new Smarty_Internal_Template('global/scripts.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
<body class="nm-Page">
<?php $_template = new Smarty_Internal_Template('global/header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('noauth',true); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div class="nm-Content">
    <div class="nm-Content-inner">
        <?php if ($_smarty_tpl->getVariable('show_change')->value){?>
            <?php $_template = new Smarty_Internal_Template('accounts/changePassword.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }else{ ?>
            <?php $_template = new Smarty_Internal_Template('accounts/forgotPassword.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template('global/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>