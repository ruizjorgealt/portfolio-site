<?php
/**
 * The Template for displaying all single posts.
 *
 * @package crumbs
 * @since 1.0.0
 */

get_header();

while ( have_posts() ):
	the_post();

	get_template_part( 'template-parts/content', 'single' );

	the_post_navigation();

	crumbs_related_posts();
endwhile;

get_footer();