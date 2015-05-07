define([
    'common/utils',
    'jquery',
    'jqueryui/dialog',
    'jqueryui/autocomplete',
    'jqueryui/timepicker'
], function (utils, $) {
    var formInit = false;
    var callback;

    var wnd = $('#AddPost').dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        position: 'center'
    });

    var mapView;

    function init() {
        if (!formInit) {
            require(['widgets/post/form', 'widgets/maps/editor', 'widgets/maps/view'], formInitialization);
            formInit = true;
        }
    }

    function formInitialization(form, editor, view) {
        mapView = view.init('PostPlaceMap');

        function clearPlaceSelection() {
            mapView.clear();
            $('#PostPlace').val('');
            $('#PostPlaceName').text('');
        }

        function onPlaceSelect(place) {
            $('#PostPlace').val(place['place_id']);
            $('#PostPlaceName').text(place['place_name']);
            mapView.show(place);
        }

        form.init({
            form: 'PostForm',
            text: 'PostText',
            place: 'PostPlace',
            tags: 'PostTags',
            action: 'post.post'
        });

        $('#PostPlaceSearch').autocomplete({
            source: function (request, response) {
                utils.simpleAction('place.search', {
                        term: request.term,
                        filter: true
                    },
                    function (result) {
                        response(result['places']);
                    }
                );
            },
            minLength: 2,
            focus: function (event, ui) {
                $("#PostPlaceSearch").val(ui.item['place_name']);
                return false;
            },
            select: function (event, ui) {
                if (ui.item) {
                    onPlaceSelect(ui.item);
                } else {
                    clearPlaceSelection();
                }
            }
        }).data('autocomplete')._renderItem = function (ul, item) {
            return $('<li></li>')
                .data('item.autocomplete', item)
                .append('<a>' + item['place_name'] + '</a>')
                .appendTo(ul);
        };

        $('#NewPlace').click(function () {
            editor.open($('#PostPlaceSearch').val(), onPlaceSelect);
        });

        $('#PostResourceURL')
            .keyup(function (e) {
                if (e.which === 13) {
                    addNewResource();
                }
            })
            .keypress(function (e) {
                $(this).removeClass('f-error');
                if (e.which === 13) {
                    e.preventDefault();
                }
            });

        $('#PostResourceURLAdd').click(addNewResource);

        var $postEventTime = $('#PostEventTime').datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "HH:mm"
        });

        $('#PostAsEvent').change(function () {
            var isEvent = $(this).is(':checked');
            if (!isEvent) {
                $postEventTime.attr('disabled', 'disabled')
            } else {
                $postEventTime.removeAttr('disabled').focus();
            }
        });
    }

    function addNewResource() {
        var url = $('#PostResourceURL').val();
        $('#PostResourceLoading').show();
        utils.simpleAction('resource.check', {
                url: url
            },
            function (result) {
                $('#PostResourceLoading').hide();
                if (result.isOk()) {
                    var res = new Resource(result.resource);
                    $('#PostResources').show().append(res.$el);
                    $('#PostResourceURL').val('').removeClass('f-error');
                }
            }
        );
    }

    function Resource(resource) {
        this.resource = resource;

        var $el = this.$el = $('<div class="nm-Form-Post-resourcesItem"></div>');
        $('<input type="hidden" name="resource[]"/>').val(resource['resource_id']).appendTo($el);

        var $column;
        if (resource['resource_image']) {
            $('<img/>', {
                'src': '/resources/' + resource['resource_folder'] + '/' + resource['resource_uuid'] + '.jpg',
                'class': 'nm-Form-Post-resourcesItemImage'
            }).appendTo($el);
            $column = $('<div class="nm-Form-Post-resourcesColumn"></div>').appendTo($el);
        } else {
            $column = $('<div></div>').appendTo($el);
        }

        $('<img/>', {
            'src': '/i/decor/button-remove.png',
            'width': 16,
            'height': 16,
            'class': 'nm-Form-Post-resourcesItemRemove'
        })
            .appendTo($el)
            .click(function () {
                $el.detach();
            });

        $('<a></a>', {
            href: resource['resource_url'],
            text: resource['resource_title']
        }).appendTo($column);
        $('<div></div>', {
            text: resource['resource_description']
        }).appendTo($column);
    }

    function getWidth() {
        return $(window).width() > 480 ? 400 : '90%';
    }

    function arrayToMap(arr) {
        var model = {};
        $.each(arr, function () {
            if (model[this.name] !== undefined) {
                if (!model[this.name].push) {
                    model[this.name] = [model[this.name]];
                }
                model[this.name].push(this.value || '');
            } else {
                model[this.name] = this.value || '';
            }
        });
        return model;
    }

    var previouslyEditedPostId = 0;

    return {
        open: function (value, _callback) {
            var model = {};
            this.edit(model, _callback)
        },
        editArray: function (postArray, _callback) {
            var model = arrayToMap(postArray);
            this.edit(model, _callback)
        },
        edit: function (post, _callback) {
            if (post['post_id'] != previouslyEditedPostId) {
                var $postPlace = $('#PostPlace');
                if (typeof post['post_id'] === 'undefined') {
                    $('.nm-Form-Post-resourcesItem').remove();
                    $('#PostPlaceMap')
                        .hide()
                        .empty();
                    $postPlace.empty();
                }

                callback = _callback;

                init();

                var $name = $('#PostTitle').val(post['post_title']);
                $('#PostId').val(post['post_id']);
                $('#PostText').val(post['post_text']);
                $postPlace.val(post['post_place']);
                if ((new Date(post['post_event'])).getTime() > 0) {
                    $('#PostEventTime').val(post['post_event']);
                    $('#PostAsEvent').prop('checked', true);
                }
                $name.focus();

                if (post['post_resources']) {
                    var resources = jQuery.parseJSON(post['post_resources']);
                    $.each(resources, function() {
                        var res = new Resource(this);
                        $('#PostResources').show().append(res.$el);
                        $('#PostResourceURL').val('').removeClass('f-error');
                    });
                }

                if (post['post_place_data']) {
                    var place = jQuery.parseJSON(post['post_place_data']);
                    $('#PlaceEditorName').val(place['place_name']);
                    $('#PlaceEditorAbout').val(place['place_about']);
                    $('#PlaceEditorId').val(place['place_id']);
                    $('#PlaceEditorLat').val(place['place_lat']);
                    $('#PlaceEditorLng').val(place['place_lng']);

                    require(['widgets/maps/view'], function(view) {
                        mapView = view.init('PostPlaceMap');
                        mapView.show(place);
                    });
                }

                previouslyEditedPostId = post['post_id'];
            }

            wnd.dialog('option', 'width', getWidth());
            wnd.dialog('open');
        }
    }
});
