<div style="padding: 0 32px; display: none;">
    <form id="CommentForm-{$comment.comment_id}" class="CommentFormEdit" data-comment-id="{$comment.comment_id}">
        <div style="padding-bottom: 10px;">
            <textarea name="comment" id="CommentField-{$comment.comment_id}" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        </div>
        <div>
            <input type="hidden" name="post" value="{$post.post_uuid}">
            <input type="hidden" name="comment_id" value="{$comment.comment_id}">
            <input type="submit" value="Save" class="f-button" style="width: 100px;"/>
            <input type="button" value="Cancel" class="f-button nm-Comment-cancelEdit" style="width: 100px;"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
