<?php /* Smarty version Smarty-3.0.8, created on 2015-04-30 15:02:57
         compiled from "/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/postForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10600858875542a691e73736-63906476%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a3286c36ac0d9fb1a04e4a2228c1bafd35066a3' => 
    array (
      0 => '/Users/andrehsu/public/web_development/gamesetmatch/src/templates/post/postForm.tpl',
      1 => 1422583165,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10600858875542a691e73736-63906476',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div>
    <form id="PostForm">
        <input type="hidden" name="id" id="PostId"/>
        <input type="hidden" name="postFilter" id="post_filter" value=""/>
        <div class="nm-Form-Post-row">
            <table class="f-max">
                <tr>
                    <td style="width: <?php echo $_smarty_tpl->getVariable('DIC')->value['post']['width'];?>
;"><label class="f-bold" for="PostTitle"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['title'];?>
</label></td>
                    <td><input type="text" name="title" id="PostTitle" class="f-max"></td>
                </tr>
            </table>
        </div>
        <div class="nm-Form-Post-row">
            <label class="f-bold" for="PostText"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['text'];?>

                <textarea name="text" id="PostText" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
            </label>
        </div>
        <div class="nm-Form-Post-row">
            <div class="nm-Form-Post-placeWrapper">
                <table class="f-max">
                    <tr>
                        <td style="width: <?php echo $_smarty_tpl->getVariable('DIC')->value['post']['width'];?>
;"><label class="f-bold" for="PostPlaceSearch"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['place'];?>
</label></td>
                        <td><input type="text" id="PostPlaceSearch" class="f-max" placeholder="<?php echo $_smarty_tpl->getVariable('DIC')->value['post']['placeSearch'];?>
"></td>
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
                    <td style="width: <?php echo $_smarty_tpl->getVariable('DIC')->value['post']['width'];?>
;"><label class="f-bold" for="PostTitle"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['filter'];?>
</label></td>
                    <td><?php $_template = new Smarty_Internal_Template('post/postFilter.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?></td>
                </tr>
            </table>
        </div>
        <!--- search filter end --->
    
        <div class="nm-Form-Post-row">
            <div class="nm-Form-Post-resourcesWrapper">
                <div class="nm-Form-Post-resources" id="PostResources" style="display: none;">
                    <div class="nm-Form-Post-resourcesTitle"><b><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['resources'];?>
:</b></div>
                </div>
                <label for="PostResourceURL"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['url'];?>
 <input type="text" id="PostResourceURL" class="f-input-noradius"></label>
                <input type="button" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['post']['add'];?>
" id="PostResourceURLAdd" class="f-button">
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
            <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['post']['submit'];?>
" class="f-button f-button-submit" style="min-width: 70px;"/>
        </div>
        <div class="clear"></div>
    </form>
    <div id="PlaceEditor" class="nm-Form-Place-wrapper" title="<?php echo $_smarty_tpl->getVariable('DIC')->value['post']['newPlace'];?>
" style="display: none;">
        <div class="nm-Form-Place-map" id="PlaceEditorMap"></div>
        <div class="nm-Form-Place-fields">
            <form id="PlaceForm">
                <input type="hidden" name="place_id" id="PlaceEditorId">
                <input type="hidden" name="place_lat" id="PlaceEditorLat">
                <input type="hidden" name="place_lng" id="PlaceEditorLng">
                <div class="nm-Form-Post-row">
                    <table class="f-max">
                        <tr>
                            <td style="width: <?php echo $_smarty_tpl->getVariable('DIC')->value['post']['placeWidth'];?>
;"><label class="f-bold" for="PlaceEditorName"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['placeName'];?>
</label></td>
                            <td><input type="text" name="place_name" id="PlaceEditorName" class="f-max"></td>
                        </tr>
                    </table>
                </div>
                <div class="nm-Form-Post-row">
                    <label class="f-bold" for="PlaceEditorAbout"><?php echo $_smarty_tpl->getVariable('DIC')->value['post']['placeAbout'];?>

                        <textarea name="place_about" id="PlaceEditorAbout" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
                    </label>
                </div>
                <div class="right">
                    <input type="submit" value="<?php echo $_smarty_tpl->getVariable('DIC')->value['post']['save'];?>
" class="f-button f-button-submit" style="min-width: 70px;">
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
    </script>
