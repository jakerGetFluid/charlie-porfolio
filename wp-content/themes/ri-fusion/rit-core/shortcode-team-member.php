<?php
$links = vc_param_group_parse_atts($atts['member_link']);
$html='';
if($links!=''){
    $html='<ul class="member-links">';
    foreach ($links as $link) {
        $html.='<li><a href="'.(vc_build_link( $link['link'] )['url']==''?'#':vc_build_link( $link['link'] )['url']).'" title="'.vc_build_link( $link['link'] )['title'].'" target="'.vc_build_link( $link['link'] )['target'].'">';
        $html.=$link['text'];
        $html .='</a></li>';
    }
    $html.='</ul>';
}
$allowhtml=array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    ),
    'li' => array('class' => array()),
    'ul' => array('class' => array()),
);
$id = 'rit-team-member-' . rit_random_ID();
?>
<div id="<?php echo esc_attr($id);?>" class="rit-team-member">
    <?php if($atts['avatar']!=''){?>
        <?php echo wp_get_attachment_image($atts['avatar'], 'full'); ?>
    <?php }?>
    <div class="rit-team-member-content">
        <?php
            if($atts['member_name']!=''){
?>
                <h4 class="member-name body-font">
                    <?php echo esc_html($atts['member_name'])?>
                </h4>
                <?php
            }            if($atts['member_position']!=''){
?>
                <h5 class="member-position body-font">
                    <?php echo esc_html($atts['member_position'])?>
                </h5>
                <?php
            }
            echo wp_kses($html,$allowhtml);
        ?>
    </div>
</div>
