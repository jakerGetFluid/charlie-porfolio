<?php

$rit_categories = get_the_category(get_the_ID());

$rit_category_ids = array();

foreach ($rit_categories as $rit_category) $rit_category_ids[] = $rit_category->term_id;
$args = array(
    'post_type' => 'post',
    'post__not_in' => array(get_the_ID()),
    'showposts' => 3,
    'ignore_sticky_posts' => -1
);
$rit_related_query = new wp_query($args);
if ($rit_related_query->have_posts()) { ?>
    <div class="post-related">
        <h4 class="title-single-block"><?php esc_html_e('Related Post', 'ri-fusion'); ?></h4>
        <div class="row">
            <?php while ($rit_related_query->have_posts()) {
                $rit_related_query->the_post(); ?>
                <div class="item-related col-sm-4">
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="wrap-post-thumbnail"
                           title="<?php echo esc_attr(get_the_title()); ?>"><?php
                            the_post_thumbnail('rit-portfolio-thumb');
                            ?>
                        </a>
                    <?php endif; ?>
                    <h5 class="title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h5>
                    <span class="date-post post-info"><?php echo esc_html(get_the_date()); ?></span>
                </div>
                <?php
            } ?>
        </div>
    </div>
<?php }
wp_reset_postdata();
?>