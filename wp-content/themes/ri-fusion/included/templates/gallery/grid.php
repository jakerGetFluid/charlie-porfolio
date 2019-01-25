<?php
/**
 * Grid layout of gallery work with envira gallery
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
$rit_description = get_post_meta(get_the_ID(), 'rit_gallery_description', true);
$rit_location = get_post_meta(get_the_ID(), 'rit_gallery_location', true);
$rit_photographer = get_post_meta(get_the_ID(), 'rit_gallery_photographer', true);
$rit_camera = get_post_meta(get_the_ID(), 'rit_gallery_camera', true);
$rit_model = get_post_meta(get_the_ID(), 'rit_gallery_model', true);
$rit_hide_info = get_theme_mod('rit_gallery_hide_info', 0)==0?false:true;
if(!$rit_hide_info) {
    $rit_hide_info = get_post_meta(get_the_ID(), 'rit_gallery_hide_info', true) != '1' ? false : true;
}
?>
<div class="row">
    <?php if(!post_password_required()&&!$rit_hide_info):
        ?>
    <div class="col-xs-12 col-sm-4">
        <div class="wrap-gallery-info">
            <?php
            the_title('<h1 class="title-gallery">', '</h1>');
            if ($rit_description != '') {
                ?>
                <div class="gallery-description">
                    <?php echo esc_html($rit_description); ?>
                </div>
                <?php
            } ?>
            <ul class="gallery-list-info">
                <?php
                if ($rit_location != '') {
                    ?>
                    <li class="gallery-infor-item">
                        <div class="infor-label"> <?php echo esc_html__('Location:', 'ri-fusion') ?></div>
                        <div class="infor-detail"> <?php echo esc_html($rit_location); ?></div>
                    </li>
                    <?php
                }
                if ($rit_photographer != '') {
                    ?>
                    <li class="gallery-infor-item">
                        <div class="infor-label"> <?php echo esc_html__('Photographer:', 'ri-fusion') ?></div>
                        <div class="infor-detail"> <?php echo esc_html($rit_photographer); ?></div>
                    </li>
                    <?php
                }
                if ($rit_camera != '') {
                    ?>
                    <li class="gallery-infor-item">
                        <div class="infor-label"> <?php echo esc_html__('Camera:', 'ri-fusion') ?></div>
                        <div class="infor-detail"> <?php echo esc_html($rit_camera); ?></div>
                    </li>
                    <?php
                }
                ?>
                <li class="gallery-infor-item">
                    <div class="infor-label"> <?php echo esc_html__('Model:', 'ri-fusion') ?></div>
                    <div class="infor-detail"> <?php if ($rit_model != '') {
                            echo esc_html($rit_model);
                        } else {
                            echo esc_html__('N/A', 'ri-fusion');
                        } ?></div>
                </li>
            </ul>
            <div class="share-links">
                <span class="primary-font"><?php echo esc_html__('Share:', 'ri-fusion'); ?></span>
                <ul class="social-icons">
                    <li class="facebook social-icon"><a
                            href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>"
                            class="post_share_facebook" onclick="javascript:window.open(this.href,
                      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i
                                class="fa fa-facebook-f"></i></a></li>
                    <li class="twitter social-icon"><a
                            href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"
                            class="product_share_twitter"><i class="fa fa-twitter"></i></a></li>
                    <li class="googleplus social-icon"><a
                            href="https://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i
                                class="fa fa-google-plus"></i></a></li>
                    <li class="pinterest social-icon"><a
                            href="http://pinterest.com/pin/create/button/?url=<?php esc_url(the_permalink()); ?>&media=<?php if (function_exists('the_post_thumbnail')) echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo esc_url(get_the_title()); ?>"><i
                                class="fa fa-pinterest"></i></a></li>
                    <li class="mail social-icon"><a
                            href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php esc_url(the_permalink()); ?>"
                            class="product_share_email"><i class="fa fa-envelope"></i></a></li>
                </ul>
            </div>

            <div class="gallery-pagination">
                <?php
                $rit_prev_post = get_previous_post();
                $rit_next_post = get_next_post();
                ?>
                <?php if (!empty($rit_prev_post)) : ?>

                    <a href="<?php echo esc_url(get_permalink($rit_prev_post->ID)); ?>" class="border-button"
                       title="<?php echo get_the_title($rit_prev_post->ID); ?>"><?php echo esc_html__('Previous', 'ri-fusion'); ?></a>

                <?php endif; ?>

                <?php if (!empty($rit_next_post)) : ?>

                    <a href="<?php echo esc_url(get_permalink($rit_next_post->ID)); ?>" class="border-button"
                       title="<?php echo get_the_title($rit_next_post->ID); ?>"><?php echo esc_html__('Next', 'ri-fusion'); ?></a>

                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php  endif;?>
    <div class="col-xs-12 <?php if(!post_password_required()&&!$rit_hide_info){ echo esc_attr('col-sm-8');} ?> wrap-gallery-content">
        <?php the_content(); ?>
    </div>
</div>
