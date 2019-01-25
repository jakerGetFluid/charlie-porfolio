<?php
/**
 * * The template for displaying content shortcode portfolio
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
if (!isset($atts)) {
    $atts = clever_portfolio_get_shortcode_meta($args['id']);
}
$cp_title = $args['title'];
$clever_layout = !empty($atts['layout']) ? $atts['layout'] : 'masonry';
//Get Data
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => !empty($atts['number']) ? intval($atts['number']) : get_option('posts_per_page')
);
$terms = array();
$catID = array();
if (!empty($atts['cat'])) {
    foreach ($atts['cat'] as $catslug) {
        $cat = get_term_by('slug', $catslug, 'portfolio_category');
        if ($cat) {
            $catID[] .= $cat->term_id;
        }
    }
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio_category',
            'field' => 'id',
            'terms' => $catID,
        )
    );
    if (count($catID) > 0) {
        foreach ($catID as $id) {
            $terms[] = get_term($id, 'portfolio_category');
        }
    }
} else {
    $terms = get_terms(array(
        'taxonomy' => 'portfolio_category',
        'hide_empty' => true
    ));
}
if (!empty($atts['post_in'])) {
    $args['post__in'] = explode(',', $atts['post_in']);
}
$args['orderby'] = $atts['order_by'];
$args['order'] = $atts['order'];
$atts['paged'] = !empty($atts['paged']) ? $atts['paged'] : get_query_var('paged', 1);
if (!isset($atts['paged'])) {
    $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
} else {
    $args['paged'] = $atts['paged'];
}
$the_query = new WP_Query($args);
//End Get Data
$wrapID = 'portfolio-block-' . uniqid();
$padding = !empty($atts['space_width']) ? ($atts['space_width'] / 2) : 0;
//Custom style
$cssID = '#' . $wrapID;
$custom_style = $cssID . ' .clever-portfolio-item{padding:' . $padding . 'px}';
$cp_cols = $atts['columns'];
$cp_wrap_class = 'clever-portfolio clever-portfolio-shortcode column-' . $cp_cols . ' cp-' . $clever_layout . '-layout ' . $atts['style'];
if ($clever_layout == 'grid' || $clever_layout == 'carousel') {
    $col_width = 100 / $cp_cols;
    $custom_style .= '@media(min-width:769px){' . $cssID . ' .clever-portfolio-item{width:' . $col_width . '%;}' . '}';
}
$cp_total=0;
if ($clever_layout == 'carousel') {
    $cp_rows = $atts['rows'];
    if ($cp_rows > 1) {
        $cp_items_rows = $cp_rows * $cp_cols;
        $cp_total = count($the_query->posts);
        $cp_wrap_class .= ' cp-multi-row';
    } else {
        $cp_wrap_class .= ' cp-single-row';
    }
}
clever_generate_custom_styles($custom_style);
?>
<div id="<?php echo esc_attr($wrapID) ?>"
     class="<?php echo esc_attr($cp_wrap_class); ?>"
     data-config='{"id":"<?php echo esc_attr($wrapID) ?>","columns":"<?php echo esc_attr($cp_rows > 1 ? '1' : $cp_cols) ?>"
     <?php if ($clever_layout == 'masonry') {
         ?>,"layout_mod":"<?php echo esc_attr($atts['layout_mode']) ?>"
     <?php } elseif ($clever_layout == 'grid') {
         ?>,"layout_mod":"fitRows"
     <?php }
     if ($clever_layout == 'carousel') {
         ?>,"columns_tablet":"<?php  echo esc_attr($atts['columns_tablet']) ?>","columns_mobile":"<?php  echo esc_attr($atts['columns_mobile']) ?>","carousel_layout":"<?php echo esc_attr($atts['carousel_size']); ?>","show_pag":"<?php echo esc_attr(isset($atts['show_cpag'])?$atts['show_cpag']:''); ?>","show_nav":"<?php echo esc_attr(isset($atts['show_cnav'])?$atts['show_cnav']:''); ?>","autoplay":"<?php echo esc_attr($atts['autoplay']); ?>"
     <?php
     }
     ?>
     }'>
    <?php
    if ($cp_title != '') {
        ?>
        <h3 class="cp-title-shortcode">
            <?php echo esc_html($cp_title); ?>
        </h3>
        <?php
    }
    if ($the_query->have_posts()):
    //Filter
    if (isset($atts['show_filter'])) {
        if (!empty($terms) && !is_wp_error($terms)): ?>
            <div class="wrap-portfolio-filter">
                <div class="cp-mobile-filter">
                    <span><?php echo esc_html__('All', 'ri-fusion') ?></span><i class="fa fa-angle-down"></i></div>
                <ul class="clever-portfolio-filter primary-font col-xs-12 <?php echo esc_attr(' text-' . $atts['filter_align']); ?>">
                    <?php if (count($terms) > 1) : ?>
                        <li class="active" data-id="all"><span><?php echo esc_html__('All', 'ri-explorer') ?></span>
                        </li>
                        <?php foreach ($terms as $term) : ?>
                            <li data-id="<?php echo esc_attr('cp-' . $term->term_id) ?>">
                                <span><?php echo esc_html($term->name); ?></span></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif;
    }//End Filter
    //Content
    if ($padding != 0) { ?>
    <div style="margin:0 <?php echo esc_attr('-' . $padding - 1) ?>px"><?php } ?>
        <div class="cp-wrap-block-item">
            <?php
            $i = 0;
            while ($the_query->have_posts()):
            $the_query->the_post();
            //get list catslug
            $catslug = 'clever-portfolio-item ';
            if (isset($atts['show_filter'])) {
                $catslug .= 'all ';
                $termspost = get_the_terms(get_the_ID(), 'portfolio_category');
                if ($termspost && !is_wp_error($termspost)) :
                    foreach ($termspost as $term) :
                        $catslug .= 'cp-' . $term->term_id . ' ';
                    endforeach;
                endif;
            }
            if ($clever_layout != 'carousel') {
                ?>
                <article id="portfolio-<?php esc_attr(the_ID()); ?>" <?php echo post_class($catslug); ?>>
                    <div class="wrap-portfolio-item">
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
                                <a href="<?php the_permalink(); ?>"
                                   class="btn-readmore btn <?php if ($atts['style'] == 'style-2') {
                                       echo esc_attr('btn-around');
                                   } ?>"
                                   title="<?php the_title(); ?>"> <?php echo esc_html($atts['view_more_text']) ?> </a>
                            <?php } ?>
                        </div>
                    </div>
                </article>
                <?php
            } else {
            if ($cp_rows > 1 && $i == 0) {
            ?>
        <div class="cp-carousel-row">
        <?php
        }
        $i++;
        ?>
        <article id="portfolio-<?php esc_attr(the_ID()); ?>" <?php echo post_class($catslug);
        if ($atts['carousel_size'] != 'auto') {
            ?>
            style="background: url(<?php echo the_post_thumbnail_url($atts['img_size']); ?>) center center/cover;<?php
            if ($atts['carousel_size'] == 'custom') { ?>
                    height:<?php echo esc_attr($atts['carousel_height'])?>px
                <?php
            }
            ?>"
        <?php } ?>>
            <div class="wrap-portfolio-item">
                <?php if ($atts['carousel_size'] == 'auto') { ?>
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
                    <?php if (!empty($atts['show_date'])) { ?>
                        <span class="post-date"><?php echo esc_html(get_the_date('M, Y')); ?></span>
                    <?php }
                    if (!empty($atts['show_cat'])) { ?>
                        <div
                                class="list-cat body-font"><?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '', '', ''); ?></div>
                    <?php }
                    if (!empty($atts['view_more'])) { ?>
                        <a href="<?php the_permalink(); ?>"
                           class="btn-readmore btn <?php if ($atts['style'] == 'style-2') {
                               echo esc_attr('btn-around');
                           } ?>"
                           title="<?php the_title(); ?>"> <?php echo esc_html($atts['view_more_text']) ?> </a>
                    <?php } ?>
                </div>
            </div>
        </article>
        <?php
        if (($cp_rows > 1 && ($i % $cp_items_rows == 0)) || $cp_total == $i) {
        ?>
        </div>
        <?php
        if ($cp_total != $i) {
        ?>
            <div class="cp-carousel-row">
                <?php
                }
                }
                }
                endwhile;
                ?>
            </div>
            <?php if ($padding) echo '</div>';
            //Content
            //Pagination Content
            if ($clever_layout != 'carousel') {
                $pagination_type = $atts['pagination'];
                $isotope = true;
                if ($pagination_type === 'standard' && $clever_layout != 'carousel') :
                    echo '<div class="clever-wrap-pagination default">';
                    clever_stardard_pagination($the_query, 3, '<i class="cs-font clever-icon-prev-arrow-1"></i>', '<i class="cs-font clever-icon-next-arrow-1"></i>');
                    echo '</div>';
                elseif ($pagination_type === 'infinite') :
                    echo '<div class="clever-wrap-pagination">';
                    clever_infinity_scroll_pagination($the_query, '#' . $wrapID, '.clever-portfolio-item', $isotope);
                    echo '</div>';
                elseif ($pagination_type === 'loadmore') :
                    echo '<div class="clever-wrap-pagination">';
                    clever_ajax_load_pagination(basename(__FILE__, ".php"), $atts, $the_query, '', '#' . $wrapID, '.cp-wrap-block-item', $isotope);
                    echo '</div>';
                endif;
            }
            //End Pagination Content
            //enqueue js, css
            wp_enqueue_style('clever-portfolio');
            if ($clever_layout != 'carousel') {
                wp_enqueue_script('isotope');
            } else {
                wp_enqueue_style('slick');
                wp_enqueue_style('slick-theme');
                wp_enqueue_script('slick');
            }
            wp_enqueue_script('clever-portfolio-js');
            endif;
            wp_reset_postdata(); ?>
        </div>
