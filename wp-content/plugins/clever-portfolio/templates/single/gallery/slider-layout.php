<?php
/**
 * The template displaying content single portfolio format Gallery with layout Slider.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('slick');

$clever_meta=clever_portfolio_single_meta();
$clever_settings=clever_portfolio_get_settings();
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
    <ul class="cp-wrap-imgs cp-slider <?php if($clever_settings['single_enable_thumb']!=1) {echo esc_attr('no-thumb');}?>">
        <?php if (has_post_thumbnail()) :
            ?>
            <li class="portfolio-img">
                <img src="<?php echo esc_url(the_post_thumbnail_url('full')); ?>"/>
            </li>
        <?php endif;
        if (count($clever_meta['galleries']) > 0) {
            foreach ($clever_meta['galleries'] as $img) {
                $item=wp_get_attachment_image_src($img,'full');
                $img_url=$item[0];
                $width=$item[1];
                $height=$item[2];
                $img_title= get_the_title( $img);
                ?>
                <li class="portfolio-img">
                    <img src="<?php echo esc_attr($img_url) ?>" height="<?php echo esc_attr($height)?>" width="<?php echo esc_attr($width)?>"  alt="<?php echo esc_attr($img_title); ?>"/>
                </li>
                <?php
            }
        }
        ?>
    </ul>
<?php
if($clever_settings['single_enable_thumb']==1) {
    ?>
    <ul class="cp-wrap-thumbs">
        <?php if (has_post_thumbnail()) :
            ?>
            <li>
                <img src="<?php echo esc_url(the_post_thumbnail_url('thumbnail')); ?>"/>
            </li>
        <?php endif;
        if (count($clever_meta['galleries']) > 0) {
            foreach ($clever_meta['galleries'] as $img) {
                $item=wp_get_attachment_image_src($img,'thumbnail');
                $img_url=$item[0];
                $width=$item[1];
                $height=$item[2];
                $img_title= get_the_title( $img);
                ?>
                <li>
                    <img src="<?php echo esc_attr($img_url) ?>" height="<?php echo esc_attr($height)?>" width="<?php echo esc_attr($width)?>"  alt="<?php echo esc_attr($img_title); ?>"/>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <?php
}
 clever_get_template_part('clever-portfolio', 'single/', 'infor', true); ?>
<?php
clever_get_template_part('clever-portfolio', 'single/', 'pagination', true);
?>