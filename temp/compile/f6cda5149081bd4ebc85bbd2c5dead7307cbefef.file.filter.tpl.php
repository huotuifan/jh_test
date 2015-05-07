<?php /* Smarty version Smarty-3.0.8, created on 2015-04-30 21:40:07
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260074771554303a71515b6-47697958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6cda5149081bd4ebc85bbd2c5dead7307cbefef' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/filter.tpl',
      1 => 1430455153,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260074771554303a71515b6-47697958',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form id="filter_form">
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
  <input id="filter_button" type="submit" value="Apply Filter">
</form>
