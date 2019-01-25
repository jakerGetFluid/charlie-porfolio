<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.3.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

$args = array(
    'post_type' => 'post',
    'posts_per_page' => ($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
if ($atts['cat'] != ''){
    $cats = explode(',', $atts['cat']);
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio_category',
            'field' => 'id',
            'terms' => $cats,
        )
    );
}
if ($atts['post_in'] != '')
    $args['post__in'] = explode(',', $atts['post_in']);
$args['paged'] = (rit_get_query_var('paged')) ? rit_get_query_var('paged') : 1;
?>
<div class="rit-blog-large-layout"> <?php
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
            ?>
            <article <?php post_class('rit-news-item')?> id="post-<?php the_ID(); ?>">
                <?php echo rit_get_template_part('post-format/post', 'default', array('atts' => $atts)) ?>
                <div class="rit-news-info">
                    <h3 class="title-news"><a href="<?php the_permalink(); ?>"
                                              title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                    <p class="info-post"><a class="author-link"
                                            href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                            rel="author">
                            <?php echo(get_the_author()); ?>
                        </a> / <?php echo get_the_date('F jS, Y'); ?>
                        /  <?php comments_number(esc_html__('0 Comment', 'rit-core-language'), esc_html__('1 Comment', 'rit-core-language'), esc_html__('% Comments', 'rit-core-language'));?></p>

                    <div class="description"><?php if($atts['output_type']!='no'){
                            if($atts['output_type']=='excerpt'){
                                echo rit_excerpt($atts['excerpt_lenght']);
                            }
                            else{
                                the_content();
                            }
                        } ?></div>
                </div>
            </article>
        <?php
        endwhile;
        if (function_exists("rit_pagination")) :
            rit_pagination( 3, $the_query);
        endif;
    endif;
    wp_reset_postdata();

    ?>
</div>
