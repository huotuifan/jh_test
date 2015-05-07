{if !empty($USER)}
<div>
    <span>{$USER.user_name}</span>
    <span> | </span>
    <a href="#" id="LinkLogout" class="nm-link">{$DIC.menu.logout}</a>
</div>
    {else}
<div>
    <a href="#LoginEmail" id="LinkLogin" class="nm-link">{$DIC.menu.login}</a>
    <span> | </span>
    <a href="#RegEmail" id="LinkRegister" class="nm-link">{$DIC.menu.register}</a>
</div>
<div id="LoginPopup" title="Login" style="display: none;">
    <form id="LoginForm" style="margin: 0 auto; width: 300px;">
        <div style="height: 30px;">
            <div id="LoginMessage" class="f-message" style="display: none;"></div>
        </div>
        <table class="f-table">
            <colgroup>
                <col width="100"/>
            </colgroup>
            <tr valign="top">
                <td><label for="LoginEmail" class="f-label">{$DIC.login.email}</label></td>
                <td><input type="text" name="user_id" id="LoginEmail" class="f-input" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td><label for="LoginPassword" class="f-label">{$DIC.login.password}</label></td>
                <td><input type="password" name="session_key" id="LoginPassword" class="f-input" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td><label for="LoginRemember" class="f-label" style="text-align: left;">
                    <input type="checkbox" checked="checked" name="remember" id="LoginRemember"/>
                    <span class="f-label-check">{$DIC.login.remember}</span></label></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div style="padding: 8px 0;">
                        <input type="submit" value="{$DIC.login.buttonLogin}" id="LoginButton" class="f-button"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="/accounts/forgot/">{$DIC.login.forgot}</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="RegPopup" title="Registration" style="display: none;">
    <form id="RegForm" style="margin: 0 auto; width: 300px; padding-top: 8px;">
        <table class="f-table">
            <colgroup>
                <col width="80"/>
                <col width="220"/>
            </colgroup>
            <tr valign="top">
                <td><label for="RegName" class="f-label">{$DIC.login.name}</label></td>
                <td>
                    <div><input type="text" name="name" id="RegName" maxlength="64" class="f-input" style="width: 220px;"/></div>
                    <div id="RegNameMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr valign="top">
                <td><label for="RegEmail" class="f-label">{$DIC.login.email}</label></td>
                <td>
                    <div><input type="text" name="email" id="RegEmail" maxlength="320" class="f-input" style="width: 220px;"/></div>
                    <div id="RegEmailMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr valign="top">
                <td><label for="RegPassword" class="f-label">{$DIC.login.password}</label></td>
                <td>
                    <div><input type="password" name="password" maxlength="32" id="RegPassword" class="f-input" style="width: 220px;"/></div>
                    <div id="RegPasswordMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td><label for="RegSubscribe" class="f-label" style="text-align: left;">
                    <input type="checkbox" checked="checked" name="subscribe" id="RegSubscribe"/>
                    <span class="f-label-check">{$DIC.login.subscribe}</span></label></td>
            </tr>
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
</div>
{/if}
<script type="text/javascript">{literal}
require(['global/login']);
{/literal}</script>
