<?php
$wrapID = 'shortcode_auto_typing_' . rit_random_ID();
$texts = vc_param_group_parse_atts($atts['text']);
$list = array();
foreach ($texts as $text) {
    if($text['text-item']!='') {
        $list[] .= $text['text-item'];
    }
}
wp_enqueue_script('typed');
?>
<div id="<?php echo esc_attr($wrapID); ?>" class="rit-auto-typing primary-font <?php echo esc_attr($atts['el_class']) ?>"
     data-text='<?php echo esc_attr(json_encode($list))?>' data-speed="<?php echo esc_attr($atts['typeSpeed'])?>" data-delay="<?php echo esc_attr($atts['delay_time']==''?0:$atts['delay_time'])?>"
     data-cursor="<?php if($atts['show_cursor']!=''){?>true<?php }?>"
     style="font-size:<?php echo esc_attr($atts['font-size']) ?>px;text-transform: <?php echo esc_attr($atts['text-transform']) ?>;color:<?php echo esc_attr($atts['text_color']) ?>;">
        <?php if($atts['fixed-text']!=''){?>
        <span style="color:<?php echo esc_attr($atts['fixed_text_color']) ?>;"><?php echo esc_html($atts['fixed-text'])?></span>
        <?php }?>
    <span class="content-auto-typing">
    </span>
</div>
