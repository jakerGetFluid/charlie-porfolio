<?php
/**
 * The template displaying content single portfolio oembed format with layout Right sidebar.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
?>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <?php
            clever_get_template_part('clever-portfolio', 'single/embed/', 'embed', true);
        ?>
    </div>
    <div class="cp-wrap-content col-xs-12 col-sm-6">
        <?php
            the_title('<h1 class="title-portfolio">', '</h1>');
        ?>
        <div class="cp-content">
            <?php
            the_content();
            ?>
        </div>
        <?php
        clever_get_template_part('clever-portfolio', 'single/', 'infor', true); ?>
    </div>
</div>
<?php clever_get_template_part('clever-portfolio', 'single/', 'pagination', true);