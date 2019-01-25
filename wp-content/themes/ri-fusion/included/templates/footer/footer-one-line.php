<div class="row">
<?php
if (is_active_sidebar('footer-2')) { ?>
    <div id="main-footer" class="col-xs-12 col-sm-6 pull-right">
        <?php dynamic_sidebar('footer-2'); ?>
    </div>
<?php } ?>
<?php
$rit_copyright_text=get_theme_mod('rit_short_copyright_text','');
if($rit_copyright_text==''){
    $rit_copyright_text=get_theme_mod('rit_copyright_text','');
}
if (get_theme_mod('rit_enable_copyright', '1') && $rit_copyright_text!='') { ?>
    <div id="copyright" class="copyright col-xs-12 col-sm-6">
        <?php
        echo wp_kses($rit_copyright_text, array('a' => array('href' => array(), 'title' => array()), 'i' => array('class' => array()),'br' => array('class' => array())));
        ?>
    </div>
<?php } ?>
</div>