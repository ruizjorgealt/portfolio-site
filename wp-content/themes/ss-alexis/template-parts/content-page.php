<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (has_post_thumbnail()):
			the_post_thumbnail();
		endif;
		the_content();
	?>
</article>
