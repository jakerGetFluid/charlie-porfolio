<?php
/**
 * The template for displaying Copyright in Sidebar
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
$rit_copyright_text=get_theme_mod('rit_short_copyright_text','');
if($rit_copyright_text==''){
    $rit_copyright_text=get_theme_mod('rit_copyright_text','');
}
if (get_theme_mod('rit_enable_copyright', '1') && $rit_copyright_text!='') { ?>
    <div id="sidebar-copyright" class="copyright">
        <?php
        echo wp_kses($rit_copyright_text, array('a' => array('href' => array(), 'title' => array()), 'i' => array('class' => array()),'br' => array('class' => array())));
        ?>
    </div>
<?php } ?>