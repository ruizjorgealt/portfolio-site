<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (is_singular()): ?>
			<h1><?php the_title(); ?></h1>
			<?php
				if (has_post_thumbnail()):
					the_post_thumbnail();
				endif;
			?>
			<?php the_content(); ?>
			<?php the_tags('<ul id="post-tags"><li>#', '</li><li>#', '</li></ul>'); ?>
			<?php wp_link_pages(); ?>
		<?php else: ?>
			<div class="teaser">
				<div class="teaser-header">
					<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title('<h3 class="teaser-heading">', '</h3>'); ?> - <?php echo get_the_date(); ?></a>
				</div>
				<div class="teaser-excerpt">
					<?php
						if (has_post_thumbnail()):
							the_post_thumbnail('thumbnail');
						endif;
					?>
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php endif; ?>
</article>
