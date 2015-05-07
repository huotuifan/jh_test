<div style="padding: 0 10px;">
    <form id="PostForm">
        <textarea name="post" id="PostField" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <div class="left">
            <div id="PostMessage" class="f-message" style="display: none;"></div>
        </div>
        <div class="right">
            <input type="submit" value="Post" class="f-button" style="width: 70px;"/>
        </div>
        <div class="clear"></div>
    </form>
</div>
<script type="text/javascript">{literal}
require(['post/form']);
{/literal}</script>
