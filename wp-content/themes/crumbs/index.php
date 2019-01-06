<?php
/**
 * The main template file.
 *
 * @package crumbs
 * @since 1.0.0
 */

get_header();

if ( have_posts() ):

	while ( have_posts() ):
		the_post();

		get_template_part( 'template-parts/content' );
	endwhile;

	crumbs_pagination();

else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();