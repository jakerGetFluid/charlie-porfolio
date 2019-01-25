<?php
/**
 * Plugin Name: Latest Posts Widget
 */

add_action( 'widgets_init', 'rit_testimonials_widget' );

function rit_testimonials_widget() {
    register_widget( 'rit_testimonials_widget' );
}

class rit_testimonials_widget extends WP_Widget {

    /**
     * Widget setup.
     */
    function __construct() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'rit_testimonials_widget', 'description' => esc_html__('A widget display testimonials follow category', 'ri-fusion') );

        /* Widget control settings. */
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rit_testimonials_widget' );

        /* Create the widget. */
        parent::__construct( 'rit_testimonials_widget', esc_html__('RIT: Testimonials', 'ri-fusion'), $widget_ops, $control_ops );
    }

    /**
     * How to display the widget on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        $type=$instance['type'];
        $pre_style=$instance['pre_style'];
        $categories = $instance['categories'];
        $order=$instance['order_by'];
        $number = $instance['number'];
        $cols = $instance['columns'];
        $output_type=$instance['output_type'];
        $query = array(
            'post_type' => 'testimonial',
            'order_by' => $order,
            'posts_per_page' => $number,
        );
        if ($categories) {
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'testimonial_category',
                    'field' => 'slug',
                    'terms' => $categories,
                )
            );
        }
        echo ent2ncr($before_widget);
?>
<div class="rit-testimonial-widget rit-testimonial <?php echo esc_attr($pre_style).' '; echo esc_attr($type) . '-testimonial' ?>"
<?php if ($type == 'carousel') {?>data-config='{"item":"<?php echo esc_attr($cols)?>"}' <?php } ?>
>
    <?php
     if ($title != '') { ?>
        <h5 class="title-shortcode"><?php echo esc_html($title); ?></h5>
    <?php }
    $the_query = new WP_Query($query);
    if ($the_query->have_posts()):
    $class='rit-testimonial-item';
    if ($type != 'carousel') {
        switch ($cols) {
        case '2':
            $class .= "col-xs-12 col-sm-6 col-md-6";
            break;
        case '3':
            $class .= "col-xs-12 col-sm-6 col-md-4";
            break;
        case '4':
            $class .= "col-xs-12 col-sm-6 col-md-3";
            break;
        case '5':
            $class .= "col-xs-12 col-sm-1-5 col-md-1-5";
            break;
        case '6':
            $class .= "col-xs-12 col-sm-6 col-md-2";
            break;
        default:
            $class .= "col-xs-12 col-sm-6 col-md-4";
            break;
        }
    }
    echo '<div class="rit-wrapper-testimonial-block ">';
    if($type=='grid'){echo '<div class="row">';}
    while ($the_query->have_posts()):$the_query->the_post(); ?>
        <article <?php echo post_class($class)?> id="testimonial-<?php the_ID(); ?>">
            <div class="rit-testimonial-content">
                <?php if ($output_type == 'excerpt' && function_exists('rit_excerpt')) {
                    echo rit_excerpt(20);
                } else {
                    the_content();
                } ?>
            </div>
            <div class="rit-wrap-author">
                <div class="rit-wrap-avatar">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php
                        if (get_post_meta(get_the_ID(), 'rit_author_img', true) != '') {
                            ?>
                            <img
                                src="<?php echo wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'rit_author_img', true), 'full') ?>"
                                alt="<?php the_title(); ?>" class="avatar-circus"/>
                        <?php }
                        ?>
                    </a>
                </div>
                <div class="rit-wrap-author-info">
                    <h6 class="rit-testimonial-author">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php
                            if (get_post_meta(get_the_ID(), 'rit_author', true) != '') {
                                echo esc_html(get_post_meta(get_the_ID(), 'rit_author', true));
                            }
                            ?>
                        </a>
                    </h6>
                    <?php
                    if (get_post_meta(get_the_ID(), 'rit_author_des', true) != '') { ?>
                        <div class="rit-testimonial-des special-font"><?php
                            echo esc_html(get_post_meta(get_the_ID(), 'rit_author_des', true)); ?>
                        </div>
                        <?php
                    }?>
                </div>
            </div>
        </article>
        <?php
    endwhile;
    if($type=='grid'){echo '</div>';}
    ?>
</div>
<?php
endif;
wp_reset_postdata(); ?>
</div>
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
        $instance['type']=$new_instance['type'];
        $instance['pre_style']=$new_instance['pre_style'];
        $instance['order_by']=$new_instance['order_by'];
        $instance['columns']=$new_instance['columns'];
        $instance['output_type']=$new_instance['output_type'];
        return $instance;
    }


    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array( 'title' => esc_html__('Testimonials', 'ri-fusion'), 'number' => 3, 'categories' => '','type'=>'grid','pre_style'=>'default','order_by'=>'date','columns'=>1,'output_type'=> 'excerpt');
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
                <option value='' <?php if ('' == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html(__('All categories', 'ri-fusion')); ?></option>
                <?php $categories = get_categories('hide_empty=0&depth=1&type=post&taxonomy=testimonial_category'); ?>
                <?php foreach($categories as $category) { ?>
                    <option value='<?php echo esc_attr($category->slug); ?>' <?php if ($category->slug == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>

        <!-- Number of posts -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts to show:', 'ri-fusion'); ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e('Type display:', 'ri-fusion'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>" class="widefat style" style="width:100%;">
                <option value='grid' <?php if ('grid' == $instance['type']||$instance['type']=='') echo 'selected="selected"'; ?>><?php echo esc_html__('Grid', 'ri-fusion'); ?></option>
                <option value='carousel' <?php if ('carousel' == $instance['type']) echo 'selected="selected"'; ?>><?php echo esc_html__('Carousel', 'ri-fusion'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pre_style' )); ?>"><?php esc_html_e('Style display:', 'ri-fusion'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('pre_style')); ?>" name="<?php echo esc_attr($this->get_field_name('pre_style')); ?>" class="widefat style" style="width:100%;">
                <option value='default' <?php if ('default' == $instance['pre_style']) echo 'selected="selected"'; ?>><?php echo esc_html__('Default', 'ri-fusion'); ?></option>
                <option value='style-1' <?php if ('style-1' == $instance['pre_style']) echo 'selected="selected"'; ?>><?php echo esc_html__('Style 1', 'ri-fusion'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>"><?php esc_html_e('Order by:', 'ri-fusion'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('order_by')); ?>" name="<?php echo esc_attr($this->get_field_name('order_by')); ?>" class="widefat style" style="width:100%;">
                <option value='date' <?php if ('date' == $instance['order_by']) echo 'selected="selected"'; ?>><?php echo esc_html__('Latest', 'ri-fusion'); ?></option>
                <option value='random' <?php if ('random' == $instance['order_by']) echo 'selected="selected"'; ?>><?php echo esc_html__('Random', 'ri-fusion'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>"><?php esc_html_e('Columns:', 'ri-fusion'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('columns')); ?>" name="<?php echo esc_attr($this->get_field_name('columns')); ?>" class="widefat style" style="width:100%;">
                <option value='1' <?php if ('1' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('1', 'ri-fusion'); ?></option>
                <option value='2' <?php if ('2' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('2', 'ri-fusion'); ?></option>
                <option value='3' <?php if ('3' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('3', 'ri-fusion'); ?></option>
                <option value='4' <?php if ('4' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('4', 'ri-fusion'); ?></option>
                <option value='5' <?php if ('5' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('5', 'ri-fusion'); ?></option>
                <option value='6' <?php if ('6' == $instance['columns']) echo 'selected="selected"'; ?>><?php echo esc_html__('6', 'ri-fusion'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'output_type' )); ?>"><?php esc_html_e('Content:', 'ri-fusion'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('output_type')); ?>" name="<?php echo esc_attr($this->get_field_name('output_type')); ?>" class="widefat style" style="width:100%;">
                <option value='excerpt' <?php if ('excerpt' == $instance['output_type']) echo 'selected="selected"'; ?>><?php echo esc_html__('Excerpt', 'ri-fusion'); ?></option>
                <option value='full' <?php if ('full' == $instance['output_type']) echo 'selected="selected"'; ?>><?php echo esc_html__('Full content', 'ri-fusion'); ?></option>
            </select>
        </p>

    <?php
    }
}