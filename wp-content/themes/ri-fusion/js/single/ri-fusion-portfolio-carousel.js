(function ($) {
    'use strict';
    $(document).ready(function () {
        portfolioCarouselLayout();
            portfolioCarousel();
    });
    function portfolioCarouselLayout() {
        $(window).resize(function () {
            if ($('.rit-portfolio-carousel.on-screen')[0]) {
                var height = parseInt($(window).height() - $('#header').height() - $('#footer-page').height());
                $('.rit-portfolio-carousel.on-screen .portfolio-item').height(height);
            }
            if ($('.rit-portfolio-carousel.full-screen')[0]) {
                $('.rit-portfolio-carousel.full-screen .portfolio-item').height($(window).height());
                $('.rit-portfolio-carousel.full-screen').height($(window).height());
            }
        }).resize()
    }
    function portfolioCarousel() {
            $('.rit-portfolio-carousel').each(function () {
                var data = JSON.parse($(this).attr('data-config'));
                var cols = data['columns'];
                var mobile_col=data['mobile_col'];
                var table_col=data['table_col'];
                var show_arrow=data['show_arrow']=='1'?true:false;
                var show_pag=data['show_pag']=='1'?true:false;
                var auto_play=data['auto_play']=='1'?true:false;
                var auto_play_speed=data['auto_play_speed'];
                var show_thumb=data['show_thumb'];
                $(this).find('.wrap-portfolio-block-item').slick({
                    slidesToShow: cols,
                    slidesToScroll: 1,
                    autoplay: auto_play,
                    autoplaySpeed: auto_play_speed,
                    dots:show_pag,
                    arrows:show_arrow,
                    prevArrow: '<span class="prev-slide slider-arrow"><i class=" clever-icon-preview"></i></span>',
                    nextArrow: '<span class="next-slide slider-arrow"><i class=" clever-icon-next"></i></span>',
                    rtl: $('body.rtl')[0] ? true : false,
                    asNavFor: show_thumb==1? $(this).find('.wrap-portfolio-thumbs'):'',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: table_col
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: mobile_col
                            }
                        }
                    ]
                });
                if(show_thumb==1){
                    var wrap_w=data['max_thumb']*$(this).find('.wrap-block-portfolio-thumbs img').outerWidth();
                    $(this).find('.wrap-block-portfolio-thumbs ').outerWidth(wrap_w);
                    $(this).find('.wrap-portfolio-thumbs').slick({
                        slidesToShow: data['max_thumb'],
                        slidesToScroll: 1,
                        infinite: true,
                        dots:false,
                        arrows:false,
                        centerMode: true,
                        focusOnSelect: true,
                        rtl: $('body.rtl')[0] ? true : false,
                        asNavFor: $(this).find('.wrap-portfolio-block-item')
                    });

                }
            });
        }
})(jQuery)