/**
 * Created by Kien Nguyen on 1/5/16.
 */
(function ($) {
    'use strict';
    jQuery(document).ready(function () {
        Animation();
        MobileNav();
        $('.envira-album-title').on('click', function () {
            $(this).parent().find('a').trigger('click');
        });
        // ---------------------------------------- //
        // BACK TO TOP --------------------------- //
        // ---------------------------------------- //
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-to-top').addClass('show');
            } else {
                jQuery('#back-to-top').removeClass('show');
            }
            if ($('#wpadminbar')[0] && $(window).width() > 768) {
                $('#sticker-sticky-wrapper.is-sticky').find('#sticker').css('top', $('#wpadminbar').height());
            }
        });
        jQuery('#back-to-top').click(function (e) {
            e.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, 1000);
            return false;
        });
        $(window).resize(function () {
            if ($('.cover-post-image')[0]) {
                if ($('.content-area.style-2')[0]) {
                    $('.cover-post-image').css('min-height', parseInt($(window).height() * 0.8) + 'px');
                }
                else {
                    $('.cover-post-image').css('min-height', parseInt($(window).height()) + 'px');
                }
            }
            if ($('.post-content .wrap-img')[0]) {
                $('.post-content .wrap-img').each(function () {
                    var margin = ($(this).width() - $('.post-content').width() + 30) / 2;
                    if ($('body.rtl')[0]) {
                        $(this).css('margin-right', -margin + 'px')
                    } else {
                        $(this).css('margin-left', -margin + 'px')
                    }
                })
            }
            if ($(window).width() > 768) {
                var defaultH = $('#header.wrap-header').height();
                var menuH = $('#main-navigation').height();
                if (menuH != defaultH) {
                    if (menuH > defaultH) {
                        $('#main-navigation > div > ul > li > a, #right-header .widget_nav_menu > div > ul > li > a').css('line-height', parseInt(defaultH / 2) + 'px');
                    } else {
                        $('#main-navigation > div > ul > li > a, #right-header .widget_nav_menu > div > ul > li > a').removeAttr('style');
                    }
                }
            }
        }).resize();
// ---------------------------------------- //
// Sticky Menu ---------------------------- //
// ---------------------------------------- //
        jQuery(".sticker").sticky();
        var window_width = $(window).width();
//Stick menu for different menu
        $(window).resize(function () {
            var sticky_height = $('.sticker').height();
            $('.sticker').on('sticky-end', function () {
                $(this).parent().height(sticky_height);
            });
            if ($(window).width() > 768 && $('#wpadminbar')[0]) {
                jQuery(".sticker").sticky({topSpacing: $('#wpadminbar').height()});
            }
            if ($('.stack-center-style')[0] && $(window).width() > 768) {
                $('.stack-center-style  #header').unstick();
                jQuery(".sticker").sticky();
                $('.sticker').on('sticky-start', function () {
                    $(this).width(window_width);
                    console.log(window_width);
                });
            }
            if ($('.stack-center-style .sticker')[0] && $(window).width() < 768) {
                jQuery(".sticker").unstick();
                $('.stack-center-style #header').sticky();
            }
            //Fix position menu
            var window_w = $(window).width();
            $('#main-navigation .sub-menu, #main-menu .sub-menu').each(function () {
                $(this).removeClass('pos-left');
                if (window_w < parseInt($(this).offset()['left'] + $(this).width())) {
                    $(this).addClass('pos-left')
                }
            });
        }).resize();
//Carousel
        $(document).on('click', '#sidebar-trigger, #close-sidebar, .offcanvas-active', function () {
            $('#sidebar-trigger').toggleClass('active')
            $('.wrap-body-content').toggleClass('offcanvas-active');
            $('#off-sidebar').toggleClass('active');
        });
//Envira Gallery config
        if ($('.gallery-carousel .envira-gallery-public')[0]) {
            var cols = $('.gallery-carousel .envira-gallery-public').attr('data-envira-columns');
            $('.gallery-carousel .envira-gallery-public').find('.enviratope-item').removeClass('enviratope-item');
            $('.gallery-carousel .envira-gallery-public').removeClass('envira-gallery-' + cols + '-columns');
            $('.gallery-carousel .envira-gallery-public').slick({
                autoplay: true,
                autoplaySpeed: 3500,
                slidesToShow: cols,
                prevArrow: '<span class="prev-slide slider-arrow"><i class=" clever-icon-preview"></i></span>',
                nextArrow: '<span class="next-slide slider-arrow"><i class=" clever-icon-next"></i></span>'
            });
        }
