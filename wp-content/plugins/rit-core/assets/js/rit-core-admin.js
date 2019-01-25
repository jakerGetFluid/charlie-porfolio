(function ($) {
    "use strict";

    var RIT_Admin = {
        init: function() {
            this.metabox.tab();
        },
        megamenu: {
            select_image: function() {

            }
        },
        metabox: {
            element: '#postbox-container-2 #normal-sortables',
            tab: function() {
                /*
                var tab = '<ul id="rit-admin-tab-metabox">';
                $(this.element + ' > .postbox').each(function() {
                    tab +=  '<li><a href="#'+$(this).attr('id')+'">'+$(this).find('h3.ui-sortable-handle span').text()+'</a></li>';
                });
                tab += '</ul>';
                $(this.element).prepend(tab);
                $(this.element).tabs();
                */
            }
        }

    };


    $(document).ready(function() {

        RIT_Admin.init();

        var file_frame;

        jQuery('.button_upload_image').on( 'click', function( e ){

            e.preventDefault();

            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                file_frame.open();
                return;
            }
            
            var clickedID = jQuery(this).attr('id');    
            
            // Create the media frame.
            file_frame = wp.media.frames.downloadable_file = wp.media({
                title: 'Choose an image',
                button: {
                    text: 'Use image'
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();

                jQuery('#' + clickedID).val( attachment.url );
                if (jQuery('#' + clickedID).attr('data-name'))
                    jQuery('#' + clickedID).attr('name', jQuery('#' + clickedID).attr('data-name'));
            });

            // Finally, open the modal.
            file_frame.open();
        });

        jQuery('.button_remove_image').on( 'click', function( e ){
            
            var clickedID = jQuery(this).attr('id');
            jQuery('#' + clickedID).val( '' );

            return false;
        });

        $('.rit_mt_dependency *[data-dependency-key]').each(function () {
            var key=$(this).data('dependency-key');
            var val=$(this).data('dependency-val');
            if($('#'+key+' option:selected').val()!=val){
                $(this).parents('.rit_mt_dependency').hide()
            }
        })
        $('.rwmb-input>*').on('change',function () {
            var val=$(this).find('option:selected').val();
            var id=$(this).attr('id');
            $('.rit_mt_dependency *[data-dependency-key="'+id+'"]').each(function () {
                var val2=$(this).data('dependency-val');
                if(val2==val){
                    $(this).parents('.rit_mt_dependency').show()
                }else{
                    $(this).parents('.rit_mt_dependency').hide()
                }
            })
        })
    });
})(jQuery);