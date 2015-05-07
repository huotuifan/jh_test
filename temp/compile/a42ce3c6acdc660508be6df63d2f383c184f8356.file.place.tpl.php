<?php /* Smarty version Smarty-3.0.8, created on 2015-01-09 03:36:44
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/classes/apps/places/place.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197211647154af4ccc753b69-54071745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a42ce3c6acdc660508be6df63d2f383c184f8356' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/classes/apps/places/place.tpl',
      1 => 1419470303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197211647154af4ccc753b69-54071745',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/Users/andrehsu/public/web_development/noisymap/src/classes/smarty/plugins/modifier.escape.php';
?><!DOCTYPE html>
<html>
<head>
    <title>Noisymap</title>
<?php $_template = new Smarty_Internal_Template('global/scripts.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
<body class="nm-Page">
<?php $_template = new Smarty_Internal_Template('global/header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<input type="hidden" id="PlaceLat" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_lat'];?>
">
<input type="hidden" id="PlaceLng" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_lng'];?>
">
<input type="hidden" id="PlaceFfmId" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_ffm_id'];?>
">
<input type="hidden" id="PlacePostType" value="<?php echo $_smarty_tpl->getVariable('place')->value['postType'];?>
">

<div class="nm-Place-map">
    <div class="nm-Map-line"></div>
    <div id="PlaceMap" style="background: #fafafa; height: 80px;"></div>
    <div class="nm-Map-bottomLine"></div>
</div>
<script type="text/javascript">
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
</script>
<div class="nm-Content">
    <div class="nm-Content-inner">
        <div class="nm-Place-right">
            <?php $_smarty_tpl->tpl_vars['is_editable'] = new Smarty_variable((!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)&&$_smarty_tpl->getVariable('place')->value['user_id']==$_smarty_tpl->getVariable('USER')->value['user_id'])||$_smarty_tpl->getVariable('USER')->value['user_level']==1, null, null);?>
            <?php $_smarty_tpl->tpl_vars['has_about'] = new Smarty_variable(!empty($_smarty_tpl->getVariable('place',null,true,false)->value['place_about']), null, null);?>
            <?php $_smarty_tpl->tpl_vars['has_events'] = new Smarty_variable(!empty($_smarty_tpl->getVariable('events',null,true,false)->value), null, null);?>

            <?php if ($_smarty_tpl->getVariable('is_editable')->value||$_smarty_tpl->getVariable('has_about')->value||$_smarty_tpl->getVariable('has_events')->value){?>
                <div class="nm-Place-about">
                    <?php if ($_smarty_tpl->getVariable('has_about')->value||$_smarty_tpl->getVariable('is_editable')->value){?>
                        <h2><?php if ($_smarty_tpl->getVariable('is_editable')->value){?>
                            <span class="nm-Place-editButton">Edit</span>
                            <span class="nm-Place-deleteButton" data-place-id="<?php echo $_smarty_tpl->getVariable('place')->value['place_id'];?>
">Delete</span>
                            <form id="CurrentPlace">
                                <input type="hidden" name="place_id" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_id'];?>
"/>
                                <input type="hidden" name="place_name" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('place')->value['place_name']);?>
"/>
                                <input type="hidden" name="place_about" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('place')->value['place_about']);?>
"/>
                                <input type="hidden" name="place_lat" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_lat'];?>
"/>
                                <input type="hidden" name="place_lng" value="<?php echo $_smarty_tpl->getVariable('place')->value['place_lng'];?>
"/>
                            </form>
                            <script>
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
                            </script>
                            <?php }?></h2>
                        <div class="nm-Place-aboutMap" style="background: #fafafa; height: 284px; width: 284px;"></div>
                        <script type="text/javascript">
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
                            </script>
                        <?php if ($_smarty_tpl->getVariable('place')->value['place_ffm_id']!=0){?>
                            <div class="nm-Place-wiki">
                                <a href="<?php echo nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('place')->value['place_about']));?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('place')->value['place_name'];?>
</a>
                            </div>
                        <?php }else{ ?>
                            <div class="nm-Place-aboutText"><?php echo nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('place')->value['place_about']));?>
</div>
                        <?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->getVariable('has_events')->value){?>
                        <h2>Events</h2>
                        <?php $_template = new Smarty_Internal_Template('post/eventList.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                    <?php }?>
                </div>
            <?php }?>
        </div>
        <div class="nm-Place-left">
            <h1 class="nm-Place-title"><?php if (!empty($_smarty_tpl->getVariable('USER',null,true,false)->value)){?>
                    <?php if (!empty($_smarty_tpl->getVariable('place',null,true,false)->value['favorited'])){?>
                        <div class="nm-Favorites-remove" data-place="<?php echo $_smarty_tpl->getVariable('place')->value['place_id'];?>
"><?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['favoriteRemove'];?>
</div>
                    <?php }else{ ?>
                        <div class="nm-Favorites-add" data-place="<?php echo $_smarty_tpl->getVariable('place')->value['place_id'];?>
"><?php echo $_smarty_tpl->getVariable('DIC')->value['buttons']['favoriteAdd'];?>
</div>
                    <?php }?>
                    <script>
                        require(['global/favorites']);
                    </script>
                <?php }?><?php echo $_smarty_tpl->getVariable('place')->value['place_name'];?>
</h1>
            <div style="padding: 0 0 32px;">
            <?php $_template = new Smarty_Internal_Template('post/postList.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            </div>
        </div>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template('global/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>