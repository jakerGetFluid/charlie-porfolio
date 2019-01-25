<?php
/**
 * Plugin Name: Latest Posts Widget
 */

add_action( 'widgets_init', 'rit_latest_news_load_widget' );

function rit_latest_news_load_widget() {
    register_widget( 'rit_latest_news_widget' );
}

class rit_latest_news_widget extends WP_Widget {

    /**
     * Widget setup.
     */
    function __construct() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'rit_latest_news_widget', 'description' => esc_html__('A widget that displays your latest posts from all categories or a certain', 'ri-fusion') );

        /* Widget control settings. */
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rit_latest_news_widget' );

        /* Create the widget. */
        parent::__construct( 'rit_latest_news_widget', esc_html__('RIT: Latest Posts', 'ri-fusion'), $widget_ops, $control_ops );
    }

    /**
     * How to display the widget on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        $categories = $instance['categories'];
        $number = $instance['number'];


        $query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);

        $loop = new WP_Query($query);
        if ($loop->have_posts()) :

            /* Before widget (defined by themes). */
            echo ent2ncr($before_widget);

            /* Display the widget title if one was input (before and after defined by themes). */
            if ( $title )
                echo ent2ncr($before_title) . esc_html($title) . ent2ncr($after_title);

            ?>
            <ul class="rit-recent-post-widgets">

            <?php  while ($loop->have_posts()) : $loop->the_post(); ?>

            <li class="recent-post-item <?php echo esc_attr(has_post_thumbnail()?'':'no-thumb');?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="recent-post-image">
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title(); ?>">
                                <?php if(has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="recent-post-item-text">
                        <h5><a class="title" href="<?php echo esc_url(get_permalink()); ?>" rel="<?php echo esc_attr('bookmark'); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                        <span class="post-date "><?php echo esc_html(get_the_date()); ?></span>
                    </div>
            </li>

        <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        </ul>

        <?php

        /* After widget (defined by themes). */
        echo ent2ncr($after_widget);
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['categories'] = $new_instance['categories'];
        $instance['number'] = strip_tags( $new_instance['number'] );

        return $instance;
    }


    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array( 'title' => esc_html__('Latest Posts', 'ri-fusion'), 'number' => 5, 'categories' => '');
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html(esc_html_e('Title:', 'ri-fusion')); ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php echo esc_html(__('Filter by Category:', 'ri-fusion')); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
                <option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html(__('All categories', 'ri-fusion')); ?></option>
                <?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
                <?php foreach($categories as $category) { ?>
                    <option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>

        <!-- Number of posts -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts to show:', 'ri-fusion'); ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
        </p>


    <?php
    }
}

?>