<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="/i/startup/startup.png" media="(device-width: 320px)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-640.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-768.png" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image">
<link href="/i/startup/startup-1024.png" media="(device-width: 768px) and (orientation: landscape)" rel="apple-touch-startup-image">
<link rel="shortcut icon" href="/i/favicon-16.png">
<link rel="icon" href="/i/favicon-16.png" type="image/png">
<link rel="icon" href="/i/favicon-32.png" sizes="32x32" type="image/png">
<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/emoji/emoji.css">
{include file='global/adapt.tpl'}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing,places"></script>
<script type="text/javascript" src="/js/lib/require.js"></script>
<script type="text/javascript">
    {literal}
    require.config({
        baseUrl: '/js',
        paths: {
            jquery: 'lib/jquery',
            jqueryui: 'lib/jqueryui',
            underscore: 'lib/underscore',
            backbone: 'lib/backbone'
        }
    });
    require(['jquery', 'main'], function ($) {
        if (('standalone' in window.navigator) && window.navigator.standalone) {
            $(document).on(
                    'click',
                    'a',
                    function (event) {
                        var $el = $(event.target);
                        if ($el.attr('href')) {
                            var c = $el.data("events");
                            if (!(c && c.click) && $el.attr('href').indexOf('http') < 0) {
                                location.href = $(event.target).attr('href');
                                event.preventDefault();
                            }
                        }
                    }
            );
        }
    });
    {/literal}
</script>

