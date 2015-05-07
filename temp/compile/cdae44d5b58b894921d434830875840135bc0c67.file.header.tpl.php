<?php /* Smarty version Smarty-3.0.8, created on 2015-05-06 16:19:00
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/templates/global/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1608829921554aa164070630-26072990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdae44d5b58b894921d434830875840135bc0c67' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/templates/global/header.tpl',
      1 => 1430558315,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1608829921554aa164070630-26072990',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="nm-Wrapper">
<span id="ErrorMessage" class="f-message" style="display: none;"></span>
<span id="Loading" class="f-loading" style="display: none;"></span>
<div class="nm-Head">
    <div class="nm-Head-inner">
        <div class="nm-Head-logo"><a href="/"><span>Noisymap.com</span></a></div>
        <?php if ($_smarty_tpl->getVariable('search')->value==1){?>
            <div class="nm-Search">
                <div class="nm-Search-inner"><input type="text" class="nm-Search-input" placeholder="<?php echo $_smarty_tpl->getVariable('DIC')->value['global']['location'];?>
"></div>
            </div>
        <?php }?>

        <div class="nm-Links-container">
            <?php if (!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)){?>
                <div class="nm-Links-extra">
                    <div class="nm-Links-post" id="LinkAddPost">
                        <i></i>
                        <span><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['addPost'];?>
</span>
                    </div>
                    <div class="nm-Links-logout" id="LinkLogout">
                        <i></i>
                        <span><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['logout'];?>
</span>
                    </div>
                    <div class="nm-Links-settings" id="LinkSettings">
                        <i></i>
                        <span><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['settings'];?>
</span>
                    </div>
                </div>
                <div class="nm-Links-user">
                    <span><?php echo $_smarty_tpl->getVariable('DIC')->value['global']['hi'];?>
, <a href="/users/<?php echo $_smarty_tpl->getVariable('USER')->value['user_uuid'];?>
"><?php echo $_smarty_tpl->getVariable('USER')->value['user_name'];?>
</a>!</span>
                </div>
                <div id="AddPost" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['addPost'];?>
" style="display: none;">
                    <?php $_template = new Smarty_Internal_Template("post/postForm.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                </div>
                <div id="SettingsPopup" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['settings'];?>
" style="display: none;">
                    <form id="SettingsForm" style="margin: 0 auto; max-width: 360px;">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('USER')->value['user_id'];?>
"/>
                        <table class="f-table f-max">
                            <colgroup>
                                <col width="110"/>
                            </colgroup>
                            <tr valign="top">
                                <td><label for="SettingsName" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['settings']['name'];?>
</label></td>
                                <td>
                                    <div><input type="text" name="name" id="SettingsName" maxlength="64" class="f-input f-max" value="<?php echo $_smarty_tpl->getVariable('USER')->value['user_name'];?>
"/></div>
                                    <div id="SettingsNameMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsEmail" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['settings']['email'];?>
</label></td>
                                <td>
                                    <div><input type="text" name="email" id="SettingsEmail" maxlength="320" class="f-input f-max" value="<?php echo $_smarty_tpl->getVariable('USER')->value['user_email'];?>
"/></div>
                                    <div id="SettingsEmailMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsPassword" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['settings']['password'];?>
</label></td>
                                <td>
                                    <div><input type="password" name="password" maxlength="32" id="SettingsPassword" class="f-input f-max"/></div>
                                    <div id="SettingsPasswordMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsAbout" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['settings']['about'];?>
</label></td>
                                <td>
                                    <div><textarea name="about" id="SettingsAbout" cols="30" rows="10" style="width: 100%; height: 80px;"><?php echo $_smarty_tpl->getVariable('USER')->value['user_about'];?>
</textarea></div>
                                    <div id="SettingsAboutMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="padding: 8px 0;">
                                        <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['save'];?>
" id="ButtonSettingsSave" class="f-button f-button-submit"/>
                                        <input type="button" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['cancel'];?>
" id="ButtonSettingsCancel" class="f-button"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <script type="text/javascript">
                    require([
                        'common/utils',
                        'jquery',
                        'global/post',
                        'global/settings'
                    ], function (utils, $) {
                        $('#LinkLogout').click(function (e) {
                            utils.simpleAction('common.logout', {}, function () {
                                window.location.reload();
                            });
                            e.preventDefault();
                        });
                    });
                </script>
            <?php }else{ ?>
                <?php if (!$_smarty_tpl->getVariable('noauth')->value){?>
                    <div class="nm-Links-login">
                        <div class="nm-Link"><span id="LinkLogin"><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['login'];?>
</span></div>
                        <div class="nm-Link"><span id="LinkRegister"><?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['register'];?>
</span></div>
                    </div>
              
                        <form id="LoginForm" style="margin: 0 auto; max-width: 360px;">
                            <table class="f-table f-max">
                                <colgroup>
                                    <col width="80"/>
                                </colgroup>
                                <tr valign="top">
                                    <td><label for="LoginEmail" class="f-label">user_id</label></td>
                                    <td><input type="text" name="user_uid" id="LoginEmail" class="f-input f-max"/></td>
                                </tr>
                                <tr>
                                    <td><label for="LoginPassword" class="f-label">user_session_key</label></td>
                                    <td><input type="password" name="session_key" id="LoginPassword" class="f-input f-max"/></td>
                                </tr>
                            
                                <tr>
                                    <td></td>
                                    <td>
                                        <div style="padding: 8px 0;">
                                            <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['login']['buttonLogin'];?>
" id="LoginButton" class="f-button"/>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    
                    
                        <form id="RegForm" style="margin: 0 auto; max-width: 360px;">
                            <table class="f-table f-max">
                                <colgroup>
                                    <col width="80"/>
                                </colgroup>
                                <tr valign="top">
                                    <td><label for="RegName" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['name'];?>
</label></td>
                                    <td>
                                        <div><input type="text" name="name" id="RegName" maxlength="64" class="f-input f-max"/></div>
                                        <div id="RegNameMessage" class="f-message" style="display: none;"></div>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td><label for="RegEmail" class="f-label">email</label></td>
                                    <td>
                                        <div><input type="text" name="email" id="RegEmail" maxlength="320" class="f-input f-max"/></div>
                                        <div id="RegEmailMessage" class="f-message" style="display: none;"></div>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td><label for="RegPassword" class="f-label">password</label></td>
                                    <td>
                                        <div><input type="password" name="password" maxlength="32" id="RegPassword" class="f-input f-max"/></div>
                                        <div id="RegPasswordMessage" class="f-message" style="display: none;"></div>
                                    </td>
                                </tr>
                                <!-- tr valign="top">
                                    <td></td>
                                    <td><label for="RegSubscribe" class="f-label" style="text-align: left;">
                                        <input type="checkbox" checked="checked" name="subscribe" id="RegSubscribe"/>
                                        <span class="f-label-check"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['subscribe'];?>
</span></label></td>
                                </tr -->
                                <tr>
                                    <td></td>
                                    <td>
                                        <div style="padding: 8px 0;">
                                            <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['login']['buttonRegister'];?>
" id="ButtonRegister" class="f-button"/>
                                        </div>

                                    </td>

                                </tr>
                            </table>
                        </form>
                    
	            <form id="LogOutForm" style="margin: 0 auto; max-width: 360px;">
                            <table class="f-table f-max">
                                <colgroup>
                                    <col width="80"/>
                                </colgroup>
                                <tr valign="top">
                                    <td><label for="LoginEmail" class="f-label">user_id</label></td>
                                    <td><input type="text" name="user_id" id="LogoutEmail" class="f-input f-max"/></td>
                                </tr>
                                <tr>
                                    <td><label for="LoginPassword" class="f-label">session_key</label></td>
                                    <td><input type="password" name="session_key" id="LogoutPassword" class="f-input f-max"/></td>
                                </tr>
                            
                                <tr>
                                    <td></td>
                                    <td>
                                        <div style="padding: 8px 0;">
                                            <input type="submit" value="log out" id="LogOutButton" class="f-button"/>
                                        </div>
                                    </td>
                                </tr>
                    
                            </table>
                        </form>

                    <script type="text/javascript">
                        require(['global/login']);
                    </script>
                <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<script type="text/javascript">
    require(['jquery'], function ($) {
        $('#LinkAddPost').click(function () {
            require(['global/post'], function (editor) {
                editor.editArray([], function () {

                });
            });
        });
    });
</script>
