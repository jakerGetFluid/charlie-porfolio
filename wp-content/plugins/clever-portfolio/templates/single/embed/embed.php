<?php
/**
 * The template displaying Video/audio content for portfolio.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
//Class for embed type(url)
$clever_meta = clever_portfolio_single_meta();
$clever_url = $clever_meta['oembed_url'];
$clever_parse_url = parse_url($clever_url);
switch ($clever_parse_url['host']) {
    case 'soundcloud.com':
        $clever_class = 'audio-embed';
        break;
    case 'vimeo.com':
        $clever_class = 'vimeo-embed';
        break;
    case 'youtube.com':
        $clever_class = 'youtube-embed';
        break;
    case 'www.youtube.com':
        $clever_class = 'youtube-embed';
        break;
    default:
        $clever_class = '';
}
//End Class for embed type(url)
$clever_layout = $clever_meta['embed_layout'];
if ($clever_layout == '' || $clever_layout == 'inherit') {
    $clever_settings = clever_portfolio_get_settings();
    $clever_layout = $clever_settings['single_embed_layout'];;
}
if ($clever_layout == 'full-width') {
    $clever_prev_post = get_previous_post();
    $clever_next_post = get_next_post();
}
?>
<div class="cp-wrap-embed <?php echo esc_attr($clever_class) ?>">
    <?php if (!empty($clever_prev_post)) : ?>
        <a href="<?php echo esc_url(get_permalink($clever_prev_post->ID)); ?>" class="cp-embed-nav prev-item"
           title="<?php echo get_the_title($clever_prev_post->ID); ?>"><i
                class="cs-font clever-icon-arrow-left"></i></a>
    <?php endif; ?>
    <?php
    if ($clever_url != '') {
        echo wp_oembed_get($clever_url, array('id' => 'cp-embed-iframe'));
    } else {
        if (has_post_thumbnail()) {
            $clever_thumb_url = '#';
            $clever_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
            if ($clever_thumb) {
                $clever_thumb_url = $clever_thumb[0];
            }
            ?>
            <a href="<?php echo esc_url($clever_thumb_url) ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                <?php the_post_thumbnail('full'); ?>
            </a>
        <?php }
    }
    ?>
    <?php if (!empty($clever_next_post)) : ?>
        <a href="<?php echo esc_url(get_permalink($clever_next_post->ID)); ?>" class="cp-embed-nav next-item"
           title="<?php echo get_the_title($clever_next_post->ID); ?>"><i class="cs-font clever-icon-arrow-right"></i>
        </a>
    <?php endif; ?>
</div>
