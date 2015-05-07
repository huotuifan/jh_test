<div class="nm-Wrapper">
<span id="ErrorMessage" class="f-message" style="display: none;"></span>
<span id="Loading" class="f-loading" style="display: none;"></span>
<div class="nm-Head">
    <div class="nm-Head-inner">
        <div class="nm-Head-logo"><a href="/"><span>Noisymap.com</span></a></div>
        {if $search==1}
            <div class="nm-Search">
                <div class="nm-Search-inner"><input type="text" class="nm-Search-input" placeholder="{$DIC.global.location}"></div>
            </div>
        {/if}

        <div class="nm-Links-container">
            {if !empty($USER)}
                <div class="nm-Links-extra">
                    <div class="nm-Links-post" id="LinkAddPost">
                        <i></i>
                        <span>{$DIC.menu.addPost}</span>
                    </div>
                    <div class="nm-Links-logout" id="LinkLogout">
                        <i></i>
                        <span>{$DIC.menu.logout}</span>
                    </div>
                    <div class="nm-Links-settings" id="LinkSettings">
                        <i></i>
                        <span>{$DIC.menu.settings}</span>
                    </div>
                </div>
                <div class="nm-Links-user">
                    <span>{$DIC.global.hi}, <a href="/users/{$USER.user_uuid}">{$USER.user_name}</a>!</span>
                </div>
                <div id="AddPost" title="{$DIC.menu.addPost}" style="display: none;">
                    {include file="post/postForm.tpl"}
                </div>
                <div id="SettingsPopup" title="{$DIC.menu.settings}" style="display: none;">
                    <form id="SettingsForm" style="margin: 0 auto; max-width: 360px;">
                        <input type="hidden" name="id" value="{$USER.user_id}"/>
                        <table class="f-table f-max">
                            <colgroup>
                                <col width="110"/>
                            </colgroup>
                            <tr valign="top">
                                <td><label for="SettingsName" class="f-label">{$DIC.settings.name}</label></td>
                                <td>
                                    <div><input type="text" name="name" id="SettingsName" maxlength="64" class="f-input f-max" value="{$USER.user_name}"/></div>
                                    <div id="SettingsNameMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsEmail" class="f-label">{$DIC.settings.email}</label></td>
                                <td>
                                    <div><input type="text" name="email" id="SettingsEmail" maxlength="320" class="f-input f-max" value="{$USER.user_email}"/></div>
                                    <div id="SettingsEmailMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsPassword" class="f-label">{$DIC.settings.password}</label></td>
                                <td>
                                    <div><input type="password" name="password" maxlength="32" id="SettingsPassword" class="f-input f-max"/></div>
                                    <div id="SettingsPasswordMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td><label for="SettingsAbout" class="f-label">{$DIC.settings.about}</label></td>
                                <td>
                                    <div><textarea name="about" id="SettingsAbout" cols="30" rows="10" style="width: 100%; height: 80px;">{$USER.user_about}</textarea></div>
                                    <div id="SettingsAboutMessage" class="f-message" style="display: none;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="padding: 8px 0;">
                                        <input type="submit" value="{$DIC.buttons.save}" id="ButtonSettingsSave" class="f-button f-button-submit"/>
                                        <input type="button" value="{$DIC.buttons.cancel}" id="ButtonSettingsCancel" class="f-button"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <script type="text/javascript">{literal}
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
                {/literal}</script>
            {else}
                {if !$noauth}
                    <div class="nm-Links-login">
                        <div class="nm-Link"><span id="LinkLogin">{$DIC.menu.login}</span></div>
                        <div class="nm-Link"><span id="LinkRegister">{$DIC.menu.register}</span></div>
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
                                            <input type="submit" value="{$DIC.login.buttonLogin}" id="LoginButton" class="f-button"/>
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
                                    <td><label for="RegName" class="f-label">{$DIC.login.name}</label></td>
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
                                        <span class="f-label-check">{$DIC.login.subscribe}</span></label></td>
                                </tr -->
                                <tr>
                                    <td></td>
                                    <td>
                                        <div style="padding: 8px 0;">
                                            <input type="submit" value="{$DIC.login.buttonRegister}" id="ButtonRegister" class="f-button"/>
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

                    <script type="text/javascript">{literal}
                        require(['global/login']);
                    {/literal}</script>
                {/if}
            {/if}
        </div>
    </div>
</div>
<script type="text/javascript">{literal}
    require(['jquery'], function ($) {
        $('#LinkAddPost').click(function () {
            require(['global/post'], function (editor) {
                editor.editArray([], function () {

                });
            });
        });
    });
{/literal}</script>
