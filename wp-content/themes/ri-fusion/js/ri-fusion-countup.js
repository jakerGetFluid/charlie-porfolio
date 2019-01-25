(function ($) {
    'use strict';
    jQuery(document).ready(function () {
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: '+'
        };
        jQuery('.countup-block').each(function () {
            var data = JSON.parse($(this).attr('data-config'));
            var item = new CountUp(data['countid'], data['start_number'], data['end_number'], data['decimals'], data['duration'], options);
            jQuery(window).bind("scroll", function () {
                if (jQuery('#' + data['wrapid']).ActiveScreen()) {
                    item.start();
                }
            });
        })
    })
})(jQuery);