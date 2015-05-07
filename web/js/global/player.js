define([
    'jquery',
    'common/utils'
], function ($, utils) {
    function initResource(i, el) {
        var RESOURCE_MAX_WIDTH = 640;

        var $el = $(el);
        var video = $el.data('video');
        var isMobileBrowser = utils.mobileCheck();
        if (video) {
            var $play = $('<img/>', {
                src: '/i/decor/button-play.png',
                width: 35,
                height: 26,
                'class': 'nm-Post-resourcePlay'
            });

            $('.nm-Post-resourceImage', $el)
                .click(function () {
                    if (! isMobileBrowser) {
                        $el.empty();

                        var h = $el.data('video-height'),
                            w = $el.data('video-width'),
                            frame = $('<iframe/>', {
                                'src': video,
                                'class': 'nm-Post-resourceVideo'
                            })
                            .css('width', RESOURCE_MAX_WIDTH)
                            .appendTo($el);

                        if (h != undefined && w != undefined) {
                            var height = h;
                            if (RESOURCE_MAX_WIDTH < w) {
                                var ratio = RESOURCE_MAX_WIDTH / w;
                                height = h * ratio;
                            }

                            frame.css({
                                'max-width': RESOURCE_MAX_WIDTH + 'px',
                                'height': height + 'px'
                            });
                        }
                    } else {
                        window.location.assign($('.nm-Post-resourceTitle a', $el).attr('href'));
                    }
                })
                .css('cursor', 'pointer')
                .append($play);
        }
    }

    return {
        init: function () {
            $('.nm-Post-resource').each(initResource);
        }
    }

});