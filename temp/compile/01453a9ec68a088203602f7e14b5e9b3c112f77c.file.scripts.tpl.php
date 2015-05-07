<?php /* Smarty version Smarty-3.0.8, created on 2015-04-30 14:53:18
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/templates/global/scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6823541315542a44e922643-17388659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01453a9ec68a088203602f7e14b5e9b3c112f77c' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/templates/global/scripts.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6823541315542a44e922643-17388659',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="/i/startup/startup.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-640.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-768.png" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-1024.png" media="(device-width: 768px) and (orientation: landscape)" rel="apple-touch-startup-image">
<link rel="shortcut icon" href="/i/favicon-16.png">
<link rel="icon" href="/i/favicon-16.png" type="image/png">
<link rel="icon" href="/i/favicon-32.png" sizes="32x32" type="image/png">
<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/emoji/emoji.css">
<?php $_template = new Smarty_Internal_Template('global/adapt.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing,places"></script>
<script type="text/javascript" src="/js/lib/require.js"></script>
<script type="text/javascript">
    
    require.config({
        baseUrl: '/js',
        paths: {
            jquery: 'lib/jquery',
            jqueryui: 'lib/jqueryui',
            underscore: 'lib/underscore',
            backbone: 'lib/backbone'
        }
    });
    require(['jquery', 'main'], function ($) {
        if (('standalone' in window.navigator) && window.navigator.standalone) {
            $(document).on(
                    'click',
                    'a',
                    function (event) {
                        var $el = $(event.target);
                        if ($el.attr('href')) {
                            var c = $el.data("events");
                            if (!(c && c.click) && $el.attr('href').indexOf('http') < 0) {
                                location.href = $(event.target).attr('href');
                                event.preventDefault();
                            }
                        }
                    }
            );
        }
    });
    
</script>

