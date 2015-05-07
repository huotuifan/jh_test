<div id="ChangePassword" title="{$DIC.menu.changePassword}">
    <form id="ChangePasswordForm" style="margin: 0 auto; max-width: 360px;">
        <table class="f-table f-max">
            <colgroup>
                <col width="80"/>
            </colgroup>
            <tr valign="top">
                <td><label for="ChangePasswordPassword" class="f-label">{$DIC.settings.password}</label></td>
                <td>
                    <div><input type="password" name="password" maxlength="32" id="ChangePasswordPassword" class="f-input f-max"/></div>
                    <div id="ChangePasswordMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div style="padding: 8px 0;">
                        <input type="submit" value="{$DIC.forget.buttonReset}" id="ButtonChangePassword" class="f-button"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<input type="hidden" id="ChangePasswordId" value="{$id}"/>
<input type="hidden" id="ChangePasswordCode" value="{$code}"/>
<script type="text/javascript">{literal}
    require([
        'jquery',
        'common/utils'
    ], function ($, utils) {
        $('#ButtonChangePassword').click(function(e) {
            e.preventDefault();

            var data = {
                password: $('#ChangePasswordPassword').val(),
                id: $('#ChangePasswordId').val(),
                forgot_code: $('#ChangePasswordCode').val()
            };

            utils.simpleAction('common.forgot.change', data, function (result) {
                if (result.status == 'OK') {
                    window.location.reload();
                }
            });
        });
    });
    {/literal}</script>