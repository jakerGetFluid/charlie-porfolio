<div class="single-section clearfix">
    <div class="pull-left primary-font">
        <a href="<?php esc_url(get_the_permalink()); ?>#comments"  class="post-comment"><?php comments_number( esc_html__('Write comment','ri-fusion'), esc_html__('1 comment','ri-fusion'), esc_html__('% comment','ri-fusion') ); ?></a>
    </div>
    <div class="share-links pull-right">
        <span class="primary-font"><?php echo esc_html__('Share', 'ri-fusion'); ?></span>
        <ul class="social-icons">
            <li class="facebook border-icon social-icon"><a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>" class="post_share_facebook" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa fa-facebook-f"></i></a></li>
            <li class="twitter border-icon social-icon"><a href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="googleplus border-icon social-icon"><a href="https://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
            <li class="pinterest border-icon social-icon"><a href="http://pinterest.com/pin/create/button/?url=<?php esc_url(the_permalink()); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo esc_url(get_the_title()); ?>"><i class="fa fa-pinterest"></i></a></li>
            <li class="mail border-icon social-icon"><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php esc_url(the_permalink()); ?>" class="product_share_email"><i class="fa fa-envelope"></i></a></li>
        </ul>
    </div>
</div>