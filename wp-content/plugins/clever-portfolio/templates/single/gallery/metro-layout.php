<?php
/**
 * The template displaying content single portfolio format Gallery  with layout Metro.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
$clever_meta=clever_portfolio_single_meta();
$clever_lightbox = '';
$clever_settings = clever_portfolio_get_settings();
if (isset($clever_settings["single_enable_lightbox"])) {
    if ($clever_settings["single_enable_lightbox"] == 1) {
        $clever_lightbox = 'clever-lightbox-gallery';
    }
}
?>
<div class="cp-wrap-content">
    <?php
        the_title('<h1 class="title-portfolio">', '</h1>');
    ?>
    <div class="cp-content">
        <?php
        the_content();
        ?>
    </div>
</div>
<div class="row">
    <ul class="cp-wrap-imgs <?php echo esc_attr($clever_lightbox)?>" data-col="<?php echo esc_attr($clever_meta['columns']);?>" data-width="<?php echo esc_attr($clever_settings['single_metro_width']);?>">
        <?php if (has_post_thumbnail()) :
            $clever_thumb_url = '#';
            if (wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()))) {
                $clever_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full')[0];
            }
            ?>
            <li class="portfolio-img">
                <a href="<?php echo esc_url($clever_thumb_url) ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            </li>
        <?php endif;
        if (count($clever_meta['galleries']) > 0) {
            foreach ($clever_meta['galleries'] as $img) {
                $item=wp_get_attachment_image_src($img,'full');
                if($item) {
                    $img_url = $item[0];
                    $width = $item[1];
                    $height = $item[2];
                    $img_title = get_the_title($img);
                    ?>
                    <li class="portfolio-img">
                        <a href="<?php echo esc_url($img_url) ?>" title="<?php echo esc_attr($img_title); ?>">
                            <img src="<?php echo esc_attr($img_url) ?>" height="<?php echo esc_attr($height) ?>"
                                 width="<?php echo esc_attr($width) ?>" alt="<?php echo esc_attr($img_title); ?>"/>
                        </a>
                    </li>
                    <?php
                }
            }
        }
        ?>
    </ul>
</div>
<?php
clever_get_template_part('clever-portfolio', 'single/', 'infor', true);
clever_get_template_part('clever-portfolio', 'single/', 'pagination', true);
//Js load
wp_enqueue_script('isotope');
wp_enqueue_script('imagesloaded');
