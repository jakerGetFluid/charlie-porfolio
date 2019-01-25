<?php
/**
 * The template for displaying Information of Single portfolio.
 *
 * @package      clever-portfolio\Templates
 * @version      1.0.0
 * @author       Zootemplate
 * @link         http://www.zootemplate.com
 * @copyright    Copyright (c) 2016 Zootemplate
 * @license      GPL v2
 * @since        clever-portfolio 1.0
 */
$clever_settings=clever_portfolio_get_settings();
$clever_meta=clever_portfolio_single_meta();
$clever_col='';
$clever_share=isset($clever_settings['single_enable_share'])?$clever_settings['single_enable_share']:'0';
if (isset($clever_settings['single_enable_extra_info']) && isset($clever_settings['single_extra_info']) && $clever_settings['single_enable_extra_info']) :
    $clever_settings_info = $clever_settings['single_extra_info'];
    $clever_col=count($clever_settings_info)+1+$clever_share;
    ?>
    <ul class="cp-info <?php echo esc_attr('col-'.$clever_col); ?>">
        <?php
        foreach ($clever_settings_info as $key => $setting) : ?>
            <li>
                <h5 class="info-label">
                    <?php echo $setting['label'] ?>
                </h5>
                <p class="info-content">
                    <?php echo $clever_meta[$key] ?>
                </p>
            </li>
        <?php endforeach; ?>
        <li>
            <h5 class="info-label">
                <?php echo esc_html__('Categories:','clever-portfolio') ?>
            </h5>
            <p class="info-content">
                <?php echo get_the_term_list(get_the_ID(), 'portfolio_category', '<span class="list-cat">', ' - ', '</span>'); ?>
            </p>
        </li>
        <?php if ($clever_share==1) { ?>
            <li class="share-links">
                <h5 class="info-label">  <?php echo esc_html__('Share:', 'clever-portfolio') ?></h5>
                <ul class="cp-social-icons">
                        <li class="facebook border-icon cp-social-icon"><a
                                href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>"
                                class="post_share_facebook" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i
                                    class="fa fa-facebook-f"></i></a></li>

                        <li class="twitter border-icon cp-social-icon"><a
                                href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"
                                class="product_share_twitter"><i class="fa fa-twitter"></i></a></li>

                        <li class="googleplus border-icon cp-social-icon"><a
                                href="https://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i
                                    class="fa fa-google-plus"></i></a></li>

                        <li class="pinterest border-icon cp-social-icon"><a
                                href="http://pinterest.com/pin/create/button/?url=<?php esc_url(the_permalink()); ?>&media=<?php if (function_exists('the_post_thumbnail')) echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo esc_url(get_the_title()); ?>"><i
                                    class="fa fa-pinterest"></i></a></li>

                        <li class="mail border-icon cp-social-icon"><a
                                href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php esc_url(the_permalink()); ?>"
                                class="product_share_email"><i class="fa fa-envelope"></i></a></li>
                </ul>
            </li>
        <?php } ?>
    </ul>
<?php endif;