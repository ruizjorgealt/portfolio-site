<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="site-header">
	<div id="first-row">
		<div class="container">
			<?php
			// Display the Custom Logo
			the_custom_logo();

			// No Custom Logo, just display the site's name
			if ( ! has_custom_logo() ) {
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
				<?php else : ?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</p>
					<?php
				endif;
			}

			// Header menu
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'menu',
				'depth'          => 1,
				'fallback_cb'    => 'crumbs_menu_fallback'
			) );
			?>
		</div>
	</div>

	<div class="container" id="featured-area">
		<?php get_sidebar(); ?>
	</div>
</header>

<div id="content" class="container<?php echo is_single() ? ' single' : ''; ?>">