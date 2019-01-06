<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'frontier_before_body' ); ?>

	<?php if ( is_active_sidebar( 'widgets_body' ) ) dynamic_sidebar( 'widgets_body' ); ?>

<div id="container" class="cf" <?php frontier_schema( 'container' ); ?>>
	<?php do_action( 'frontier_before_container' ); ?>

	<?php if ( frontier_option( 'top_bar_enable', 1) == 1 ) : ?>
		<?php $bar_elements = frontier_option( 'top_bar_elements' ); ?>

		<div id="top-bar" class="cf">
			<?php do_action( 'frontier_before_top_bar' ); ?>

			<div id="top-bar-info">
				<?php if ( !isset($bar_elements['title']) || $bar_elements['title'] == 1 ) : ?>
					<?php $htag = ( is_singular() && !is_home() ) ? 'h2' : 'h1'; ?>
					<?php echo '<' . $htag . ' id="site-title">'; ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo apply_filters( 'frontier_top_bar_title', get_bloginfo( 'name' ) ); ?></a><?php echo '</' . $htag . '>'; ?>
				<?php endif; ?>

				<?php if ( !isset($bar_elements['description']) || $bar_elements['description'] == 1 ) : ?>
					<h4 id="site-description"><?php echo apply_filters( 'frontier_top_bar_description', get_bloginfo( 'description' ) ); ?></h4>
				<?php endif; ?>
			</div>

			<?php if ( isset( $bar_elements['top_menu'] ) && $bar_elements['top_menu'] == 1 ) : ?>
				<nav id="nav-top">
					<?php wp_nav_menu( array(
						'theme_location'	=> 'frontier-menu-top',
						'container'			=> false,
						'menu_class' 		=> 'nav-top',
						'depth'  			=> 1,
						'fallback_cb'		=> false ) );
					?>
				</nav>
			<?php endif; ?>

			<?php do_action( 'frontier_after_top_bar' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( frontier_option( 'header_enable', 1) == 1 ) : ?>
		<div id="header" class="cf" <?php frontier_schema( 'header' ); ?>>
			<?php do_action( 'frontier_before_header' ); ?>

			<?php if ( frontier_option( 'header_logo', get_template_directory_uri() . '/images/logo.png' ) ) : ?>
				<div id="header-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo frontier_option( 'header_logo', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" /></a>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'widgets_header' ) ) dynamic_sidebar( 'widgets_header' ); ?>

			<?php do_action( 'frontier_after_header' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( frontier_option( 'main_menu_enable', 1) == 1 ) : ?>
		<?php $menu_style = frontier_option( 'main_menu_style', 'drop' ); ?>

		<nav id="nav-main" class="cf <?php echo $menu_style; ?>" <?php frontier_schema( 'nav-main' ); ?>>
			<?php do_action( 'frontier_before_menu' ); ?>

			<?php if ( $menu_style == 'drop' ) : ?>
				<a href="#" class="drop-toggle"><span class="genericon genericon-menu"></span></a>
			<?php endif; ?>

			<?php wp_nav_menu( array(
				'theme_location' 	=> 'frontier-menu-primary',
				'container' 		=> false,
				'menu_class' 		=> 'nav-main',
				'fallback_cb'		=> 'wp_page_menu' ) );
			?>

			<?php do_action( 'frontier_after_menu' ); ?>
		</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'widgets_below_menu' ) ) : ?>
		<div id="below-menu" class="cf">
			<div id="widgets-wrap-below-menu" class="cf"><?php dynamic_sidebar( 'widgets_below_menu' ); ?></div>
		</div>
	<?php endif; ?>

<div id="main" class="<?php echo frontier_option( 'column_layout', 'col-cs' ); ?> cf">
<?php do_action( 'frontier_before_main' ); ?>