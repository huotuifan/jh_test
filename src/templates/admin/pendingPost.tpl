<tr data-post-id="{$post.post_id}" class="nm-Pending-Post-row" xmlns="http://www.w3.org/1999/html">
    <td>{$post.user_name|escape}</td>
    <td>{$post.post_title|escape}</td>
    <td>{$post.post_text|nl2br}</td>
    <td>
    {foreach $post.resources as $resource}
        <div>
            <div class="nm-Post-resourceTitle"><a href="{$resource.resource_url}">{$resource.resource_title|escape}</a></div>
            <div class="nm-Post-resourceDescription">{$resource.resource_description|escape}</div>
        </div>
    {/foreach}
    </td>
    <td><a href="/places/{$post.place.place_uuid}">{$post.place.place_name|escape}</a></td>
    <td>
    {if !empty($post.post_tags)}
        <li class="nm-Post-tags">
            {assign var=tags value=","|explode:$post.post_tags}
            {foreach from=$tags item=tag name=tags}
                <a href="/tags/{$tag}">{$tag}</a>{if !$smarty.foreach.tags.last}, {/if}
            {/foreach}
        </li>
    {/if}
    </td>
    <td>
        <a class="button-accept-post" href="#"></a>
        <a class="button-decline-post" href="#"></a>
    </td>
</tr>
