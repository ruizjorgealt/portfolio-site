<?php
/**
 * The template for displaying search results.
 *
 * @package crumbs
 * @since 1.0.0
 */

get_header();

if ( have_posts() ):

	echo '<h1 class="page-title">' . sprintf( __( 'Results for : %s', 'crumbs' ), '<span>' . get_search_query() . '</span>' ) . '</h1>';

	while ( have_posts() ):
		the_post();

		get_template_part( 'template-parts/content' );
	endwhile;

	crumbs_pagination();

else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();