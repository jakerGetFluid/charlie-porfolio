<?php
$wrapID = 'shortcode_blog_' . rit_random_ID();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
if ($atts['cat'] != '') {
    if ($atts['parent']) {
        $args['category_name'] = $atts['cat'];
    } else {
        $catid = array();
        foreach (explode(',', $atts['cat']) as $catslug) {
            $catid[] .= get_category_by_slug($catslug)->term_id;
        }
        $args['category__in'] = $catid;
    }
}
if ($atts['post_in'] != '')
    $args['post_in'] = $atts['post_in'];
if (!isset($atts['paged'])) {
    $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
} else {
    $args['paged'] = $atts['paged'];
}
$the_query = new WP_Query($args);
$layout = $atts['layout'];
$wrapClass = $atts['el_class'];
$wrapClass .= ' rit-blog-shortcode';
$layout_item = $layout;
if ($layout == 'masonry') {
    $wrapClass .= " rit-blog-masonry";
    wp_enqueue_script('isotope');
    $layout_item = 'grid';
}
if ($atts['animation_type'] != '' && $atts['animation_type'] != 'none') {
    wp_enqueue_script('animations');
}
?>
<div id="<?php echo esc_attr($wrapID); ?>" class="<?php echo esc_attr($wrapClass) ?>">
    <?php
    if ($atts['title'] != '') {
        ?>
        <h3 class="title-block"><?php echo esc_html($atts['title']) ?> </h3>
        <?php
    }
    if ($the_query->have_posts()):
        ?>
        <div class="wrap-rit-blog <?php if ($layout != 'list') {
            echo esc_attr('layout-' . $atts['columns'] . '-col rit-blog-grid-layout row');
        } ?>">
            <?php
            while ($the_query->have_posts()): $the_query->the_post();
                echo rit_get_template_part('post-layout/' . $layout_item, 'layout', array('atts' => $atts));
            endwhile;
            ?>
        </div>
        <?php
        //paging
        if ($atts['pagination'] == 'standard') :
            if (function_exists("rit_pagination")) :
                echo '<div class="wrap-pagination">';
                rit_pagination(3, $the_query, '', esc_html__('Previous', 'ri-fusion'), esc_html__('Next', 'ri-fusion'));
                echo '</div>';
            endif;
        elseif ($atts['pagination'] == 'ajax'):
            echo '<div class="wrap-pagination">';
            //file name shortcode - Attributes of shortcode - Query shortcode - Wrap block - Wrap content - Isotope true/false
            if ($layout == 'masonry') {
                rit_ajax_load_more(basename(__FILE__, ".php"), $atts, $the_query, '.rit-blog-shortcode', '.rit-blog-grid-layout', true);
            } else {
                rit_ajax_load_more(basename(__FILE__, ".php"), $atts, $the_query, '.rit-blog-shortcode', '.rit-blog-grid-layout', false);
            }
            echo '</div>';
        elseif ($atts['pagination'] == 'infinite-scroll'):
            echo '<div class="wrap-pagination">';
            //Query shortcode - Wrap block - shortcode item - Isotope true/false
            if ($layout == 'masonry') {
                rit_infinity_scroll($the_query, '#' . $wrapID, '.rit-blog-item', true);
            } else {
                rit_infinity_scroll($the_query, '#' . $wrapID, '.rit-blog-item', true);
            }
            echo '</div>';
        endif;
        //end paging
    endif;
    wp_reset_postdata();
    ?>
</div>
