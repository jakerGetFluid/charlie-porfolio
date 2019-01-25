<?php
$rit_imgsize ='medium';
if (get_theme_mod('rit_default_img_size', 'medium') != 'custom') {
    $rit_imgsize = get_theme_mod('rit_default_img_size', 'medium');
} else {
    $rit_imgsize = array(get_theme_mod('rit_default_img_custom_size_width', '370'), get_theme_mod('rit_default_img_custom_size_height', '210'));
}
?>
<article <?php echo post_class('rit-blog-item list-item row ')?> id="<?php echo get_post_type().'-'; the_ID(); ?>">
    <?php if(has_post_format('gallery')) : ?>
        <?php $rit_images = get_post_meta( get_the_ID(), '_format_gallery_images', true ); ?>
        <?php if($rit_images) : ?>
            <div class="post-image col-sm-4 col-xs-12">
                <ul class="ri-fusion-slider">
                    <?php foreach($rit_images as $rit_image) : ?>
                        <?php $rit_the_image = wp_get_attachment_image_src( $rit_image, 'full-thumb' ); ?>
                        <?php $rit_the_caption = get_post_field('post_excerpt', $rit_image); ?>
                        <li><img src="<?php echo esc_url($rit_the_image[0]); ?>" <?php if($rit_the_caption) : ?>title="<?php esc_attr($rit_the_caption); ?>"<?php endif; ?> /></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php elseif(has_post_format('video')) : ?>
        <div class="post-image wrap-media  col-sm-4 col-xs-12">
            <?php $rit_video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
            <?php if(wp_oembed_get( $rit_video )) : ?>
                <?php echo wp_oembed_get($rit_video); ?>
            <?php else : ?>
                <?php echo ent2ncr($rit_video); ?>
            <?php endif; ?>
        </div>
    <?php elseif(has_post_format('audio')) : ?>
        <div class="post-image audio wrap-media  col-sm-4 col-xs-12">
            <?php $rit_audio = get_post_meta( get_the_ID(), '_format_audio_embed', true ); ?>
            <?php if(wp_oembed_get( $rit_audio )) : ?>
                <?php echo wp_oembed_get($rit_audio); ?>
            <?php else : ?>
                <?php echo ent2ncr($rit_audio); ?>
            <?php endif; ?>
        </div>
    <?php else :
        $rit_img=get_post_thumbnail_id(get_the_ID());
        $rit_attachments = get_attached_file($rit_img);
        if (has_post_thumbnail() && $rit_attachments) :
            $rit_item=wp_get_attachment_image_src($rit_img,$rit_imgsize);
            $rit_img_url=$rit_item[0];
            $rit_width=$rit_item[1];
            $rit_height=$rit_item[2];
            $rit_img_title= get_the_title( $rit_img);
            ?>
            <div class="post-image col-sm-4 col-xs-12 wrap-media">
                <a href="<?php echo esc_url(get_permalink()); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri())?>/images/placeholder.gif" height="<?php echo esc_attr($rit_height)?>" width="<?php echo esc_attr($rit_width)?>" class="lazy-img"  data-original="<?php echo esc_attr($rit_img_url) ?>" alt="<?php echo esc_attr($rit_img_title); ?>"/>
                </a>
            </div>
            <?php
        endif;
    endif; ?>
    <div class="rit-post-inner  col-sm-8 col-xs-12">

            <?php the_title(sprintf('<h3 class="entry-title title-post"><a href="%s" rel="' . esc_html__('bookmark', 'ri-fusion') . '">', esc_url(get_permalink())), '</a></h5>'); ?>
            <div class="post-info">
                <?php echo get_the_term_list(get_the_ID(), 'category', '<span class="list-cat">', ', ', '</span> /'); ?>
                <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
            </div>
            <div class="entry-content">
                <?php
                if (function_exists('rit_excerpt')) {
                    echo rit_excerpt('20');
                } else {
                    the_excerpt();
                } ?>
            </div>
            <?php
            if (get_theme_mod('rit_hide_readmore', true)) {
                ?>
                <span class="readmore">
                <a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html(__('Read more', 'ri-fusion')); ?></a>
            </span>
            <?php } ?>
    </div>
</article>