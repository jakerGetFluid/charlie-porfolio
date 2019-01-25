<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
get_header();

$rit_sidebar = $rit_class_main = $rit_class_content = $rit_class_sidebar = $rit_layout_item = '';
$rit_sidebar = get_theme_mod('rit_default_sidebar', 'right-sidebar');
$rit_class_content = $rit_sidebar;

if ($rit_sidebar == 'no-sidebar') {
	$rit_class_main = 'col-sm-12';
} elseif ($rit_sidebar == 'right-sidebar'||$rit_sidebar == 'left-sidebar') {
	$rit_class_main = 'col-sm-9';
} else {
	$rit_class_main = 'col-sm-6';
}
$rit_layout = get_theme_mod('rit_default_layout', 'grid');
if ($rit_layout != 'masonry') {
	$rit_layout_item = $rit_layout;
} else {
	$rit_layout_item = 'grid';
	$rit_class_main .= " rit-blog-masonry";
	wp_enqueue_script('isotope');
}
wp_enqueue_script('lazyload-master');
?>
	<main id="main-page" class="wrap-main-archive">
		<div class="container">
			<div id="primary" class="content-area row <?php echo esc_attr($rit_class_content); ?>">
				<?php if ($rit_sidebar == 'left-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
				<div id="main" class="site-main <?php echo esc_attr($rit_class_main); ?>">
					<?php
					get_template_part('author','bio');
					if ($rit_layout != 'list') { ?>
					<div class="rit-blog-grid-layout <?php echo esc_attr('layout-' . get_theme_mod('rit_default_post_col', 3) . '-col') ?> row">
						<?php
						}
						if (have_posts()) :
							// Start the Loop.
							//Service post type
							while (have_posts()) : the_post();
								/*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
								get_template_part('content', $rit_layout_item);
							endwhile;
						// End the loop.
						// If no content, include the "No posts found" template.
						else :
							get_template_part('content', 'none');
						endif;
						if ($rit_layout != 'list') {
							echo '</div>';
						}
						//Pagination
						// Previous/next page navigation.
						get_template_part('/included/templates/pagination');
						?>
					</div>
					<?php if ($rit_sidebar == 'right-sidebar' || $rit_sidebar == 'both-sidebar') { ?>
						<?php get_sidebar('right'); ?>
					<?php } ?>
				</div><!-- .content-area -->
			</div>
	</main><!-- .site-main -->
<?php get_footer();