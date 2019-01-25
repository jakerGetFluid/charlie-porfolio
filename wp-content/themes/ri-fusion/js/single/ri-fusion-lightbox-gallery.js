(function ($) {
    'use strict';
    $('document').ready(function () {
        if ($('.rit-lightbox-gallery')[0]) {
            var index, total;
            total = $('.rit-lightbox-gallery').children().length;
            //Make lightbox gallery when click
            $('.rit-lightbox-gallery a').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                index = $(this).parent().index();
                if (!$('.rit-wrap-lightbox-gallery')[0]) {
                    $('body').append('<div class="rit-wrap-lightbox-gallery active"><div class="rit-wrap-lightbox-gallery-block"><ul class="rit-lightbox-gallery-block"></ul></div><div class="mask-close"></div><span class="rit-lb-close"><i class="clever-icon-close"></i> </span> </div> ');
                    for (var i = 0; i < total; i++) {
                        $('.rit-lightbox-gallery-block').append('<li class="rit-lightbox-gallery-item"></li>');
                    }
                    if (total > 1) {
                        $('.rit-wrap-lightbox-gallery-block').prepend('<span class="rit-lb-gallery-nav rit-lb-prev-item"><i class="clever-icon-prev-arrow-1"></i> </span> <span class="rit-lb-gallery-nav rit-lb-next-item"><i class="clever-icon-next-arrow-1"></i></span>')
                    }
                    $('.rit-lightbox-gallery-item:nth-child(' + parseInt(index + 1) + ')').addClass('active').append('<img src="' + $this.attr('href') + '" alt="' + $this.attr('title') + '" />');
                    $('.rit-wrap-lightbox-gallery-block').append('<div class="rit-lb-gallery-count"><span class="current-item">' + parseInt(index + 1) + '</span>/<span>' + total + '</span></div>')
                } else {
                    var item = $('.rit-lightbox-gallery-item:nth-child(' + parseInt(index + 1) + ')');
                    $('.rit-wrap-lightbox-gallery').addClass('active');
                    $('.rit-lightbox-gallery-item').removeClass('active');
                    item.addClass('active');
                    if (!item.has('img')[0]) {
                        item.append('<img src="' + $this.attr('href') + '" alt="' + $this.attr('title') + '" />');
                    }
                    $('.rit-lb-gallery-count .current-item').text(index + 1);
                }

                PreloadingImgs($this);
            });
            //lightbox gallery nav
            $('.mask-close').live('click', function () {
                $('.rit-wrap-lightbox-gallery').removeClass('active');
            });
            //Navigation control
            $('.rit-lb-gallery-nav').live('click', function () {
                if ($(this).hasClass('rit-lb-next-item')) {
                    NextItem();
                } else {
                    PrevItem();
                }
            });
            //Key press control
            $(document).keyup(function (e) {
                //Next
                if (e.keyCode === 39 || e.keyCode === 40) {
                    NextItem();
                }
                //Prev
                if (e.keyCode === 37 || e.keyCode === 38) {
                    PrevItem();
                }
                //Close when press Esc
                if (e.keyCode === 27) {
                    $('.rit-wrap-lightbox-gallery').removeClass('active');
                }
            });
            //Mouse control
            var mousepos_old;
            $('.rit-wrap-lightbox-gallery-block').live('mousedown', function (e) {
                mousepos_old = e.pageX;
            });
            $('.rit-wrap-lightbox-gallery-block').live('mouseup', function (e) {
                if (parseInt(mousepos_old - e.pageX) != 0) {
                    if (parseInt(mousepos_old - e.pageX) > 0) {
                        NextItem();
                    } else {
                        PrevItem();
                    }
                }
            });
        }
        function NextItem() {
            var $this = $('.rit-lightbox-gallery-item.active');
            var index;
            if ($this.next('li').length) {
                $this.next('li').addClass('active');
                //+1 item
                index = $this.index() + 1;
            } else {
                $('.rit-lightbox-gallery-item:first-child').addClass('active');
                index = 0;
                if (!$('.rit-lightbox-gallery-item:first-child').has('img')[0]) {
                    var $item = $('.rit-lightbox-gallery').children().eq(0);
                    $('.rit-lightbox-gallery-item:first-child').append('<img src="' + $item.find('a').attr('href') + '" alt="' + $item.find('a').attr('title') + '" />');
                }
            }
            var preload = $('.rit-lightbox-gallery').children().eq(index).find('a');
            $('.rit-lb-gallery-count .current-item').text(index + 1);
            $this.removeClass('active');
            PreloadingImgs(preload);
        }

        function PrevItem() {
            var $this = $('.rit-lightbox-gallery-item.active');
            var index;
            if ($this.prev('li').length) {
                $this.prev('li').addClass('active');
                //decrease 1 item
                index = $this.index() - 1;
            } else {
                $('.rit-lightbox-gallery-item:last-child').addClass('active');
                index = parseInt(total - 1);
                if (!$('.rit-lightbox-gallery-item:last-child').has('img')[0]) {
                    var $item = $('.rit-lightbox-gallery').children().eq(parseInt(total - 1));
                    $('.rit-lightbox-gallery-item:last-child').append('<img src="' + $item.find('a').attr('href') + '" alt="' + $item.find('a').attr('title') + '" />');
                }
            }
            var preload = $('.rit-lightbox-gallery').children().eq(index).find('a');
            $('.rit-lb-gallery-count .current-item').text(index + 1);
            $this.removeClass('active');
            PreloadingImgs(preload);
        }

        function PreloadingImgs(item) {
            var $this = item;
            $('.rit-lightbox-gallery-item.active').imagesLoaded(function () {
                Imgsize($('.rit-lightbox-gallery-item.active img').attr('src'));
                if ($('.rit-lightbox-gallery-item.active').next('li').length && !$('.rit-lightbox-gallery-item.active').next('li').has('img')[0]) {
                    $('.rit-lightbox-gallery-item.active').next('li').append('<img src="' + $this.parent().next().find('a').attr('href') + '" alt="' + $this.parent().next().find('a').attr('title') + '" />');
                }
                if ($('.rit-lightbox-gallery-item.active').prev('li').length && !$('.rit-lightbox-gallery-item.active').prev('li').has('img')[0]) {
                    $('.rit-lightbox-gallery-item.active').prev('li').append('<img src="' + $this.parent().prev().find('a').attr('href') + '" alt="' + $this.parent().prev().find('a').attr('title') + '" />');
                }
            });
        }

        //Resize light box window
        function Imgsize(url) {
            var wrap = $('.rit-wrap-lightbox-gallery-block');
            var res, item_w, item_h, max_w, max_h;
            max_w = $(window).width() * 0.9;
            max_h = $(window).height() * 0.9;
            $("<img>").attr("src", url).load(function () {
                res = this.height / this.width;
                if (this.height > max_h) {
                    item_h = max_h;
                    item_w = max_h / res;
                } else {
                    item_h = this.height;
                    item_w = item_h / res;
                }
                if (item_w > max_w) {
                    item_w = max_w;
                    item_h = max_w * res;
                }
                wrap.height(item_h);
                wrap.width(item_w);
            });
        }
    })
})(jQuery)