//Carousel js
        jQuery(".ri-fusion-carousel").each(function () {
            var data = JSON.parse(jQuery(this).attr('data-config'));
            var item = data['item'];
            var pag = data['pagination'] != undefined ? data['pagination'] : false;
            var nav = data['navigation'] != undefined ? data['navigation'] : false;
            var wrap = data['wrap'] != undefined ? data['wrap'] : '';
            var wrapcaroul = wrap != '' ? jQuery(this).find(wrap) : jQuery(this);
            wrapcaroul.slick({
                infinite: false,
                speed: 300,
                slidesToShow: item,
                slidesToScroll: 1,
                arrows: nav,
                autoplay: true,
                prevArrow: '<span class="rit-carousel-btn next-item"><i class=" clever-icon-preview"></i></span>',
                nextArrow: '<span class="rit-carousel-btn prev-item"><i class=" clever-icon-next"></i></span>',
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: item > 4 ? 4 : item,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: item > 3 ? 3 : item,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: item > 2 ? 2 : item,
                        }
                    }
                ]
            });
        })

//Blog Masonry
        $(window).on('load', function () {
            if ($('.rit-blog-masonry')[0]) {
                $('.rit-blog-masonry .rit-blog-grid-layout').each(function () {
                    $(this).isotope();
                });
            }
        })
        fixBodyHeight();
//Lazy load imgs
        if ($("img.lazy-img")[0]) {
            $("img.lazy-img").parent().addClass('loading');
            $("img.lazy-img").lazyload({
                effect: 'fadeIn',
                threshold: $(window).height(),
                load: function () {
                    $(this).parent().removeClass('loading');
                }
            });
        }
//    Auto typing js
        if ($('.rit-auto-typing')[0]) {
            $('.rit-auto-typing').each(function () {
                $(this).find(".content-auto-typing").typed({
                    strings: $(this).data('text'),
                    typeSpeed: $(this).data('speed'),
                    startDelay: $(this).data('delay'),
                    showCursor: $(this).data('cursor') != '' ? true : false,
                });
            });
        }
