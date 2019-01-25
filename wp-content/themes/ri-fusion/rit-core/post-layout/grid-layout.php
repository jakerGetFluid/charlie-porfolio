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
$class = 'rit-blog-item layout-item ';
switch ($atts['columns']) {
    case '2':
        $class .= "col-xs-12 col-sm-6";
        break;
    case '3':
        $class .= "col-xs-12 col-sm-4";
        break;
    case '4':
        $class .= "col-xs-12 col-sm-3";
        break;
    case '5':
        $class .= "col-xs-12 col-sm-1-5";
        break;
    case '6':
        $class .= "col-xs-12 col-sm-2";
        break;
    default:
        $class .= "col-xs-12 col-sm-12";
        break;
}
?>
<article
    id="<?php echo get_post_type() . '-' . get_the_ID(); ?>" <?php echo post_class($class) ?>  <?php if ($atts['animation_type'] != '') { ?> data-animation="<?php echo esc_attr($atts['animation_type']) ?>"<?php } ?>>
    <?php echo rit_get_template_part('post-layout/media', 'block', array('atts' => $atts)) ?>
    <div class="rit-post-inner">
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
        if ($atts['view_more'] == 'yes'){
            ?>
            <span class="readmore">
            <a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html__('Read more', 'ri-fusion'); ?></a>
        </span>
        <?php } ?>
    </div>

</article>