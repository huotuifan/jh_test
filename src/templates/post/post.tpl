{if !empty($post.post_id)}
{assign var=is_editable value=!empty($USER) && $USER.user_level == 1}
{assign var=encoded_resources value=json_encode($post.resources)}
{assign var=encoded_place value=json_encode($post.place)}
<div class="nm-Post" xmlns="http://www.w3.org/1999/html">
    <div class="nm-Post-column">
        <div class="nm-Post-title">
            <a href="/posts/{$post.post_uuid}">{$post.post_title|escape}</a>
            {if $is_editable}
                <span class="nm-Post-editButton" data-post-uuid="{$post.post_uuid}">Edit</span>
                <span class="nm-Post-deleteButton" data-post-uuid="{$post.post_uuid}">Delete</span>
                <form id="post-{$post.post_uuid}">
                    <input type="hidden" name="post_id" value="{$post.post_id}"/>
                    <input type="hidden" name="post_title" value="{$post.post_title}"/>
                    <input type="hidden" name="post_text" value="{$post.post_text|escape}"/>
                    <input type="hidden" name="post_place" value="{$post.place.place_id}"/>
                    <input type="hidden" name="post_event" value="{$post.post_event}"/>
                    <input type="hidden" name="post_place_data" value="{$encoded_place|escape}"/>
                    <input type="hidden" name="post_resources" value="{$encoded_resources|escape}"/>
                </form>
            {/if}
        </div>
        <div class="nm-Post-content">{$post.post_text|nl2br}</div>
        {foreach $post.resources as $resource}
            <div class="nm-Post-resource" data-audio="{$resource.resource_audio}" data-video="{$resource.resource_video}" data-video-width="{$resource.resource_video_width}" data-video-height="{$resource.resource_video_height}">
                {if $resource.resource_image}
                    {if empty($resource.resource_video) && empty($resource.resource_audio)}
                        <div class="nm-Post-resourceImage"><a href="{$resource.resource_url}"><img src="/resources/{$resource.resource_folder}/{$resource.resource_uuid}.jpg" alt="" width="130"></a></div>
                    {else}
                        <div class="nm-Post-resourceImage"><img src="/resources/{$resource.resource_folder}/{$resource.resource_uuid}.jpg" alt="" width="130"></div>
                    {/if}
                    <div class="nm-Post-resourceColumn">
                        <div class="nm-Post-resourceTitle"><a href="{$resource.resource_url}">{$resource.resource_title|escape}</a></div>
                        <div class="nm-Post-resourceDescription">{$resource.resource_description|escape}</div>
                    </div>
                {else}
                    <div class="nm-Post-resourceTitle"><a href="{$resource.resource_url}">{$resource.resource_title|escape}</a></div>
                    <div class="nm-Post-resourceDescription">{$resource.resource_description|escape}</div>
                {/if}
            </div>
        {/foreach}
    </div>
    <div class="nm-Post-info">
        <ul>
            {if !empty($post.post_tags)}
                <li class="nm-Post-tags">
                    {assign var=tags value=","|explode:$post.post_tags}
                    {foreach from=$tags item=tag name=tags}
                        <a href="/tags/{$tag}">{$tag}</a>{if !$smarty.foreach.tags.last}, {/if}
                    {/foreach}
                </li>
            {/if}
            {if !empty($post['place'])}<li class="nm-Post-location"><a href="/places/{$post.place.place_uuid}">{$post.place.place_name|escape}</a></li>{/if}
            <li class="nm-Post-person"><a href="/users/{$post.user_uuid}">{$post.user_name|escape}</a></li>
            <li class="nm-Post-comments"><a href="/posts/{$post.post_uuid}#comments">{$post.comments_count} Comment</a></li>
	    
	    <li>
		<img id="upvote_{$post.post_id}" src="/i/decor/post-upvote.png" alt="Upvote" style="width:17px;height:17px;position:relative;left:-17px">
		<img id= "downvote_{$post.post_id}" src="/i/decor/post-downvote.png" alt="Downvote" style="width:17px;height:17px;position:relative;left:-17px">
		<span id="recommend_{$post.post_id}" style="color:#4a95c2;position:relative;left:-13px"> {$post.post_recommend} Recommend<span>
	    </li>
	    
        </ul>
    </div>
</div>
{else}
    <div class="nm-Message-container">
        <p>{$DIC.post.pending}</p>
        <a href="/">{$DIC.menu.home}</a>
    </div>

{/if}
<!--- functions related to recommend --->
<script type="text/javascript">
require([
    'jquery','common/utils'
], function ($, utils) {
 
    $('#upvote_{$post.post_id}').click(function (e) {
        reload({$post.post_id}, 'upvote');
        e.preventDefault();
    });
    
    $('#downvote_{$post.post_id}').click(function (e) {
        reload({$post.post_id}, 'downvote');
        e.preventDefault();
    });

     
    function reload(post_id, rec) {
        utils.simpleAction('post.postRec', {
            post_id: post_id,
            rec: rec
            }, function (data) {
                if(data.count != null)
                {
                    $('#ErrorMessage').hide();
                    $('#recommend_{$post.post_id}').text(data.count + " Recommend");
                }
            });
    }
     
  


});
</script>



<!--- ends here --->
