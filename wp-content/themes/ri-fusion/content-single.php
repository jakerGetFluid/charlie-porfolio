<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php (is_single()) ? post_class() : post_class('post-item'); ?>>
    <?php
     if(has_post_format('gallery')) : ?>

        <?php $rit_images = get_post_meta( get_the_ID(), '_format_gallery_images', true ); ?>

        <?php if($rit_images) : ?>
            <div class="post-image<?php echo (is_single()) ? ' single-image' : ''; ?>">
                <ul class="post-slider">
                    <?php foreach($rit_images as $rit_image) : ?>
                        <?php $rit_the_image = wp_get_attachment_image_src( $rit_image, 'full-thumb' ); ?>
                        <?php $rit_the_caption = get_post_field('post_excerpt', $rit_image); ?>
                        <li><img src="<?php echo esc_url($rit_the_image[0]); ?>" <?php if($rit_the_caption) : ?>title="<?php echo esc_attr($rit_the_caption); ?>"<?php endif; ?> /></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    <?php elseif(has_post_format('video')) : ?>

        <div class="post-image<?php echo (is_single()) ? ' single-video' : ''; ?>">
            <?php $rit_video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
            <?php if(wp_oembed_get( $rit_video )) : ?>
                <?php echo wp_oembed_get($rit_video); ?>
            <?php else : ?>
                <?php echo ent2ncr($rit_video); ?>
            <?php endif; ?>
        </div>

    <?php elseif(has_post_format('audio')) : ?>

        <div class="post-image audio<?php echo (is_single()) ? ' single-audio' : ''; ?>">
            <?php $rit_audio = get_post_meta( get_the_ID(), '_format_audio_embed', true ); ?>
            <?php if(wp_oembed_get( $rit_audio )) : ?>
                <?php echo wp_oembed_get($rit_audio); ?>
            <?php else : ?>
                <?php echo ent2ncr($rit_audio); ?>
            <?php endif; ?>
        </div>

    <?php else : ?>

        <?php if(has_post_thumbnail()) : ?>
            <div class="post-image<?php echo (is_single()) ? ' single-image' : ''; ?>">
                <?php the_post_thumbnail('full-thumb'); ?>
            </div>
        <?php endif; ?>

    <?php endif;
    ?>
    <div class="header-post">
        <?php
        if(get_post_meta(get_the_ID(),'rit_disable_title',true)!=1){
            the_title('<h1 class="title-detail">', '</h1>');
        }
        ?>
        <div class="post-info">
            <?php echo get_the_term_list(get_the_ID(), 'category', '<span class="list-cat">', ', ', '</span> -'); ?>
            <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
        </div>
    </div>
    <div class="post-content">
        <?php
        the_content();
        ?>
    </div>
    <?php
    get_template_part('included/templates/inpost_pagination');
    // Author bio.
        get_template_part('included/templates/tag');
        if(get_theme_mod('rit_social_sharing')!='1')
        get_template_part('included/templates/share');
        get_template_part('included/templates/post_pagination');
        if(get_theme_mod('rit_author_info')!='1'){
            get_template_part('included/templates/about_author');
        }
        if(get_theme_mod('rit_related_articles')!='1'){
            get_template_part('included/templates/related_posts');
        }
    ?>

</article><!-- #post-## -->
<?php
// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) :
comments_template('', true);
endif;
