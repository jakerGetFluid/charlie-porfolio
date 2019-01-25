<?php
/**
 * The template for displaying Image for Single Gallery format.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
$clever_lightbox = '';
$clever_settings = clever_portfolio_get_settings();
if (isset($clever_settings["single_enable_lightbox"])) {
    if ($clever_settings["single_enable_lightbox"] == 1) {
        $clever_lightbox = 'clever-lightbox-gallery';
    }
}
$clever_meta = clever_portfolio_single_meta();
?>
<ul class="cp-wrap-imgs <?php echo esc_attr($clever_lightbox) ?>">
    <?php if (has_post_thumbnail()) :
        $clever_thumb_url = '#';
        $clever_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
        if ($clever_thumb) {
            $clever_thumb_url = $clever_thumb[0];
            ?>
            <li class="portfolio-img">
                <a href="<?php echo esc_url($clever_thumb_url) ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            </li>
        <?php } endif;
    if (count($clever_meta['galleries']) > 0) {
        foreach ($clever_meta['galleries'] as $img) {
            $item = wp_get_attachment_image_src($img, 'full');
            if ($item) {
                $clever_img_url = $item[0];
                $clever_width = $item[1];
                $clever_height = $item[2];
                $clever_img_title = get_the_title($img);
                $clever_resolution = $clever_width / $clever_height;
                ?>
                <li class="portfolio-img">
                    <a href="<?php echo esc_url($clever_img_url) ?>" class="clever_wrap_lazy_img"
                       title="<?php echo esc_attr($clever_img_title); ?>"
                       style="width:<?php echo esc_attr($clever_width) ?>px"
                       data-resolution="<?php echo esc_attr($clever_resolution) ?>">
                        <img src="" height="<?php echo esc_attr($clever_height) ?>"
                             width="<?php echo esc_attr($clever_width) ?>" class="lazy-img"
                             data-original="<?php echo esc_attr($clever_img_url) ?>"
                             alt="<?php echo esc_attr($clever_img_title); ?>"/>
                    </a>
                </li>
                <?php
            }
        }
    }
    ?>
</ul>
