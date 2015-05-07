{foreach $posts as $post}
    <div>
        <div style="padding: 10px 0 2px;">{$post.post_text|escape|nl2br}</div>
        <div style="font-size: 11px; color: #999;">{$post.post_time} - {$post.user_name|escape}</div>
    </div>
{/foreach}
