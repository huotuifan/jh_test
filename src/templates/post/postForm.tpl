<div>
    <form id="PostForm">
        <input type="hidden" name="id" id="PostId"/>
        <input type="hidden" name="postFilter" id="post_filter" value=""/>
        <div class="nm-Form-Post-row">
            <table class="f-max">
                <tr>
                    <td style="width: {$DIC.post.width};"><label class="f-bold" for="PostTitle">{$DIC.post.title}</label></td>
                    <td><input type="text" name="title" id="PostTitle" class="f-max"></td>
                </tr>
            </table>
        </div>
        <div class="nm-Form-Post-row">
            <label class="f-bold" for="PostText">{$DIC.post.text}
                <textarea name="text" id="PostText" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
            </label>
        </div>
        <div class="nm-Form-Post-row">
            <div class="nm-Form-Post-placeWrapper">
                <table class="f-max">
                    <tr>
                        <td style="width: {$DIC.post.width};"><label class="f-bold" for="PostPlaceSearch">{$DIC.post.place}</label></td>
                        <td><input type="text" id="PostPlaceSearch" class="f-max" placeholder="{$DIC.post.placeSearch}"></td>
                        <td style="width: 36px; text-align: right;"><div class="nm-Form-Post-addPlace"><img src="/i/decor/button-new-place.png" id="NewPlace" alt="" width="28" height="28" title="New Place"></div></td>
                    </tr>
                </table>
            </div>
            <div class="nm-Form-Post-selectedPlace">
                <input type="hidden" name="place" id="PostPlace">
                <div class="nm-Form-Post-selectedPlace-map" id="PostPlaceMap" style="display: none;"></div>
                <div class="nm-Form-Post-selectedPlace-name" id="PostPlaceName"></div>
            </div>
        </div>
        
        <!--- search filter start --->
        <div class="nm-Form-Post-row">
            <table class="f-max">
                <tr>
                    <td style="width: {$DIC.post.width};"><label class="f-bold" for="PostTitle">{$DIC.post.filter}</label></td>
                    <td>{include file='post/postFilter.tpl'}</td>
                </tr>
            </table>
        </div>
        <!--- search filter end --->
    
        <div class="nm-Form-Post-row">
            <div class="nm-Form-Post-resourcesWrapper">
                <div class="nm-Form-Post-resources" id="PostResources" style="display: none;">
                    <div class="nm-Form-Post-resourcesTitle"><b>{$DIC.post.resources}:</b></div>
                </div>
                <label for="PostResourceURL">{$DIC.post.url} <input type="text" id="PostResourceURL" class="f-input-noradius"></label>
                <input type="button" value="{$DIC.post.add}" id="PostResourceURLAdd" class="f-button">
                <img src="/i/decor/loading.gif" alt="" width="16" height="11" id="PostResourceLoading" style="display: none;">
            </div>
        </div>

        <div>
            <table>
                <tr>
                    <td><div style="padding-right: 4px;"><input id="PostAsEvent" type="checkbox"/></div></td>
                    <td><label for="PostAsEvent" style="padding-right: 10px;">Add as Event</label></td>
                    <td><input type="text" name="event" id="PostEventTime" disabled="disabled"/></td>
                </tr>
            </table>
        </div>

        <div class="right">
            <input type="submit" value="{$DIC.post.submit}" class="f-button f-button-submit" style="min-width: 70px;"/>
        </div>
        <div class="clear"></div>
    </form>
    <div id="PlaceEditor" class="nm-Form-Place-wrapper" title="{$DIC.post.newPlace}" style="display: none;">
        <div class="nm-Form-Place-map" id="PlaceEditorMap"></div>
        <div class="nm-Form-Place-fields">
            <form id="PlaceForm">
                <input type="hidden" name="place_id" id="PlaceEditorId">
                <input type="hidden" name="place_lat" id="PlaceEditorLat">
                <input type="hidden" name="place_lng" id="PlaceEditorLng">
                <div class="nm-Form-Post-row">
                    <table class="f-max">
                        <tr>
                            <td style="width: {$DIC.post.placeWidth};"><label class="f-bold" for="PlaceEditorName">{$DIC.post.placeName}</label></td>
                            <td><input type="text" name="place_name" id="PlaceEditorName" class="f-max"></td>
                        </tr>
                    </table>
                </div>
                <div class="nm-Form-Post-row">
                    <label class="f-bold" for="PlaceEditorAbout">{$DIC.post.placeAbout}
                        <textarea name="place_about" id="PlaceEditorAbout" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
                    </label>
                </div>
                <div class="right">
                    <input type="submit" value="{$DIC.post.save}" class="f-button f-button-submit" style="min-width: 70px;">
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script type="text/javascript">{literal}
    require(['jquery', 'common/utils'], function ($,utils) {
            
            $('#post_filter_button').unbind();
            $('#post_filter_button').click(function (e) {
                                      var root= new utils.node("root",null, true);
                                      $('#PostForm').find("input:checkbox").each(function () {
                                                                                    var val= $(this).attr("name");
                                                                                    if(val != null)
                                                                                    {
                                                                                        var children = $(this).val();
                                                                                        var checked= $(this).is(':checked');
                                                                                        var nodeToAdd= new utils.node(val,children,checked);
                                                                                        utils.addNode(root, nodeToAdd);
                                                                                    }
                                                                                 
                                                                                    });
                                      var allPaths= utils.returnAllCheckedPaths(root);
                                      var searchString= utils.constructSearchString(allPaths);
                                      alert(searchString);
                                      $('#post_filter').val(searchString);
                                      e.preventDefault();
                                      });
            
            });
    {/literal}</script>
