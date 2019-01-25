<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
?>

<section class="no-results not-found col-xs-12">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'ri-fusion' ); ?></h2>
	</header><!-- .page-header -->
	<div class="wrap-not-found">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ri-fusion' ), array('a' => array('href' => array()))), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ri-fusion' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ri-fusion' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
