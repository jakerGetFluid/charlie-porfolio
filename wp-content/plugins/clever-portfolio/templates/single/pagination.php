<?php
/**
 * The template for displaying Pagination of Single portfolio.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */

$clever_prev_post = get_previous_post();
$clever_next_post = get_next_post();
?>
<div class="cp-single-pagination">
    <div class="row">
        <div class="prev-post col-xs-5 primary-font">
            <?php if (!empty($clever_prev_post)) : ?>
                <a href="<?php echo esc_url(get_permalink($clever_prev_post->ID)); ?>"
                   title="<?php echo get_the_title($clever_prev_post->ID); ?>"><i
                        class="clever-icon-prev-arrow-1 cs-font"></i><span><?php echo get_the_title($clever_prev_post->ID); ?></span></a>
            <?php endif; ?>
        </div>
        <div class="col-xs-2 back-to-home">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
               title="<?php _e('Back to Home', 'clever-portfolio') ?>"><i class="cs-font clever-icon-grid"></i> </a>
        </div>
        <div class="next-post col-xs-5 primary-font">
            <?php if (!empty($clever_next_post)) : ?>
                <a href="<?php echo esc_url(get_permalink($clever_next_post->ID)); ?>"
                   title="<?php echo get_the_title($clever_next_post->ID); ?>">
                    <span><?php echo get_the_title($clever_next_post->ID); ?></span><i class="cs-font clever-icon-next-arrow-1"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>