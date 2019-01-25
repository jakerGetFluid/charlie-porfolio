<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
the_content();
get_template_part('included/templates/inpost_pagination');
edit_post_link(esc_html(__('Edit', 'ri-fusion')), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->');