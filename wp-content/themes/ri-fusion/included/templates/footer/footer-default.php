<div class="container">
    <?php
    if (is_active_sidebar('footer')) { ?>
        <div id="main-footer">
            <?php dynamic_sidebar('footer'); ?>
        </div>
    <?php }
    $rit_copyright_text = get_theme_mod('rit_copyright_text', '');
    if (get_theme_mod('rit_enable_copyright', '1') && $rit_copyright_text != '') { ?>
        <div id="copyright" class="copyright col-xs-12">
            <?php
            echo wp_kses($rit_copyright_text, array('a' => array('href' => array(), 'title' => array()), 'i' => array('class' => array()), 'br' => array('class' => array())));
            ?>
        </div>
    <?php } ?>
</div>
