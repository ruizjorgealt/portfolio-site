<article class="article error">

	<div class="content-spacing">
		<?php if ( is_404() ): ?>
			<img src="<?php echo get_theme_file_uri( 'assets/img/404.jpg' ); ?>"/>
		<?php elseif ( is_search() ) : ?>
			<?php esc_html_e( 'No posts found based on searched keywords.', 'crumbs' ); ?>
			<br/><br/>
		<?php else : ?>
			<?php esc_html_e( 'No posts found.', 'crumbs' ); ?>
			<br/><br/>
		<?php endif; ?>
		<div class="clear"><br/></div>

		<a href="<?php echo esc_url( home_url() ); ?>" class="more"><?php esc_html_e( 'Go to the homepage', 'crumbs' ); ?></a>
		<div class="clear"><br/></div>
	</div>

</article>
