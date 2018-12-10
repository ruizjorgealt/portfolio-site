<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>

	<div class="content-spacing">
		<?php if ( has_post_thumbnail() ) { ?>
			<a class="entry-thumbnail" href="<?php the_permalink(); ?>">
				<?php echo get_the_post_thumbnail( null, 'crumbs-listing', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</a>
		<?php } ?>

		<header>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
			<p class="entry-date"><?php crumbs_posted_on(); ?></p>
		</header>

		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-meta">
		<div class="comments-nr">
			<?php crumbs_comments_link( '<i class="fa fa-comments"></i>' ); ?>
		</div>

		<div class="more">
			<a href="<?php the_permalink(); ?>" class="read" title="<?php the_title_attribute( array( 'before' => __( 'Read more: ', 'crumbs' ) ) ); ?>"><?php esc_html_e( 'Read more', 'crumbs' ); ?></a>
		</div>
	</footer>

</article>
