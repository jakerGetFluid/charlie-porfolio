<?php
/**
 * The template for displaying Archive portfolio with grid layout.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */

$clever_settings = clever_portfolio_get_settings();
$clever_meta = clever_portfolio_single_meta();
$clever_layout = $clever_settings['archive_layout'];
//Generic Settings
$portfolio_padding = $clever_settings['archive_portfolio_gutter'] / 2;

$thumbnail_size = !empty($atts['thumbnail_size']) ? $atts['thumbnail_size'] : $clever_settings['archive_thumbnail_size'];
$columns = intval($clever_settings['archive_columns_per_page']);

$clever_class = 'clever-portfolio-item ';
if ($clever_layout != 'metro' && $clever_layout != 'list') {
    switch ($columns) {
        case '2':
            $clever_class .= "col-xs-12 col-sm-6";
            break;
        case '3':
            $clever_class .= "col-xs-12 col-sm-4";
            break;
        case '4':
            $clever_class .= "col-xs-12 col-sm-3";
            break;
        case '5':
            $clever_class .= "col-xs-12 col-sm-1-5";
            break;
        case '6':
            $clever_class .= "col-xs-12 col-sm-2";
            break;
        default:
            $clever_class .= "col-xs-12 col-sm-12";
            break;
    }
}
if ($clever_layout == 'list') {
    $clever_class .= " col-xs-12 col-sm-12";
}
?>
<article id="portfolio-<?php esc_attr(the_ID()); ?>" <?php echo post_class($clever_class); ?>
         style="padding:<?php echo esc_attr($portfolio_padding) ?>px">
    <?php if ($clever_layout != 'list') { ?>
        <div class="wrap-portfolio-item">
            <a href="<?php the_permalink(); ?>"
               title="<?php the_title(); ?>" class="mask-link"></a>
            <div class="wrap-portfolio-img">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail($thumbnail_size); ?>
                </a>
            </div>
            <div class="portfolio-info">
                <h3 class="title title-post">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <?php if (isset($clever_settings['archive_show_date']) && $clever_settings['archive_show_date'] == 1) { ?>
                <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
               <?php } if (isset($clever_settings['archive_show_cats']) && $clever_settings['archive_show_cats'] == 1) { ?>
                   <div
                           class="list-cat"><?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '', '', ''); ?></div>
                   <?php
               }
                if (isset($clever_settings['archive_show_description']) && $clever_settings['archive_show_description'] == 1) { ?>
                    <div class="portfolio-des">
                        <?php
                        $description = '';
                        if (isset($clever_meta['short_description'])) {
                            if ($clever_meta['short_description'] != '') {
                                $description = $clever_meta['short_description'];
                            }
                        }
                        if ($description) {
                            echo esc_html($description);
                        } else {
                            the_excerpt();
                        } ?>
                    </div>
                    <?php
                }
                if (isset($clever_settings['archive_show_btn']) && $clever_settings['archive_show_btn'] == 1) {
                    if($clever_settings['archive_btn_text']!='') {
                        ?>
                        <a class="btn btn-around" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php echo esc_html($clever_settings['archive_btn_text']) ?>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="wrap-portfolio-img">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail($thumbnail_size); ?>
            </a>
            <div class="portfolio-info">
                <span class="post-date"><?php echo esc_html(get_the_date('M, Y')); ?></span>
                <div class="list-cat"><?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '', '', ''); ?></div>
            </div>
        </div>

        <div class="main-portfolio-info">
            <h3 class="title title-post">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <?php
            if (isset($clever_settings['archive_show_description']) && $clever_settings['archive_show_description'] == 1) { ?>
                <div class="portfolio-des">
                    <?php
                    $description = '';
                    if (isset($clever_meta['short_description'])) {
                        if ($clever_meta['short_description'] != '') {
                            $description = $clever_meta['short_description'];
                        }
                    }
                    if ($description) {
                        echo esc_html($description);
                    } else {
                        the_excerpt();
                    } ?>
                </div>
                <?php
            }
            ?>
        </div>
    <?php } ?>
</article>