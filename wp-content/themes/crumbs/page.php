<?php
/**
 * The template for displaying standard pages.
 *
 * @package crumbs
 * @since 1.0.0
 */

get_header();

while ( have_posts() ):
	the_post();

	get_template_part( 'template-parts/content', 'single' );
endwhile;

get_footer();