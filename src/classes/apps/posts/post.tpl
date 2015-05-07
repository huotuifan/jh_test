<!DOCTYPE html>
<html>
<head>
    <title>Noisymap</title>
{include file='global/scripts.tpl'}
</head>
<body class="nm-Page">
{include file='global/header.tpl'}
<div class="nm-Content">
    <div class="nm-Content-inner">
    {include file="post/post.tpl"}
        <script type="text/javascript">{literal}
            require(['global/player'], function (player) {
                player.init();
            });
        {/literal}</script>
    {if !empty($post.post_id)}
        {include file='post/commentList.tpl'}
        {if !empty($USER)}
            <div style="padding: 32px 0;">
            {include file='post/commentForm.tpl'}
            </div>
        {/if}
    {/if}
    </div>
</div>
{include file='global/footer.tpl'}
<script type="text/javascript">{literal}
    require(['jquery', 'common/utils'], function ($, utils) {
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
                        window.history.back();
                    }
                });
            }
        });
    });
{/literal}</script>
</body>
</html>