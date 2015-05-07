<?php /* Smarty version Smarty-3.0.8, created on 2015-04-30 15:02:57
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/postFilter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13672440935542a691f113b7-39800763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0823661af3039f56bd12790511a119c3773f85a' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/postFilter.tpl',
      1 => 1421801450,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13672440935542a691f113b7-39800763',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
  <input type="checkbox" name="dinning" value="experience,story,cuisine"> dinning<br>
  <span style="padding-left:25px"> <input type="checkbox" name="experience" value="critic,user"> experience </span> <br>
  <span style="padding-left:50px"> <input type="checkbox" name="critic" value="null"> critics </span> <br>
  <span style="padding-left:50px"> <input type="checkbox" name="user" value="null"> users </span> <br>
  <span style="padding-left:25px"> <input type="checkbox" name="story" value="null"> story </span> <br>
  <span style="padding-left:25px"> <input type="checkbox" name="cuisine" value="Asian"> cuisine </span> <br>
  <span style="padding-left:50px"> <input type="checkbox" name="Asian" value="Korean,Japanese,Chinese"> Asian </span> <br>
  <span style="padding-left:75px"> <input type="checkbox" name="Korean" value="null"> Korean </span> <br>
  <span style="padding-left:75px"> <input type="checkbox" name="Japanese" value="null"> Japanese </span> <br>
  <span style="padding-left:75px"> <input type="checkbox" name="Chinese" value="null"> Chinese </span> <br>
  <input id="post_filter_button" type="submit" value="Add Search Filter">
