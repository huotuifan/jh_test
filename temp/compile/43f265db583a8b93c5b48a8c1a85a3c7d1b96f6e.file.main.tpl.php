<?php /* Smarty version Smarty-3.0.8, created on 2014-12-25 01:31:40
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/mail/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1088274365549b68fc687133-37808438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43f265db583a8b93c5b48a8c1a85a3c7d1b96f6e' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/mail/main.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1088274365549b68fc687133-37808438',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="width: 720px; margin: 0 auto; color: #212121; font: 12px Helvetica, Arial, sans-serif;">
    <div style="padding: 20px 0; border-bottom: 1px solid #c0c5cd; color: #3474b5; font-size: 30px; letter-spacing: -0.06em;">
        Noisymap
    </div>
    <div style="padding: 16px 0 0; font-size: 20px;">Dear <?php echo $_smarty_tpl->getVariable('name')->value;?>
,</div>
    <div style="line-height: 20px;"><?php echo $_smarty_tpl->getVariable('message')->value;?>
</div>
    <div style="margin-top: 3em; padding: 10px 0 20px; border-top: 1px solid #c0c5cd; color: #808080; font-size: 11px; font-weight: bold;">
        <div>&copy; <?php echo date('Y');?>
 <a href="http://www.noisymap.com/" style="color: #000;">Noisymap</a>. All right
            Reserved
        </div>
        <div>This is a post-only mailing. Replies to this message are not monitored or answered.</div>
    </div>
</div>
