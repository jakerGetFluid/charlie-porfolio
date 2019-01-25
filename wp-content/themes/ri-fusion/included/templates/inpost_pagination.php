<?php
/**
 * The pagination for content post, page
 * Used for both single and page. Page Break / <!--nextpage-->
 *
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
wp_link_pages( array(
    'before'      => '<div class="wrap-pagination inpost-pagination"><div class="pagination clearfix"> ',
    'after'       => '</div></div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '%',
    'separator'   => '',
) );