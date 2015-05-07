<!DOCTYPE html>
<html>
<head>
    <title>Noisymap</title>
{include file='global/scripts.tpl'}
</head>
<body class="nm-Page">
{include file='global/header.tpl'}
<div class="nm-Content">
    <div class="nm-Content-inner" style="padding-top: 40px;">
        <h1 class="nm-User-title">{if !empty($USER) && $USER.user_id != $user.user_id}
                {if !empty($user.favorited)}
                    <div class="nm-Favorites-remove" data-user="{$user.user_id}">{$DIC.buttons.favoriteRemove}</div>
                {else}
                    <div class="nm-Favorites-add" data-user="{$user.user_id}">{$DIC.buttons.favoriteAdd}</div>
                {/if}
                <script>
                    require(['global/favorites']);
                </script>
            {/if}{$user.user_name}</h1>
        <div class="nm-User-right">
            {if !empty($user.user_about)}
                <div class="nm-User-about">
                    <h2>About</h2>
                    <div class="nm-User-aboutText">{$user.user_about|escape|nl2br}</div>
                </div>
            {/if}
        </div>
        <div class="nm-User-left">
            <div style="padding: 0 0 32px;">
            {include file='post/postList.tpl'}
            </div>
        </div>
    </div>

</div>
{include file='global/footer.tpl'}
</body>
</html>