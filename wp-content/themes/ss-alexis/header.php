<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- primary header - desc & primary menu -->
<header id="header">

	<!-- primary menu -->
	<?php if (has_nav_menu('primary')): ?>
			<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
			<button id="hamburger" type="button">
				<span id="hamburger-box">
					<span id="hamburger-inner"></span>
				</span>
			</button>
	<?php endif; ?>

		<!-- site name & description -->
		<div id="header-branding">
			<?php
			$custom_logo = get_theme_mod('custom_logo');
			$image = wp_get_attachment_image_src($custom_logo , 'full');
			if ($custom_logo): ?>
				<a id="header-name" href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
				</a>
			<?php else:	?>
				<a id="header-name" href="<?php echo esc_url(home_url('/')); ?>">
					<?php echo esc_html(get_bloginfo('name')); ?>
				</a>
				<?php $description = get_bloginfo('description'); ?>
				<?php if ($description): ?>
					<div id="header-tagline"><?php echo esc_html($description); ?></div>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<!-- site overview (frontpage) -->
		<?php if (is_front_page()): ?>
			<?php if(get_theme_mod('ssalexis_text_overview') != '' ): ?>
				<div class="wrap">
					<h1><?php echo esc_html(get_theme_mod('ssalexis_text_overview')); ?></h1>
				</div>
			<?php endif; ?>
		<?php endif; ?>

</header>
