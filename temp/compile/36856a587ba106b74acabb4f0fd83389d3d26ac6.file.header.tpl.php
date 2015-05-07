<?php /* Smarty version Smarty-3.0.8, created on 2015-03-27 00:21:42
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/global/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30809966555150506cb7d37-22699673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36856a587ba106b74acabb4f0fd83389d3d26ac6' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/global/header.tpl',
      1 => 1427436307,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30809966555150506cb7d37-22699673',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--- facebook integration begin --->
<script type="text/javascript">
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
                      statusChangeCallback(response);
                      });
}

window.fbAsyncInit = function() {
    FB.init({
            appId      : '1554005081515366',
            cookie     : true,  // enable cookies to allow the server to access
            // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.2' // use version 2.2
            });
    
    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.
    
    FB.getLoginStatus(function(response) {
                      statusChangeCallback(response);
                      });
    
};

// Load the SDK asynchronously
(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
           console.log('Successful login for: ' + response.name);
           document.getElementById('status').innerHTML =
           'Thanks for logging in, ' + response.name + '!';
           });
}


</script>

<!--- facebook integration end --->

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
                    <div id="LoginPopup" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['login'];?>
" style="display: none;">
                        <form id="LoginForm" style="margin: 0 auto; max-width: 360px;">
                            <table class="f-table f-max">
                                <colgroup>
                                    <col width="80"/>
                                </colgroup>
                                <tr valign="top">
                                    <td><label for="LoginEmail" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['email'];?>
</label></td>
                                    <td><input type="text" name="email" id="LoginEmail" class="f-input f-max"/></td>
                                </tr>
                                <tr>
                                    <td><label for="LoginPassword" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['password'];?>
</label></td>
                                    <td><input type="password" name="password" id="LoginPassword" class="f-input f-max"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="LoginRemember" class="f-label" style="text-align: left;">
                                        <input type="checkbox" checked="checked" name="remember" id="LoginRemember"/>
                                        <span class="f-label-check"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['remember'];?>
</span></label></td>
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
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="/accounts/forgot/"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['forgot'];?>
</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                        </fb:login-button>

                                        <div id="status">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="RegPopup" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['register'];?>
" style="display: none;">
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
                                    <td><label for="RegEmail" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['email'];?>
</label></td>
                                    <td>
                                        <div><input type="text" name="email" id="RegEmail" maxlength="320" class="f-input f-max"/></div>
                                        <div id="RegEmailMessage" class="f-message" style="display: none;"></div>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td><label for="RegPassword" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['password'];?>
</label></td>
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
                    </div>
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
