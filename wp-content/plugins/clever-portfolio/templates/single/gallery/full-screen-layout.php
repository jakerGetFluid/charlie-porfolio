<?php
/**
 * The template displaying content single portfolio format Gallery with layout Full Screen.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
$clever_meta = clever_portfolio_single_meta();
?>
<ul class="wrap-portfolio-imgs cp-wrap-slider">
    <?php if (has_post_thumbnail()) :
        ?>
        <li class="portfolio-img"
            style="background-image: url('<?php echo esc_url(the_post_thumbnail_url('full')); ?>')">
        </li>
    <?php endif;
    if (count($clever_meta['galleries']) > 0) {
        foreach ($clever_meta['galleries'] as $img) {
            $clever_the_image = wp_get_attachment_image_src($img, 'full');
            if($clever_the_image) {
                ?>
                <li class="portfolio-img" style="background-image: url('<?php echo esc_url($clever_the_image[0]); ?>')">
                </li>
                <?php
            }
        }
        ?>
        <?php
    }
    ?>
</ul>
<div class="cp-wrap-content expand" style="opacity: 0">
    <span class="toggle-view"><i class="cs-font clever-icon-contract"></i></span>
    <div class="cp-main-content">
        <?php
            the_title('<h1 class="title-portfolio">', '</h1>');
        ?>
        <div class="cp-content">
            <?php
            the_content();
            ?>
        </div>
        <?php
        clever_get_template_part('clever-portfolio', 'single/', 'infor', true); ?>
    </div>
    <?php
    clever_get_template_part('clever-portfolio', 'single/', 'pagination', true);
    ?>
</div>
<div class="cp-wrap-content minimal active">
    <span class="toggle-view"><i class="cs-font clever-icon-expand"></i></span>
    <?php
    the_title('<h2 class="title-portfolio">', '</h2>'); ?>
    <span
        class="date-post"><?php echo esc_html(date(get_option('date_format'), strtotime(get_post_meta(get_the_ID(), 'rit_date_complete_portfolio', true)))) ?></span>
</div>
