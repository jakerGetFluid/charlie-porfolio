<?php
/**
 * The template displaying content portfolio oembed format with layout Full Screen.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
$ri_meta = clever_portfolio_single_meta();
clever_get_template_part('clever-portfolio', 'single/embed/', 'embed', true);
?>
<div class="cp-wrap-content expand" style="opacity: 0">
    <span class="toggle-view"><i class="cs-font clever-icon-contract"></i></span>
    <div class="cp-main-content">
        <?php
        if (get_post_meta(get_the_ID(), 'rit_disable_title', true) != 1) {
            the_title('<h1 class="title-portfolio">', '</h1>');
        } ?>
        <div class="cp-content">
            <?php
            the_content();
            ?>
        </div>
        <?php
        clever_get_template_part('clever-portfolio', 'single/', 'infor', true); ?>
    </div>
    <?php
    clever_get_template_part('clever-portfolio', 'single/', 'pagination', true);
    ?>
</div>
<div class="cp-wrap-content minimal active">
    <span class="toggle-view"><i class="cs-font clever-icon-expand"></i></span>
    <?php
    the_title('<h2 class="title-portfolio">', '</h2>'); ?>
    <span class="date-post">
            <?php
            $ri_settings = clever_portfolio_get_settings();
            $settings_info = $ri_settings['single_extra_info'];
            $settings_info=array_keys($settings_info);
            if(isset($settings_info[1]))
            echo esc_html(date(get_option('date_format'), strtotime($ri_meta[$settings_info[1]]))) ?>
    </span>
</div>
