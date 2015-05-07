<?php /* Smarty version Smarty-3.0.8, created on 2014-12-26 23:57:33
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/accounts/forgotPassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235538823549df5ed39bdb4-35775448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b253c07642bbfd94908743d3809f43f35a2411c' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/accounts/forgotPassword.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235538823549df5ed39bdb4-35775448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="ForgotPassword" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['forgotPassword'];?>
">
    <form id="ForgotPasswordForm" style="margin: 0 auto; max-width: 360px;">
        <table class="f-table f-max">
            <colgroup>
                <col width="80"/>
            </colgroup>
            <tr valign="top">
                <td><label for="ForgotEmail" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['login']['email'];?>
</label></td>
                <td>
                    <div><input type="text" name="email" id="ForgotEmail" maxlength="320" class="f-input f-max"/></div>
                    <div id="ForgotEmailMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div style="padding: 8px 0;">
                        <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['forget']['buttonSendMail'];?>
" id="ButtonForgotPassword" class="f-button"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
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
    </script>