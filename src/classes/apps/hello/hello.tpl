<!DOCTYPE html>
<html>
<head>
    <title>{$DIC.global.title}</title>
    {include file='global/scripts.tpl'}
</head>
<body class="nm-Page">
{include file='global/header.tpl' noauth=true}
<div class="nm-Content">
    <div class="nm-Content-inner">
    {include file='admin/pendingPostList.tpl'}
    </div>
</div>
<script type="text/javascript">{literal}
    require([
        'jquery',
        'common/utils'
    ], function ($, utils) {
        $('.button-accept-post').click(function(e) {
            e.preventDefault();

            var data = {
                id: $(this).parents('.nm-Pending-Post-row').attr('data-post-id'),
                pending: 0
            };

            updatePost(data);
        });

        $('.button-decline-post').click(function(e) {
            e.preventDefault();

            var data = {
                id: $(this).parents('.nm-Pending-Post-row').attr('data-post-id'),
                pending: 1
            };

            updatePost(data);
        });

        function updatePost(data) {
            utils.simpleAction('post.update', data, function (result) {
                if (result.status == 'OK') {
                    $('.nm-Pending-Post-row[data-post-id="' +data.id + '"]').remove();
                    window.location.reload();
                }
            });
        }
    });
{/literal}</script>
{include file='global/footer.tpl'}
</body>
</html>