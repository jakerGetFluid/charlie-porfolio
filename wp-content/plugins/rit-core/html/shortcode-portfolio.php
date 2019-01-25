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
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
$catid = array();
if ($atts['cat']) {
    foreach (explode(',', $atts['cat']) as $catslug) {
        $catid[] .= get_term_by('slug', $catslug, 'portfolio_category')->term_id;
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
if (!isset($atts['paged'])) {
    $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
} else {
    $args['paged'] = $atts['paged'];
}
$class = '';
if($atts['keep_size']=='yes') {
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
}
if ($atts['cat'] == '')
    $terms = get_terms('portfolio_category', '');
else {
    if (count($catid) > 0) {
        foreach ($catid as $id) {
            $terms[] = get_term($id, 'portfolio_category');
        }
    }
}
$the_query = new WP_Query($args);
$i = 0;
$wrapID = 'portfolio-block-' . rit_random_ID();
$padding = $atts['space_width'] / 2;
?>
<div id="<?php echo esc_attr($wrapID) ?>" class="rit-portfolio"
     data-config='{"id":"<?php echo esc_attr($wrapID) ?>","columns":"<?php echo esc_attr($atts['columns']) ?>"}'>
    <?php
    if ($atts['title'] != '') {
        ?>
        <h2 class="title-block">
            <?php echo esc_html($atts['title']) ?>
        </h2>
        <?php
    }
    if ($the_query->have_posts()):
        if (!empty($terms) && !is_wp_error($terms)): ?>
            <div class="wrap-portfolio-filter">
                <ul id="portfolio-filter" class="primary-font col-xs-12">
                    <?php if (count($terms) > 1) : ?>
                        <li class="active" data-id="all"><span><?php echo esc_html__('All', 'ri-fusion') ?></span></li>
                        <?php foreach ($terms as $term) : ?>
                            <li data-id="<?php echo esc_attr($term->slug) ?>">
                                <span><?php echo esc_html($term->name); ?></span></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; //Filter
        ?>
        <?php if ($padding != 0) { ?>
        <div style="margin:0 <?php echo esc_attr('-' . $padding - 1) ?>px"><?php } ?>
        <div class="wrap-portfolio-block-item ">
            <?php
            while ($the_query->have_posts()): $the_query->the_post();
                //get list catslug
                $catslug = 'all ';
                $termspost = get_the_terms(get_the_ID(), 'portfolio_category');
                if ($termspost && !is_wp_error($termspost)) :
                    foreach ($termspost as $term) :
                        $catslug .= $term->slug . ' ';
                    endforeach;
                endif;
                $class .= ' portfolio-item ';
                ?>
                <article id="portfolio-<?php esc_attr(the_ID()); ?>" <?php echo post_class($class . $catslug); ?>
                         style="padding:<?php echo esc_attr($padding) ?>px">
                    <div class="wrap-portfolio-item">
                        <a href="<?php the_permalink(); ?>"
                           title="<?php the_title(); ?>" class="mask-link"></a>
                        <div class="wrap-portfolio-img"><a href="<?php the_permalink(); ?>"
                                                           title="<?php the_title(); ?>">
                                <?php the_post_thumbnail($atts['img_size']); ?>
                            </a>
                        </div>
                        <div class="portfolio-info">
                            <h3 class="title title-post"><a href="<?php the_permalink(); ?>"
                                                            title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php if (!empty($atts['show_date'])) { ?>
                                <span class="post-date"><?php echo esc_html(get_the_date('M, Y')); ?></span>
                            <?php }
                            if (!empty($atts['show_cat'])) { ?>
                                <div
                                    class="list-cat body-font"><?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '', '', ''); ?></div>
                            <?php }
                            if (!empty($atts['view_more'])) { ?>
                                <a href="<?php the_permalink(); ?>" class="btn-readmore btn rit-button-accent"
                                   title="<?php the_title(); ?>"> <?php echo esc_html($atts['view_more_text']) ?> </a>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            <?php endwhile;
            ?>
        </div>
        <?php if ($padding != 0) { ?> </div><?php }
        if ($atts['pagination'] == 'standard') :
            if (function_exists("rit_pagination")) :
                echo '<div class="wrap-pagination">';
                rit_pagination(3, $the_query, '', esc_html__('Previous', 'ri-fusion'), esc_html__('Next', 'ri-fusion'));
                echo '</div>';
            endif;
        elseif ($atts['pagination'] == 'ajax'):
            echo '<div class="wrap-pagination">';
            //file name shortcode - Attributes of shortcode - Query shortcode - Wrap block - Wrap content - Isotope true/false
            rit_ajax_load_more(basename(__FILE__, ".php"), $atts, $the_query, '.rit-portfolio', '.wrap-portfolio-block-item', true);
            echo '</div>';
        elseif ($atts['pagination'] == 'infinite-scroll'):
            echo '<div class="wrap-pagination">';
            //Query shortcode - Wrap block - shortcode item - Isotope true/false
            rit_infinity_scroll($the_query, '#' . $wrapID, '.portfolio-item', true);
            echo '</div>';
        endif;
        wp_enqueue_script('isotope');
        wp_enqueue_script('ri-fusion-portfolio-js');
    endif;
    wp_reset_postdata(); ?>
</div>
