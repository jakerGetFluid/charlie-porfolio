(function ($) {
    'use strict';

    $(document).ready(function () {
        if ($('.portfolio-detail.full-screen')[0]) {
            $(window).resize(function () {
                $('.wrap-portfolio-imgs.rit-wrap-slider ').height($(window).height());
                $('.wrap-portfolio-imgs.rit-wrap-slider .portfolio-img').height($(window).height());
                $('.wrap-portfolio-imgs.rit-wrap-slider .portfolio-img').width($(window).width());
            }).resize();
            $('.wrap-portfolio-content.expand').height($('.wrap-portfolio-content.expand').height());
            $('.wrap-portfolio-content.expand').addClass('deactive');
            $('.toggle-view').on('click', function () {
                $('.wrap-portfolio-content.expand').toggleClass('deactive');
                $('.wrap-portfolio-content.minimal').toggleClass('active');
            })
        }
        if (!$('.portfolio-detail.portfolio-embed-format.full-screen')[0]) {
            $('.rit-wrap-slider').slick({
                autoplay: true,
                autoplaySpeed: 3500,
                prevArrow: '<span class="prev-slide slider-arrow"><i class="clever-icon-preview"></i></span>',
                nextArrow: '<span class="next-slide slider-arrow"><i class="clever-icon-next"></i></span>',
                rtl: $('body.rtl')[0] ? true : false
            });
        }
    })
    $(window).on('load',function () {
        $('.wrap-portfolio-content.expand').css('opacity', '1');
    })
})(jQuery)