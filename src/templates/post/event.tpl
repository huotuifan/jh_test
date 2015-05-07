<div class="nm-Event" xmlns="http://www.w3.org/1999/html">
    <div class="nm-Event-column">
        <div class="nm-Event-title"><a href="/posts/{$post.post_uuid}">{$post.post_event|date_format:"%d %b %Y, %A %H:%M"}</a></div>
        <div class="nm-Event-content">
            <div><b>{$post.post_title|escape}</b></div>
            <div>{$post.post_text|nl2br}</div>
        </div>
    </div>
    <div class="nm-Event-info">
        <ul>
            <li class="nm-Event-person"><a href="/users/{$post.user_uuid}">{$post.user_name|escape}</a></li>
            <li class="nm-Event-comments"><a href="/posts/{$post.post_uuid}#comments">{$post.comments_count} Comment</a></li>
        </ul>
    </div>
</div>
