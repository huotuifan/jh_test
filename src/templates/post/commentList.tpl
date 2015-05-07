<div class="nm-Comment-title" id="comments">Comments</div>
{foreach $comments as $comment}
    {if $comment.user_id == $post.user_id}
        {$commentStyle = 'nm-Comment nm-Comment-author'}
        {else}
        {$commentStyle = 'nm-Comment'}
    {/if}
<div id="{$comment.comment_id}" class="{$commentStyle}">
    {if $USER.user_level == 1}
    <div class="nm-Comment-adminButtons">
        <span class="nm-Comment-editButton" data-post-uuid="{$post.post_uuid}" data-comment-id="{$comment.comment_id}">Edit</span>
        <span class="nm-Comment-deleteButton" data-post-uuid="{$post.post_uuid}" data-comment-id="{$comment.comment_id}">Delete</span>
    </div>
    {/if}
    <div class="nm-Comment-content">{$comment.comment_text|nl2br}</div>
    {if $USER.user_level == 1}
        {include file='post/commentFormEdit.tpl'}
    {/if}
    <div class="nm-Comment-info"><a href="/posts/{$post.post_uuid}#{$comment.comment_uuid}">{$comment.comment_time}</a>
        - <a href="/users/{$comment.user_uuid}">{$comment.user_name|escape}</a></div>
</div>
{/foreach}
<script type="text/javascript">{literal}
    require(['widgets/post/form', 'common/utils'], function (form, utils) {
        $.each($('.CommentFormEdit'), function() {
            var commentId = $(this).attr('data-comment-id');

            form.init({
                form: 'CommentForm-' + commentId,
                text: 'CommentField-' + commentId,
                action: 'post.comment',
                resize: true
            });
        });

        $('.nm-Comment-editButton').click(function() {
            $('.CommentFormEdit').parent().hide();
            $('.nm-Comment-content').show();

            var commentId = $(this).attr('data-comment-id');
            var $commentContent = $('#' + commentId + ' .nm-Comment-content').hide();
            $('#CommentField-' + commentId).val($commentContent.text());
            $('#CommentForm-' + commentId).parent().show();
        });

        $('.nm-Comment-cancelEdit').click(function() {
            var commentId = $(this).parents('form').attr('data-comment-id');
            $('#CommentField-' + commentId).val('');
            $('#CommentForm-' + commentId).parent().hide();
            $('#' + commentId + ' .nm-Comment-content').show();
        });

        $('.nm-Comment-deleteButton').click(function() {
            if (confirm('Are you sure you wish to delete this comment?')) {
                var commentId = $(this).attr('data-comment-id');

                var data = {
                    comment_id: commentId,
                    doDelete: 1
                };
                utils.simpleAction('post.comment', data, function (result) {
                    if (result.result == 1) {
                        window.location.reload();
                    }
                });
            }
        });
    });
{/literal}</script>
