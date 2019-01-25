<?php
/**
 * * The template for displaying archive portfolio pages
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
get_header();

$clever_settings = clever_portfolio_get_settings();
$atts['paged'] = !empty($atts['paged']) ? $atts['paged'] : get_query_var('paged', 1);
$atts['taxonomy'] = !empty($atts['taxonomy']) ? $atts['taxonomy'] : get_query_var('portfolio_category');
if ( is_post_type_archive( 'portfolio' ) || $atts['taxonomy']=='') {
    $args=array(
        'post_type' => 'portfolio',
        'paged' => $atts['paged'],
        'posts_per_page' => !empty($clever_settings['archive_posts_per_page']) ? intval($clever_settings['archive_posts_per_page']) : get_option('posts_per_page')
    );
}else {
    $args = array(
        'post_type' => 'portfolio',
        'paged' => $atts['paged'],
        'posts_per_page' => !empty($clever_settings['archive_posts_per_page']) ? intval($clever_settings['archive_posts_per_page']) : get_option('posts_per_page'),
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => $atts['taxonomy'],
            ),
        )
    );
}
$the_query = new WP_Query($args);
$template = get_option('template');
$clever_layout = $clever_settings['archive_layout'];

// Pagination Settings
$pagination_type = $clever_settings['archive_paging_type'];
//Settings
$columns = intval($clever_settings['archive_columns_per_page']);
$portfolio_padding = $clever_settings['archive_portfolio_gutter'] / 2;

$clever_wrap_class= 'cp-'.$clever_layout.'-layout '.$clever_settings['archive_style'];
if(isset($clever_settings['archive_custom_style'])&&$clever_settings['archive_custom_style']==1) {
    $style = '.clever-portfolio-item{color:' . $clever_settings['archive_text_color'] . ';}';
    $style .= '.clever-portfolio .main-portfolio-info .title{color:' . $clever_settings['archive_title_color'] . ';}';
    $style .= '.clever-portfolio .main-portfolio-info .title:hover{color:' . $clever_settings['archive_title_hover'] . ';}';
    $style .= '.clever-portfolio .clever-portfolio-item .list-cat a{color:' . $clever_settings['archive_cat_text_color'] . ';}';
    $style .= '.clever-portfolio .clever-portfolio-item .list-cat a:hover{color:' . $clever_settings['archive_cat_color_hover'] . ';}';
    $style .= '.clever-portfolio .clever-portfolio-item .post-date{color:' . $clever_settings['archive_date_color'] . ';}';
    $style .= '.clever-portfolio .clever-portfolio-item .btn{color:' . $clever_settings['archive_button_text_color'] . ';background-color:' . $clever_settings['archive_button_background_color'] . ';}';
    $style .= '.clever-portfolio .clever-portfolio-item .btn:hover{color:' . $clever_settings['archive_hover_button_text_color'] . ';background-color:' . $clever_settings['archive_hover_button_background_color'] . ';}';
    $style .= '.clever-portfolio-item{background-color:' . $clever_settings['archive_background_color'] . ';}';
    $style .= '.clever-portfolio-item .mask-link{background-color:' . $clever_settings['archive_background_mask'] . ';}';
    clever_generate_custom_styles($style);
}
?>
    <main id="main-page" class="wrap-main-archive cp-main-archive <?php echo esc_attr($template) ?>">
        <div class="container">
            <div id="cp-archive"
                 class="clever-portfolio <?php echo esc_attr($clever_wrap_class); ?>"
                 <?php if($clever_layout!='list'){?>
                 data-config='{"id":"cp-archive","columns":"<?php echo esc_attr($columns); ?>"<?php
                 if($clever_layout=='masonry'){
                     ?>
                     ,"layout_mod":"<?php if($clever_layout=='grid'){ echo esc_attr('fitRows');}else{ echo esc_attr($clever_settings['archive_layout_mode']);}?>"
                     <?php
                 }
                 ?>}'
                <?php }?>
                >
                <?php if ($portfolio_padding != 0) { ?>
                <div style="margin:0 <?php echo esc_attr('-' . $portfolio_padding) ?>px">
                    <?php } ?>
                    <div class="cp-wrap-block-item">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                clever_get_template_part('clever-portfolio', 'archive', 'portfolio-item', true);
                            endwhile;
                        else :
                            clever_get_template_part('clever-portfolio', 'archive', 'no-content', true);
                        endif;
                        ?>
                    </div>
                    <?php if ($portfolio_padding != 0) : ?>
                </div>
            <?php endif;
            $isotope=true;
            if($clever_layout=='list'){
                $isotope=false;
            }
                if ($pagination_type === 'standard') :
                    echo '<div class="clever-wrap-pagination default">';
                    clever_stardard_pagination($the_query, 3, '<i class="cs-font clever-icon-prev-arrow-1"></i>', '<i class="cs-font clever-icon-next-arrow-1"></i>');
                    echo '</div>';
                elseif ($pagination_type === 'infinite') :
                    echo '<div class="clever-wrap-pagination">';
                    clever_infinity_scroll_pagination($the_query, '#cp-archive', '.clever-portfolio-item', $isotope);
                    echo '</div>';
                elseif ($pagination_type === 'loadmore') :
                    echo '<div class="clever-wrap-pagination">';
                    clever_ajax_load_pagination(basename(__FILE__, ".php"), $atts, $the_query, '','#cp-archive', '.cp-wrap-block-item', $isotope);
                    echo '</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </main>
<?php
get_footer();
