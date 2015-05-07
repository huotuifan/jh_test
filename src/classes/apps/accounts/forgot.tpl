<!DOCTYPE html>
<html>
<head>
    <title>{$DIC.global.title}</title>
    {include file='global/scripts.tpl'}
</head>
<body class="nm-Page">
{include file='global/header.tpl' noauth=true}
<div class="nm-Content">
    <div class="nm-Content-inner">
        {if $show_change}
            {include file='accounts/changePassword.tpl'}
        {else}
            {include file='accounts/forgotPassword.tpl'}
        {/if}
    </div>
</div>
{include file='global/footer.tpl'}
</body>
</html>