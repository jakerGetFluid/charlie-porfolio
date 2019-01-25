<div class="post-pagination <?php echo esc_attr(get_post_type() == 'portfolio' ? 'portfolio-pagination' : '') ?> row">
    <?php
    $rit_prev_post = get_previous_post();
    $rit_next_post = get_next_post();
    ?>
    <?php if (!empty($rit_prev_post)) : ?>
        <div class="prev-post col-sm-6 col-xs-12">

            <span><?php esc_html_e('Previous article', 'ri-fusion') ?></span>
            <h4>
                <a href="<?php echo esc_url(get_permalink($rit_prev_post->ID)); ?>" title="<?php echo get_the_title($rit_prev_post->ID); ?>"><?php echo get_the_title($rit_prev_post->ID); ?></a>
            </h4>
        </div>
    <?php endif; ?>

    <?php if (!empty($rit_next_post)) : ?>
        <div class="next-post col-sm-6 col-xs-12 pull-right">
            <span><?php esc_html_e('Next article', 'ri-fusion') ?></span>
            <h4><a  href="<?php echo esc_url(get_permalink($rit_next_post->ID)); ?>" title="<?php echo get_the_title($rit_next_post->ID); ?>"><?php echo get_the_title($rit_next_post->ID); ?></a>
            </h4>
        </div>
    <?php endif; ?>

</div>