<?php

get_header(); ?>

<div id="primary" class="content-area container">
	<main id="main" class="site-main">

		<section class="error-404 not-found">
			<h1 class="page-title"><?php echo esc_html__('404', 'ri-fusion'); ?></h1>
			<div class="mess"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ri-fusion' ); ?></div>
			<div class="entry-action">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flat-btn btn"><?php echo esc_html__('Go To Home', 'ri-fusion'); ?></a>
			</div>
		</section><!-- .error-404 -->

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