//    End Auto typing js
        //Mobile menu lightbox
        var window_w = $(window).width();
        $(window).resize(function () {
            window_w = $(window).width();
            if ($('.wrap-mobile-nav.lightbox')[0]) {
                if (!$('.wrap-mobile-nav.lightbox .triggernav')[0]) {
                    $('.wrap-mobile-nav.lightbox li:has("ul")>a').after('<span class="triggernav"><i class="clever-icon-plus"></i></span>');
                }
                if (window_w < 769) {
                    $('.wrap-mobile-nav.lightbox #mobile-nav>div>ul>li ul').slideUp();
                } else {
                    $('.wrap-mobile-nav.lightbox #mobile-nav>div>ul>li ul').slideDown();
                    $('.item-mobile-active').removeClass('item-mobile-active');
                }
            }
        }).resize();
        $(document).on('click','.wrap-mobile-nav.lightbox .triggernav', function () {
            $(this).parent().children('ul').slideToggle();
            $(this).parent().toggleClass('item-mobile-active');
        });
    });
    function fixBodyHeight() {
        $(window).resize(function () {
            var window_height = $(window).height();
            var header_height, footer_height;
            if ($('.header-position-absolute')[0]) {
                header_height = 0;
            }
            else {
                header_height = $('#header').outerHeight();
            }
            if ($('.rit-footer-sticky')[0]) {
                footer_height = 0;
            }
            else {
                footer_height = $('#footer-page').outerHeight();
            }
            $('#main-page').css('min-height', parseInt(window_height - footer_height - header_height) + 'px')
        }).resize();
    }

    function Animation() {
        $('[data-animation]').each(function () {
            $(this).css('opacity', '0');
        })
        jQuery(window).bind("scroll", function () {
            $('[data-animation]').each(function () {
                var classitem;
                if ($(this).ActiveScreen()) {
                    classitem = $(this).attr('data-animation');
                    $(this).addClass(' animated ' + classitem);
                    $(this).css('opacity', '1');
                }
            });
        })
    }

    jQuery.fn.extend({
        ActiveScreen: function () {
            var itemtop, windowH, scrolltop;
            itemtop = $(this).offset().top;
            windowH = $(window).height();
            scrolltop = $(window).scrollTop();
            if (itemtop < scrolltop + windowH * 2 / 3) {
                return true;
            }
            else {
                return false;
            }
        }
    });
    function MobileNav() {
        $('.wrap-mobile-nav:not(.lightbox) li:has("ul")>a').after('<span class="triggernav"><i class="clever-icon-plus"></i></span>');
        toggleMobileNav('.triggernav', '.wrap-mobile-nav:not(.lightbox) ul li ul');
        $(document).on('click', '#menu-mobile-trigger', function () {
            $(this).toggleClass('active');
            $('.wrap-body-content').toggleClass('menu-active');
            $('.wrap-mobile-nav').toggleClass('active');
            $('body').toggleClass('menu-active');
        });
        $(document).on("click", '#close-nav, .wrap-body-content.menu-active', function () {
            $('.wrap-mobile-nav').removeClass('active');
            $('.wrap-body-content').removeClass('menu-active');
            $('#menu-mobile-trigger').removeClass('active');
            $('body').removeClass('menu-active');
        });
    }

    function toggleMobileNav(trigger, target) {
        jQuery(target).each(function () {
            jQuery(this).attr('data-h', jQuery(this).outerHeight());
        });
        jQuery(target).addClass('unvisible');
        var h;
        var parent;
        jQuery(trigger).on("click", function () {
            h = 0;
            jQuery(this).prev('a').toggleClass('active');
            jQuery(this).toggleClass('active');
            jQuery.this = jQuery(this).next(target);
            if (jQuery.this.hasClass('unvisible')) {
                //Get height of this item
                if (jQuery.this.has("ul").length > 0) {
                    h = parseInt(jQuery.this.attr('data-h')) - parseInt(jQuery.this.find(target).attr('data-h'));
                }
                else {
                    h = parseInt(jQuery.this.attr('data-h'));
                }
                //resize for parent
                jQuery.this.parents(target).each(function () {
                    jQuery(this).css('height', jQuery(this).outerHeight() + h);
                })
                //set height for this item
                jQuery.this.css('height', h + "px");
            }
            else {
                jQuery.this.find(target).not(':has(.unvisible)').addClass('unvisible');
                //resize for parent when this item hide
                h = jQuery.this.outerHeight();
                jQuery.this.parents(target).each(function () {
                    jQuery(this).css('height', jQuery(this).outerHeight() - h);
                })
            }
            jQuery.this.toggleClass('unvisible');
        });
    }

    $(window).on('load', function () {
        //Rerun isotope for album
        if ($('.rit-album-masonry-block .envira-gallery-1-columns')[0]) {
            $(window).resize(function () {
                $('.rit-album-masonry-block .envira-gallery-1-columns ').each(function () {
                    var itemwidth = $('.rit-album-masonry-block .envira-gallery-wrap').width() / $('.rit-album-masonry-block').data('columns');
                    var data_w;
                    if ($(window).width() > 768) {
                        $(".rit-album-masonry-block .envira-gallery-1-columns.envira-album-wrap .envira-gallery-item").each(function () {
                            if (!$(this).data("w")) {
                                data_w = Math.floor(jQuery(this).outerWidth(true) / itemwidth);
                                $(this).attr('data-w', data_w == 0 ? '1' : data_w);
                            }
                            $(this).outerWidth($(this).data("w") * itemwidth);
                        });
                    }
                    else {
                        $(".rit-album-masonry-block  .envira-gallery-1-columns.envira-album-wrap .envira-gallery-item").width('100%');
                    }
                    setTimeout(function () {
                        $('.rit-album-masonry-block .envira-gallery-1-columns.envira-gallery-public ').isotope({
                                masonry: {
                                    columnWidth: itemwidth
                                }
                            }
                        );
                    }, 500)
                })
            }).resize();
        }
    });

    $('.photo-grid i.deploy').click(function(event) {
      $(this).closest('article.photo').addClass('show-full');
    });
    $('.photo-grid i.close').click(function(event) {
      $(this).closest('article.photo').removeClass('show-full');
    });
})
(jQuery)