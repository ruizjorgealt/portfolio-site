<?php
/**
 * The template for displaying Archive pages.
 *
 * @package crumbs
 * @since 1.0.0
 */

get_header();

if ( have_posts() ):

	the_archive_title( '<h1 class="page-title">', '</h1>' );
	the_archive_description( '<div class="taxonomy-description">', '</div>' );

	while ( have_posts() ):
		the_post();

		get_template_part( 'template-parts/content' );
	endwhile;

	crumbs_pagination();

else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();