<div style="padding: 0 10px;">
    <form id="CommentForm">
        <div style="padding-bottom: 10px;">
            <textarea name="comment" id="CommentField" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        </div>

        <div>
            <input type="hidden" name="post" value="{$post.post_uuid}">
            <input type="submit" value="Comment" class="f-button" style="width: 100px;"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
<script type="text/javascript">{literal}
require(['widgets/post/form'], function (form) {
    form.init({
        form: 'CommentForm',
        text: 'CommentField',
        action: 'post.comment',
        resize: true
    });
});
{/literal}</script>
