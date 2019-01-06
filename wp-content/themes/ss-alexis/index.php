<?php get_header(); ?>
<div class="wrap">
	<?php
	if (have_posts()):
		while (have_posts()): the_post();
			get_template_part('template-parts/content', get_post_type());
		endwhile;
	else :
		get_template_part('template-parts/content', 'none');
	endif;
	the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('Previous', 'ss-alexis'),
    'next_text' => __('Next', 'ss-alexis'),
	));
	?>
</div>
<?php get_footer(); ?>
