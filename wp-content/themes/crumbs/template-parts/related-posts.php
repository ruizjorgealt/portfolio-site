<?php if ( ! empty( $related_posts ) ) { ?>
	<div class="related-posts">
		<h3 class="widget-title"><?php esc_html_e( 'Related articles', 'crumbs' ); ?></h3>

		<ul class="related-posts-list">
			<?php
			foreach ( $related_posts as $post ) {
				setup_postdata( $post );
				?>
				<li>
					<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="thumb">
								<?php echo get_the_post_thumbnail( null, 'thumbnail', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
							</div>
						<?php } ?>
						<h4><?php the_title(); ?></h4>
					</a>
				</li>
			<?php } ?>
		</ul>
		<div class="clear"></div>
	</div>
	<?php
}