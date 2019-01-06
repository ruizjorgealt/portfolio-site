<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>

	<div class="content-spacing">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="entry-thumbnail">
				<?php echo get_the_post_thumbnail( null, 'crumbs-listing', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</div>
		<?php } ?>

		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="entry-date"><?php crumbs_posted_on(); ?></p>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>

			<?php wp_link_pages( array(
				'before' => '<div class="page-link">' . __( 'Pages:', 'crumbs' ),
				'after'  => '</div>'
			) ); ?>
		</div>
	</div>

	<?php if ( ! is_page() ) { ?>
		<footer class="entry-meta">
			<div class="cats">
				<?php crumbs_the_categories( '', ', ' ); ?>
			</div>
			<div class="tags">
				<?php the_tags( '<i class="fa fa-tags"></i>', ', ' ); ?>
			</div>
		</footer>
	<?php } ?>

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>

</article>
