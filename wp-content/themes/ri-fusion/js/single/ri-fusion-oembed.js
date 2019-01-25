/**
 * Create for Portfolio detail with embed format
 * It's make full width media player
 */
(function ($) {
    'use strict';
    $(document).ready(function () {
        resizeVideo();
        var t;
        $('.portfolio-embed-format.full-screen .mask-full-screen').mousemove(function () {
            $('.wrap-portfolio-content.minimal.active').fadeIn();
            $('.rit-play').fadeIn();
            var lastTimeMouseMoved = new Date().getTime();
            clearTimeout(t);
            t = setTimeout(function () {
                var currentTime = new Date().getTime();
                if (currentTime - lastTimeMouseMoved > 900) {
                    $('.wrap-portfolio-content.minimal.active').fadeOut();
                    $('.rit-play').fadeOut();
                }
            }, 1000)
        });
        //Vimeo
        VimeoControl();
    });
    $(window).on('load',function () {
        if ($('.portfolio-embed-format.full-screen')[0]) {
            $('.wrap-portfolio-content.minimal').fadeOut();
            $('.rit-play').fadeOut();
        }
    });
    function VimeoControl() {
        if ($('.portfolio-embed-format.full-screen .vimeo-embed')[0]) {
            var player = new Vimeo.Player($('.portfolio-embed-format.full-screen .vimeo-embed'));
            player.play();
            player.setLoop(true);
            if( getCookie('rit-mute')){
                player.setVolume(0);
                $('.rit-volume').addClass('active');
            }
            $('.mask-full-screen').on('click', function () {
                $('.rit-play').toggleClass('active');
                if ($('.portfolio-embed-format.full-screen .vimeo-embed')[0]) {
                    player.getPaused().then(function (paused) {
                        if (!paused) {
                            player.pause();
                            $('.wrap-portfolio-content.minimal.active').fadeIn();
                            $('.rit-play').fadeIn();
                        } else {
                            player.play();
                        }
                    })
                }
            });
            $('.rit-volume').on('click', function () {
                $(this).toggleClass('active');
                if ($('.portfolio-embed-format.full-screen .vimeo-embed')[0]) {
                    player.getVolume().then(function (vol) {
                        if (vol > 0) {
                            player.setVolume(0);
                            setCookie('rit-mute',true)
                        } else {
                            player.setVolume(1);
                            setCookie('rit-mute',false)
                        }
                    })
                }
            })
        }
    }

    function resizeVideo() {
        // Find all YouTube videos
        var allVideos = $(".wrap-portfolio-embed:not(.audio-embed) iframe, .wrap-portfolio-embed embed");
// Figure out and save aspect ratio for each video
        allVideos.each(function () {
            $(this).data('aspectRatio', this.height / this.width)
            // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        });
// When the window is resized
        $(window).resize(function () {
            if ($('.portfolio-embed-format.full-width')[0]) {
                if ($(window).width() > 769) {
                    //For layout media full width
                    var height = parseInt($(window).height() * 80 / 100) - $('#header').height();
                    allVideos.each(function () {
                        var el = jQuery(this);
                        el.width(height / el.data('aspectRatio')).height(height);
                    });
                }
                else {
                    VideoFullWidth(allVideos);
                }
            }
            else if ($('.portfolio-embed-format.full-screen')[0]) {
                //For layout media full width
                var height = $(window).height();
                var width = $(window).width();
                $('.portfolio-embed-format.full-screen .wrap-portfolio-embed ').height(height).width(width);
                allVideos.each(function () {
                    var el = jQuery(this);
                    var item_h = width * el.data('aspectRatio');
                    var item_w;
                    if (item_h < height) {
                        item_w = height / el.data('aspectRatio');
                        if (item_w == width) {
                            el.width(width).height(item_h);
                        } else {
                            el.width(height / el.data('aspectRatio')).height(height);
                        }
                    } else {
                        item_w = height / el.data('aspectRatio');
                        if (item_w == width) {
                            el.width(width).height(item_h);
                        } else {
                            el.width(width).height(width * el.data('aspectRatio'));
                        }
                    }
                });
            }
            else {
                VideoFullWidth(allVideos);
            }
// Kick off one resize to fix all videos on page load
        }).resize();
        var AllAudio = $(".wrap-portfolio-embed.audio-embed iframe");
        AllAudio.removeAttr('width').attr('height', '160');
        AllAudio.width('100%');
    }

    function VideoFullWidth(allVideos) {
        var newWidth = jQuery(".wrap-portfolio-embed").width();
        // Resize all videos according to their own aspect ratio
        allVideos.each(function () {
            var el = jQuery(this);
            el.width(newWidth).height(newWidth * el.data('aspectRatio'));
        });
    }
})(jQuery);

var player;
// global variable for the player
function onYouTubePlayerAPIReady() {
    // create the global player from the specific iframe (#video)
    player = new YT.Player(jQuery('.portfolio-embed-format.full-screen .youtube-embed iframe').attr('id'), {
        events: {
            // call this function when player is ready to use
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}
function onPlayerReady(event) {
    // bind events
    player.playVideo();
    jQuery('.mask-full-screen').on('click', function () {
        jQuery('.rit-play').toggleClass('active');
        if (player.getPlayerState() == 1) {
            player.pauseVideo();
        }
        if (player.getPlayerState() == 2) {
            player.playVideo();
        }
    });
    jQuery('.rit-volume').on('click', function () {
        jQuery(this).toggleClass('active');
        if (player.isMuted()) {
            player.unMute();
            setCookie('rit-mute',false)
        } else {
            player.mute();
            setCookie('rit-mute',true);
        }
    })
   if(getCookie('rit-mute')){
       player.mute();
       $('.rit-volume').addClass('active');
   }
}
function onPlayerStateChange(event) {
    if (player.getPlayerState() == 0) {
        player.playVideo();
    }
}
function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue + "; ";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
