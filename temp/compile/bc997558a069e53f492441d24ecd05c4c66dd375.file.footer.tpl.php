<?php /* Smarty version Smarty-3.0.8, created on 2015-03-27 00:21:42
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/templates/global/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28640563855150506e25553-34740893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc997558a069e53f492441d24ecd05c4c66dd375' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/templates/global/footer.tpl',
      1 => 1427436308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28640563855150506e25553-34740893',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="nm-Push"></div>
</div>
<div class="nm-Footer">
    <div class="nm-Footer-inner">
        <div class="nm-Footer-menu">
            <ul>
                <li><a href="/" data-lang="en" class="nm-Footer-lang">English</a></li>
                <li><a href="/" data-lang="ru" class="nm-Footer-lang">Русский</a></li>
                <li><a href="http://www.facebook.com/noisymap">Facebook</a></li>
                <li><a href="http://www.twitter.com/noisymap">Twitter</a></li>
                <li>
                <span
                    class="fb-like"
                    data-share="true"
                    data-width="450"
                    data-show-faces="true">
                </span>
                </li>
            </ul>
            <script>require(['jquery', 'common/utils'], function ($, utils) {
                $('.nm-Footer-lang').click(function (e) {
                    utils.changeLang($(this).data('lang'));
                    e.preventDefault();
                });
            });</script>
        </div>
        <div class="nm-Footer-copy"><a href="/"><?php echo $_smarty_tpl->getVariable('DIC')->value['global']['title'];?>
</a> &copy; <?php echo date('Y');?>
</div>
    </div>
</div>
