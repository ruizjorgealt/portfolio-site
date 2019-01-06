<?php get_header(); ?>
<div class="wrap">
	<?php
		while (have_posts()): the_post();
			get_template_part('template-parts/content', get_post_type());
			if (comments_open() || get_comments_number()):
				comments_template();
			endif;
		endwhile; 
	?>
</div>
<?php get_footer(); ?>
