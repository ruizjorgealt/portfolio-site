<?php
/**
 * The template for displaying the footer.
 *
 * @package crumbs
 * @since 1.0.0
 */
?>
</div>
<?php get_sidebar( 'footer' ); ?>
<div class="site-info">
	<?php crumbs_social_buttons(); ?>

	&copy; <?php echo date_i18n( __( 'Y', 'crumbs' ) ); ?> <?php bloginfo( 'name' ); ?> &middot;
	<?php printf( __( '%1$s Theme by %2$s', 'crumbs' ), 'Crumbs', '<a href="https://wpcrumbs.com" title="Awesome Wordpress snippets, tutorials and free themes">WPCrumbs</a>' ); ?></li>
</div>
<?php wp_footer(); ?>
</body>
</html>
