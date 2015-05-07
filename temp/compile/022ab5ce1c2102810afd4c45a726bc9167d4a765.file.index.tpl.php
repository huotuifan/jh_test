<?php /* Smarty version Smarty-3.0.8, created on 2015-05-02 02:00:15
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/classes/apps/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:527300995544921f63eb23-16832938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '022ab5ce1c2102810afd4c45a726bc9167d4a765' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/classes/apps/index/index.tpl',
      1 => 1430557046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '527300995544921f63eb23-16832938',
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
$_template->assign('search',true); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script type="text/javascript">
require([
    'jquery',
    'widgets/maps/maps',
    'common/utils',
    'global/search',
    'jqueryui/draggable'
], function ($, maps, utils, search) {
            
        
        
   });
</script>
</body>
</html>