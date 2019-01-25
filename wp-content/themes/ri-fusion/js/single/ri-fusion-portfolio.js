(function ($) {
    'use strict';
    $(window).load(function () {
        $(window).resize(function () {
            portfolioMasonry();
        }).resize();
        jQuery('.wrap-portfolio-imgs').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
            portfolioMasonry();
        });
    });
    function portfolioMasonry() {
            $('.rit-portfolio:not(.rit-portfolio-carousel)').each(function () {
                var data = JSON.parse($(this).attr('data-config'));
                var col = data['columns'];
                var wrapID = '#' + data['id'];
                var $grid = $(wrapID+' .wrap-portfolio-block-item');
                var itemwidth = $grid.width() / col;
                var data_w;
                var grid_w=$grid.outerWidth();
                if ($(window).width() > 768) {
                    $grid.find('.portfolio-item').each(function () {
                        if (!$(this).data("w")) {
                            data_w = Math.floor(jQuery(this).outerWidth(true) / itemwidth);
                            if($(window).width() > 1900) {
                                if (jQuery(this).outerWidth(true) % itemwidth > 7) {
                                    data_w++;
                                }
                            }
                            $(this).attr('data-w', data_w == 0 ? '1' : data_w);
                        }
                        $(this).outerWidth($(this).data("w") * itemwidth);
                    });
                }
                else if($(window).width() <= 768 && $(window).width()>480){
                    $grid.find('.portfolio-item').width('');
                    itemwidth=grid_w/2;
                    $grid.find('.portfolio-item').each(function () {
                       if($(this).outerWidth(true)<grid_w){
                           $(this).outerWidth((grid_w/2)-2)
                       }
                    })
                }else{
                    $grid.find('.portfolio-item').width('100%');
                    itemwidth=grid_w;
                }

                setTimeout(function () {
                    $grid.isotope({
                            masonry: {
                                columnWidth: itemwidth
                            }
                        }
                    );
                }, 500);
                $(wrapID + ' #portfolio-filter li').on('click', function () {
                    $(wrapID + ' #portfolio-filter li').removeClass('active');
                    $(this).addClass('active');
                    $(wrapID + ' #mobile-portfolio-filter span').text($(this).text());
                    var filtervar = $(this).attr('data-id');
                    $grid.isotope({filter: '.' + filtervar});
                });
                $(wrapID + ' #portfolio-filter').on('click', function () {
                    $(this).removeClass('active');
                });
                $(wrapID + ' #mobile-portfolio-filter').on('click', function () {
                    $(wrapID + ' #portfolio-filter').toggleClass('active');
                })
            })
        }
})(jQuery)