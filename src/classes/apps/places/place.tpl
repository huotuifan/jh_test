<!DOCTYPE html>
<html>
<head>
    <title>Noisymap</title>
{include file='global/scripts.tpl'}
</head>
<body class="nm-Page">
{include file='global/header.tpl'}
<input type="hidden" id="PlaceLat" value="{$place.place_lat}">
<input type="hidden" id="PlaceLng" value="{$place.place_lng}">
<input type="hidden" id="PlaceFfmId" value="{$place.place_ffm_id}">
<input type="hidden" id="PlacePostType" value="{$place.postType}">

<div class="nm-Place-map">
    <div class="nm-Map-line"></div>
    <div id="PlaceMap" style="background: #fafafa; height: 80px;"></div>
    <div class="nm-Map-bottomLine"></div>
</div>
<script type="text/javascript">{literal}
require(['widgets/maps/maps'], function (maps) {
    var lat = $('#PlaceLat').val();
    var lng = $('#PlaceLng').val();
    var ffmId = $('#PlaceFfmId').val();
    var type = $('#PlacePostType').val();
    var map = maps.init($('#PlaceMap'), {
        zoom: 15,
        center: new google.maps.LatLng(lat, lng),
        mapTypeControl: false,
        readonly: true
    });

    if (ffmId != '' && ffmId != 0) {
        type = 'ffm';
    }

    map.setMarker(lat, lng, type);
});
{/literal}</script>
<div class="nm-Content">
    <div class="nm-Content-inner">
        <div class="nm-Place-right">
            {assign var=is_editable value=(!empty($USER) && $place.user_id == $USER.user_id) || $USER.user_level == 1}
            {assign var=has_about value=!empty($place.place_about)}
            {assign var=has_events value=!empty($events)}

            {if $is_editable || $has_about || $has_events}
                <div class="nm-Place-about">
                    {if $has_about || $is_editable}
                        <h2>{if $is_editable}
                            <span class="nm-Place-editButton">Edit</span>
                            <span class="nm-Place-deleteButton" data-place-id="{$place.place_id}">Delete</span>
                            <form id="CurrentPlace">
                                <input type="hidden" name="place_id" value="{$place.place_id}"/>
                                <input type="hidden" name="place_name" value="{$place.place_name|escape}"/>
                                <input type="hidden" name="place_about" value="{$place.place_about|escape}"/>
                                <input type="hidden" name="place_lat" value="{$place.place_lat}"/>
                                <input type="hidden" name="place_lng" value="{$place.place_lng}"/>
                            </form>
                            <script>{literal}
                                require(['jquery', 'common/utils'], function($, utils) {
                                    $('.nm-Place-editButton').click(function () {
                                        require(['widgets/maps/editor'], function (editor) {
                                            editor.editArray($('#CurrentPlace').serializeArray(), function () {
                                                window.location.reload();
                                            });
                                        });
                                    });

                                    $('.nm-Place-deleteButton').click(function () {
                                        if (confirm('Are you sure you wish to delete this place?')) {
                                            var placeId = $(this).attr('data-place-id');
                                            utils.simpleAction('place.delete', {place_id: placeId}, function (result) {
                                                if (result.result == 1) {
                                                    window.history.back();
                                                }
                                            });
                                        }
                                    });
                                });
                            {/literal}</script>
                            {/if}</h2>
                        <div class="nm-Place-aboutMap" style="background: #fafafa; height: 284px; width: 284px;"></div>
                        <script type="text/javascript">{literal}
                            require(['widgets/maps/maps'], function (maps) {
                                var lat = $('#PlaceLat').val();
                                var lng = $('#PlaceLng').val();
                                var ffmId = $('#PlaceFfmId').val();
                                var type = $('#PlacePostType').val();
                                var map = maps.init($('.nm-Place-aboutMap'), {
                                    zoom: 15,
                                    center: new google.maps.LatLng(lat, lng),
                                    mapTypeControl: false,
                                    readonly: true
                                });

                                if (ffmId != '' && ffmId != 0) {
                                    type = 'ffm';
                                }

                                map.setMarker(lat, lng, type);
                            });
                            {/literal}</script>
                        {if $place.place_ffm_id != 0}
                            <div class="nm-Place-wiki">
                                <a href="{$place.place_about|escape|nl2br}" target="_blank">{$place.place_name}</a>
                            </div>
                        {else}
                            <div class="nm-Place-aboutText">{$place.place_about|escape|nl2br}</div>
                        {/if}
                    {/if}
                    {if $has_events}
                        <h2>Events</h2>
                        {include file='post/eventList.tpl'}
                    {/if}
                </div>
            {/if}
        </div>
        <div class="nm-Place-left">
            <h1 class="nm-Place-title">{if !empty($USER)}
                    {if !empty($place.favorited)}
                        <div class="nm-Favorites-remove" data-place="{$place.place_id}">{$DIC.buttons.favoriteRemove}</div>
                    {else}
                        <div class="nm-Favorites-add" data-place="{$place.place_id}">{$DIC.buttons.favoriteAdd}</div>
                    {/if}
                    <script>
                        require(['global/favorites']);
                    </script>
                {/if}{$place.place_name}</h1>
            <div style="padding: 0 0 32px;">
            {include file='post/postList.tpl'}
            </div>
        </div>
    </div>
</div>
{include file='global/footer.tpl'}
</body>
</html>