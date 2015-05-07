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
            <script>{literal}require(['jquery', 'common/utils'], function ($, utils) {
                $('.nm-Footer-lang').click(function (e) {
                    utils.changeLang($(this).data('lang'));
                    e.preventDefault();
                });
            });{/literal}</script>
        </div>
        <div class="nm-Footer-copy"><a href="/">{$DIC.global.title}</a> &copy; {'Y'|date}</div>
    </div>
</div>
