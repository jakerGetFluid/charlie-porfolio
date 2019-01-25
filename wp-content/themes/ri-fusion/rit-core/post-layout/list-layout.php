<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.3
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */
?>

<article id="<?php echo get_post_type() . '-' . get_the_ID(); ?>"  <?php echo post_class('rit-blog-item list-item row ')?>  <?php if ($atts['animation_type'] != '') { ?> data-animation="<?php echo esc_attr($atts['animation_type']) ?>"<?php } ?>>
    <div class="col-sm-4 col-xs-12">
    <?php echo rit_get_template_part('post-layout/media', 'block', array('atts' => $atts)) ?>
    </div>
    <div class="rit-post-inner  col-sm-8 col-xs-12">
        <?php
        the_title(sprintf('<h3 class="entry-title title-post"><a href="%s" rel="' . esc_html__('bookmark', 'ri-fusion') . '">', esc_url(get_permalink())), '</a></h3>');
        if ($atts['post_info']) {
            ?>
            <div class="post-info">
                <?php echo get_the_term_list(get_the_ID(), 'category', '<span class="list-cat">', ', ', '</span> /'); ?>
                <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
            </div>
        <?php }
        if ($atts['output_type'] != 'no') {
            ?>
            <div class="entry-content">
                <?php
                if ($atts['output_type'] == 'excerpt') {
                    echo rit_excerpt($atts['excerpt_length']);
                } else {
                    the_content();
                }
                ?>
            </div>
            <?php
        }
        if ($atts['view_more'] == 'yes') {
            ?>
            <span class="readmore">
            <a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html(__('Read more', 'ri-fusion')); ?></a>
        </span>
        <?php } ?>
    </div>

</article>