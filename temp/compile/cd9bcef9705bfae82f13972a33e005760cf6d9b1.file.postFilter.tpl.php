<?php /* Smarty version Smarty-3.0.8, created on 2015-01-21 00:53:21
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/post/postFilter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58582570754bef88151e8d2-32264264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd9bcef9705bfae82f13972a33e005760cf6d9b1' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/post/postFilter.tpl',
      1 => 1421801450,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58582570754bef88151e8d2-32264264',
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
