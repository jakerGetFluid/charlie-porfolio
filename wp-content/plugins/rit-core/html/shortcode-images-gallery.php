<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.1
 * @author      CleverSoft
 * @link        http://cleversoft.co
 * @copyright   Copyright (c) 2015 CleverSoft
 * @license     GPL v2
 */
$wrapID = 'shortcode_imgs_gallery_' . rit_random_ID();
$wrapper_class = $atts['el_class'];
$class = '';
if ($atts['layout'] == 'grid' || $atts['layout'] == 'carousel') {
    switch ($atts['columns']) {
        case '1':
            $class .= "col-xs-12";
            break;
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
    }
}
$links = $imgs = array();
$imgs = explode(',', $atts['images']);
$links = explode(',', $atts['links']);
if (count($imgs) > 0):
    //Carousel js
    if ($atts['layout'] == 'carousel') {
        $item = $atts['rows'] == '1' ? $atts['columns'] : 1;
        $jsconfig = '{"item":"' . $item . '","wrap":".wrapper-shortcode-imgs-gallery"}';
        $maxitem = $atts['columns'] * $atts['rows'];
    }
    //End carousel js
    ?>
<div id="<?php echo esc_attr($wrapID) ?>"
     class="rit-shortcode-imgs-gallery <?php echo esc_attr($wrapper_class . ' rit-' . $atts['layout'] . '-gallery ');
     if ($atts['layout'] == 'carousel') {
         echo esc_attr('ri-fusion-carousel');
     } ?>"
    <?php if ($atts['layout'] == 'carousel') { ?> data-config=' <?php echo esc_attr($jsconfig); ?> ' <?php } ?>
>
    <?php if ($atts['title'] != '') { ?>
    <h2 class="title-block"><?php
        echo esc_html($atts['title']);
        ?></h2>
<?php }
if ($atts['layout'] == 'grid' || $atts['layout'] == 'carousel'){
    ?>
    <div class="row">
    <div class="wrapper-shortcode-imgs-gallery">
    <?php
}
    $i = $j = 0;
    foreach ($imgs as $img) {
        if (($atts['layout'] == 'carousel' && $atts['rows'] != '1') && $j == 0) {
            echo '<div class="row wrap-shortcode-gallery-item">';
        }
        ?>
        <div class="shortcode-gallery-item <?php echo esc_attr($class) ?>">
            <?php
            if (isset($links[$i])){
            ?>
            <a href="<?php echo esc_attr($links[$i]) ?>">
                <?php } ?>
                <?php echo wp_get_attachment_image($img, 'full'); ?>
                <?php
                if (isset($links[$i])){
                ?>
            </a>
        <?php } ?>
        </div>
        <?php
        $i++;
        $j++;
        if (($atts['layout'] == 'carousel' && $atts['rows'] != '1') && ($j == $maxitem || $i == count($imgs))) {
            echo '</div>';
            $j = 0;
        }
    }
if ($atts['layout'] == 'grid' || $atts['layout'] == 'carousel'){
    ?>
    </div>
    </div>
    <?php
}
    ?>
    </div><?php
endif;
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_script('slick');