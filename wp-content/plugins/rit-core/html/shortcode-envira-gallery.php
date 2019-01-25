<?php
$rit_layout = get_post_meta($atts['shortcode'], 'rit_gallery_layout', true);
if ($rit_layout == 'default' || $rit_layout == '') {
    $rit_layout = get_theme_mod('rit_gallery_layout', 'grid');
}
$rit_largewidth = '';
if (get_post_meta($atts['shortcode'], 'rit_enable_large_width', true) == '1') {
    $rit_largewidth = 'largewidth';
} elseif (get_theme_mod('rit_enable_large_width', '1') == '1') {
    $rit_largewidth = 'largewidth';
}
?>
<div class="rit-envira-gallery-shortcode <?php echo esc_attr('gallery-' . $rit_layout . '-layout') ?>">
    <div class="container <?php echo esc_attr($rit_largewidth) ?>">
        <div id="detail-gallery" class="content-single">
            <?php
            echo rit_get_template_part('gallery/gallery', $rit_layout, array('atts' => $atts));
            ?>
        </div>
    </div>
</div>

