<div id="ForgotPassword" title="{$DIC.menu.forgotPassword}">
    <form id="ForgotPasswordForm" style="margin: 0 auto; max-width: 360px;">
        <table class="f-table f-max">
            <colgroup>
                <col width="80"/>
            </colgroup>
            <tr valign="top">
                <td><label for="ForgotEmail" class="f-label">{$DIC.login.email}</label></td>
                <td>
                    <div><input type="text" name="email" id="ForgotEmail" maxlength="320" class="f-input f-max"/></div>
                    <div id="ForgotEmailMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div style="padding: 8px 0;">
                        <input type="submit" value="{$DIC.forget.buttonSendMail}" id="ButtonForgotPassword" class="f-button"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">{literal}
    require([
        'jquery',
        'common/utils'
    ], function ($, utils) {
        $('#ButtonForgotPassword').click(function(e) {
            e.preventDefault();

            var data = {
                email: $('#ForgotEmail').val()
            };

            utils.simpleAction('common.forgot.send', data, function (result) {
                if (result.status == 'OK') {
                    window.location.reload();
                }
            });
        });
    });
    {/literal}</script>