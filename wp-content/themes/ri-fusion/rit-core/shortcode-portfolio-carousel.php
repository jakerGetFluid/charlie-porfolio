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
wp_enqueue_script('slick');
wp_enqueue_script('ri-fusion-portfolio-carousel-js');
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
$catid = array();
if ($atts['cat']) {
    foreach (explode(',', $atts['cat']) as $catslug) {
        $terms = get_term_by('slug', $catslug, 'portfolio_category');
        if (!empty($terms) && !is_wp_error($terms)) {
            $catid[] .= $terms->term_id;
        }
    }
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio_category',
            'field' => 'id',
            'terms' => $catid,
        )
    );
}
if ($atts['post_in'] != '') {
    $args['post__in'] = explode(',', $atts['post_in']);
}
$args['orderby'] = $atts['order_by'];
$args['order'] = $atts['order'];
$class = '';
$the_query = new WP_Query($args);
$wrapID = 'portfolio-carousel-' . rit_random_ID();
?>
<div id="<?php echo esc_attr($wrapID) ?>"
     class="rit-portfolio rit-portfolio-carousel <?php echo esc_attr($atts['hover_style'] . ' ' . $atts['layer']) ?>"
     data-config='{"id":"<?php echo esc_attr($wrapID) ?>","columns":"<?php echo esc_attr($atts['columns']) ?>","show_arrow":"<?php echo esc_attr($atts['show_arrow']) ?>",
     "show_thumb":"<?php echo esc_attr($atts['show_thumb']) ?>","max_thumb":"<?php echo esc_attr($atts['max_thumb']) ?>",
     "show_pag":"<?php echo esc_attr($atts['show_pag']) ?>","table_col":"<?php echo esc_attr($atts['table_col']) ?>",
     "mobile_col":"<?php echo esc_attr($atts['mobile_col']) ?>","auto_play":"<?php echo esc_attr($atts['auto_play']) ?>","auto_play_speed":"<?php echo esc_attr($atts['auto_play_speed']) ?>"}'>
    <?php
    if ($the_query->have_posts()):?>
        <div class="wrap-portfolio-block-item ">
            <?php
            while ($the_query->have_posts()): $the_query->the_post();
                ?>
                <article id="portfolio-<?php esc_attr(the_ID()); ?>" <?php echo post_class('portfolio-item');
                if ($atts['layer'] != 'normal') {
                    ?>
                    style="background: url(<?php echo the_post_thumbnail_url($atts['img_size']); ?>) center center/cover"
                <?php } ?>
                >
                    <div class="wrap-portfolio-item">
                        <!--                        <a href="--><?php //the_permalink(); ?><!--"-->
                        <!--                           title="--><?php //the_title(); ?><!--" class="mask-link"></a>-->
                        <?php if ($atts['layer'] == 'normal') { ?>
                            <div class="wrap-portfolio-img"><a href="<?php the_permalink(); ?>"
                                                               title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail($atts['img_size']); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="portfolio-info">
                            <h3 class="title title-post"><a href="<?php the_permalink(); ?>"
                                                            title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php
                            if (!empty($atts['show_cat'])) { ?>
                                <div
                                    class="list-cat body-font"><?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '', '<span>-</span>', ''); ?></div>
                            <?php }
                            if (!empty($atts['view_more'])) { ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-around"
                                   title="<?php the_title(); ?>"> <?php echo esc_html($atts['view_more_text']) ?> </a>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            <?php endwhile;
            ?>
        </div>
        <?php
        if ($atts['show_thumb'] == 1) {
            ?>
            <div class="wrap-block-portfolio-thumbs ">
            <ul class="wrap-portfolio-thumbs">
                <?php
                while ($the_query->have_posts()): $the_query->the_post();
                    ?>
                    <li class="portfolio-<?php esc_attr(the_ID()); ?> portfolio-thumb">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </li>
                <?php endwhile;
                ?>
            </ul>
            </div>
        <?php }
    endif;
    wp_reset_postdata(); ?>
</div>
