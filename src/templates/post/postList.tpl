{foreach $posts as $post}
{include file="post/post.tpl"}
{foreachelse}
<div class="nm-Content-empty">{$DIC.global.empty}</div>
{/foreach}
<script type="text/javascript">{literal}
require(['jquery', 'global/player', 'common/utils'], function ($, player, utils) {
    player.init();

    $('.nm-Post-editButton').click(function () {
        var $form = $('#post-' + $(this).attr('data-post-uuid'));
        require(['global/post'], function (editor) {
            editor.editArray($form.serializeArray(), function () {

            });
        });
    });

    $('.nm-Post-deleteButton').click(function () {
        if (confirm('Are you sure you wish to delete this post?')) {
            var postHash = $(this).attr('data-post-uuid');
            utils.simpleAction('post.delete', {post_hash: postHash}, function (result) {
                if (result.result == 1) {
                    window.location.reload();
                }
            });
        }
    });
});
{/literal}</script>
