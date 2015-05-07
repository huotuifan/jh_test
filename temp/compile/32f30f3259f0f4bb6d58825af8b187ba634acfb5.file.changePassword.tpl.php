<?php /* Smarty version Smarty-3.0.8, created on 2015-03-23 17:04:21
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/accounts/changePassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10806075005510aa05c684f5-22515282%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32f30f3259f0f4bb6d58825af8b187ba634acfb5' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/accounts/changePassword.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10806075005510aa05c684f5-22515282',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="ChangePassword" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['menu']['changePassword'];?>
">
    <form id="ChangePasswordForm" style="margin: 0 auto; max-width: 360px;">
        <table class="f-table f-max">
            <colgroup>
                <col width="80"/>
            </colgroup>
            <tr valign="top">
                <td><label for="ChangePasswordPassword" class="f-label"><?php echo $_smarty_tpl->getVariable('DIC')->value['settings']['password'];?>
</label></td>
                <td>
                    <div><input type="password" name="password" maxlength="32" id="ChangePasswordPassword" class="f-input f-max"/></div>
                    <div id="ChangePasswordMessage" class="f-message" style="display: none;"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div style="padding: 8px 0;">
                        <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['forget']['buttonReset'];?>
" id="ButtonChangePassword" class="f-button"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<input type="hidden" id="ChangePasswordId" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"/>
<input type="hidden" id="ChangePasswordCode" value="<?php echo $_smarty_tpl->getVariable('code')->value;?>
"/>
<script type="text/javascript">
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
    </script>