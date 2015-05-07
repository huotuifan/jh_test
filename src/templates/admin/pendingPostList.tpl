<table class="nm-Pending-Post-container" xmlns="http://www.w3.org/1999/html">
    <thead>
        <tr>
            <th>Author</th>
            <th>Post title</th>
            <th>Post content</th>
            <th>Resources</th>
            <th>Place</th>
            <th>Tags</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    {foreach $posts as $post}
        {include file="admin/pendingPost.tpl"}
        {foreachelse}
        <div class="nm-Content-empty">{$DIC.global.empty}</div>
    {/foreach}
    </tbody>
</table>
<div class="nm-Pages-Links-container">
{include file="global/widget-pages-links.tpl"}
</div>
<script type="text/javascript">{literal}
    /*require(['global/player'], function (player) {
     player.init();
     });*/
{/literal}</script>
