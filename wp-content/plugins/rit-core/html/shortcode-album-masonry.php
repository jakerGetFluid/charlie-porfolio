<?php
wp_enqueue_script( 'isotope' );
$wrapID = 'rit-album-masonry-' . rit_random_ID();
$css=$atts['css'];
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'rit_album_masonry', $atts );
?>
<div id="<?php echo esc_attr($wrapID)?>" class="rit-album-masonry-block <?php echo esc_attr($atts['el_class'].' '.$atts['style'].' '.$css_class);?>"
data-columns="<?php echo esc_attr($atts['columns'])?>" style="max-width:<?php echo esc_attr($atts['max_width']) ?>px">
<?php
echo do_shortcode(rawurldecode(base64_decode( strip_tags($atts['shortcode']))));
?>
</div>

