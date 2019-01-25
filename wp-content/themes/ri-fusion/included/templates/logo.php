<?php
$rit_hasLogo = false;
if (is_single() || is_page()) {
    if (get_post_meta(get_the_ID(), 'rit_logo_page', true) != '' && get_post_meta(get_the_ID(), 'rit_logo_page', true) != 0):
        $rit_hasLogo = true;
    endif;
}
if ($rit_hasLogo):?>
    <p id="logo" class="site-logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                                      title="<?php bloginfo('name'); ?>">
            <img src="<?php echo esc_url(wp_get_attachment_url(get_post_meta(get_the_ID(), 'rit_logo_page', true))) ?>"
                 alt="<?php bloginfo('name'); ?>"/></a></p>
    <?php
else:
    ?>
    <?php if (!get_theme_mod('rit_logo')) { ?>
    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                              title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
<?php } else { ?>
    <p id="logo" class="site-logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                                      title="<?php bloginfo('name'); ?>"><img
                src="<?php echo esc_url(get_theme_mod('rit_logo')) ?>" alt="<?php bloginfo('name'); ?>"/></a></p>
<?php } ?>
<?php endif;
if (get_theme_mod('rit_show_tagline') == 1):
    $rit_description = get_bloginfo('description', 'display');
    if ($rit_description || is_customize_preview()) { ?>
        <p class="site-description"><?php echo esc_html($rit_description); ?></p>
    <?php }
endif; ?>
