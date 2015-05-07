<?php /* Smarty version Smarty-3.0.8, created on 2015-04-28 01:29:13
         compiled from "/Users/andrehsu/public/web_development/noisymap/src/classes/apps/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1118762469553f44d9ead363-51848068%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0662bdf238d5faa6a491e2c090d7b194e5c6772' => 
    array (
      0 => '/Users/andrehsu/public/web_development/noisymap/src/classes/apps/index/index.tpl',
      1 => 1430207913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1118762469553f44d9ead363-51848068',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_smarty_tpl->getVariable('DIC')->value['global']['title'];?>
</title>
<?php $_template = new Smarty_Internal_Template('global/scripts.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
<body class="nm-Page">
<?php $_template = new Smarty_Internal_Template('global/header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('search',true); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<div class="nm-Map" style="padding-bottom: 20px;">
    <input type="hidden" id="filter" value="<?php echo $_smarty_tpl->getVariable('tag')->value;?>
"/>
    <input type="hidden" id="type" value="<?php echo $_smarty_tpl->getVariable('tag')->value;?>
"/>
    <div class="nm-Map-line"></div>
    <div id="Map" class="nm-Map-container" style="height: 200px;"></div>
    <div id="Slider" class="nm-Slider">
        <div class="nm-Slider-line"></div>
        <div class="nm-Slider-inner">
            <div class="nm-Slider-label"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="nm-Content">
    <div class="nm-Content-inner">
        <div class="nm-Content-filterWrapper">
            <table class="nm-Content-filter">
                <tr>
                    <td><a data-tag="" href="/"<?php if (empty($_smarty_tpl->getVariable('tag',null,true,false)->value)){?> class="nm-Content-filterSelected" <?php }?>><?php echo $_smarty_tpl->getVariable('DIC')->value['filter']['all'];?>
</a></td>
                    <td><a data-tag="audio" href="/tags/audio"<?php if ($_smarty_tpl->getVariable('tag')->value=='audio'){?> class="nm-Content-filterSelected" <?php }?>><?php echo $_smarty_tpl->getVariable('DIC')->value['filter']['audio'];?>
</a></td>
                    <td><a data-tag="photo" href="/tags/photo"<?php if ($_smarty_tpl->getVariable('tag')->value=='photo'){?> class="nm-Content-filterSelected" <?php }?>><?php echo $_smarty_tpl->getVariable('DIC')->value['filter']['photo'];?>
</a></td>
                    <td><a data-tag="video" href="/tags/video"<?php if ($_smarty_tpl->getVariable('tag')->value=='video'){?> class="nm-Content-filterSelected" <?php }?>><?php echo $_smarty_tpl->getVariable('DIC')->value['filter']['video'];?>
</a></td>
                </tr>
            </table>
        </div>

        <div id= "advancedFilter">
            <?php $_template = new Smarty_Internal_Template('post/filter.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div>


        <div id="Content">
        </div>
    </div>
</div>
<script type="text/javascript">
require([
    'jquery',
    'widgets/maps/maps',
    'common/utils',
    'global/search',
    'jqueryui/draggable'
], function ($, maps, utils, search) {
    var places = {};
    var $mapEl = $('#Map');
    var mapContainer = maps.init($mapEl);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            mapContainer.map.setCenter(latLng);
            mapContainer.map.setZoom(12);
        });
    }

    search.init(mapContainer);

    $('.nm-Content-filter a').click(function (e) {
        $('.nm-Content-filter a').removeClass('nm-Content-filterSelected');
        var $el = $(this).addClass('nm-Content-filterSelected');
        var currentSearchString= $('#filter').val().split('|')[0];
        $('#filter').val(currentSearchString + '|' + $el.data('tag'));
        $('#type').val($el.data('tag'));
        reload();
        e.preventDefault();
    });
        
    $('#filter_button').click(function (e) {
        var root= new utils.node("root",null, true);
        $('#filter_form').find("input:checkbox").each(function () {
        var val= $(this).attr("name");
        var children = $(this).val();
        var checked= $(this).is(':checked');
        var nodeToAdd= new utils.node(val,children,checked);
        utils.addNode(root, nodeToAdd);
        });
        var allPaths= utils.returnAllCheckedPaths(root);
        var searchString= utils.constructSearchString(allPaths);
        var typeVal= "|" + $('#type').val();
        var tag= searchString.concat(typeVal);
        $('#filter').val(tag);
        reload();
        e.preventDefault();
    });
        
        $('#clear_filter').click(function (e) {
        $('#filter').val('|' + $('#type').val());
        $('#filter_form').find("input:checkbox").each(function () {
            var checked= $(this).prop('checked',false);
    
                                                                   });

        reload();
        e.preventDefault();
        
    });

        
    
        
        
        
    //ends here

    function loadPosts(bounds) {
        utils.simpleAction('post.list', {
            bounds: bounds,
            filter: $('#filter').val()
        }, function (data) {
            $('#Content').html(data.html);
            if (! (data.places instanceof Array)) {
                places = data.places;
            } else {
                places = {};
            }
            loadFFMPlaces(bounds).done(function(data) {
                for (var place in data.places) {
                    if (data.places.hasOwnProperty(place)) {
                        places[place] = data.places[place];
                    }
                }

                mapContainer.clearPlaces();
                mapContainer.addPlaces(places);
            });
        });
    }

    function loadFFMPlaces(bounds) {
        return utils.simpleAction('place.search', {
            bounds: bounds,
            filter: 'ffm'
        });
    }

    function reload() {
        loadPosts(mapContainer.map.getBounds().toUrlValue());
    }

    var timer;
    google.maps.event.addListener(mapContainer.map, 'bounds_changed', function () {
        if (timer) {
            clearTimeout(timer);
        }
        timer = window.setTimeout(reload, 300);
    });

    $("#Slider").draggable({
        axis: "y",
        containment: [0, 100, 0, 400],
        drag: function (event, ui) {
            var h = ui.position.top;
            $mapEl.height(h > 6 ? h - 6 : 0);
            if (h < 0) {
                ui.position.top = 0;
            } else {
                if (typeof google !== 'undefined' && mapContainer) {
                    google.maps.event.trigger(mapContainer.map, 'resize');
                }
            }
        },
        stop: function (event, ui) {
            reload();
        }
    });
});
</script>
<?php $_template = new Smarty_Internal_Template('global/footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>