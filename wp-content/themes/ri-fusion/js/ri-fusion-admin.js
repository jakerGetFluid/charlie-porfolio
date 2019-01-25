(function ($) {
    'use strict';
    jQuery(document).ready(function () {
        function media_upload(button_class) {
            var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;

            $('body').on('click', button_class, function (e) {
                var button_id = '#' + $(this).attr('id');
                var wrapper_id = '#' + $(this).parent('p').attr('id');
                console.log(wrapper_id);
                var self = $(button_id);
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(button_id);
                var id = button.attr('id').replace('_button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function (props, attachment) {
                    if (_custom_media) {
                        $(wrapper_id).find('.custom_media_url').val(attachment.url);
                        $(wrapper_id).find('.custom_media_image').attr('src', attachment.url).css('display', 'block');
                    } else {
                        return _orig_send_attachment.apply(button_id, [props, attachment]);
                    }
                }
                wp.media.editor.open(button);
                return false;
            });
        }

        media_upload('.custom_media_button.button');

        $(".ri_category_thumb_upload .btn").click(function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            var _custom_media = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_custom_media) {
                    var select_url = attachment.url;
                    if (props.size) {
                        var image_link = button.parent().children(".txt");
                        $(image_link).val(select_url);
                        $('.ri_category_thumb_upload img').attr('src',select_url);
                    }
                } else {
                    return send_attachment_bkp.apply(this, [props, attachment]);
                }
                ;

            }
            // Open wp media editor without select multiple media option
            wp.media.editor.open(button, {
                multiple: false
            });
        });
        // Remove url link image
       $('#advanced-sortables').prepend('<ul id="rit-wrap-tabs"></ul>');
        $('#advanced-sortables .postbox:visible').each(function () {
            $('#rit-wrap-tabs').append('<li><a href="#'+$(this).attr("id")+'">'+$(this).find('.ui-sortable-handle span').html()+'</a></li>');
        });
        $(function() {
            $("#advanced-sortables").tabs();
        });

    })
})(jQuery)