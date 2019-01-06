<?php

// setup theme
if (!function_exists('ssalexis_setup')):
	function ssalexis_setup() {
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-logo');
		add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  	add_editor_style(get_template_directory_uri() . '/assets/css/editor.css');
		register_nav_menus(array(
			'primary' => esc_html__('Primary', 'ss-alexis'),
			'footer' => esc_html__('Footer', 'ss-alexis'),
		));
		if (!isset($content_width)) $content_width = 800;
	}
endif;
add_action('after_setup_theme', 'ssalexis_setup');

// load css and javascript
function ssalexis_enqueue() {
    wp_enqueue_style('ss-alexis-style', get_stylesheet_uri());
		wp_enqueue_style('ss-alexis-fonts', 'https://fonts.googleapis.com/css?family=Sunflower:300,700', false);
    wp_enqueue_script('ss-alexis-scripts', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script( 'comment-reply' );
		}
}
add_action('wp_enqueue_scripts', 'ssalexis_enqueue');

// appearance customizer
function ssalexis_customize_register($wp_customize) {
	// homepage header overview text
	$wp_customize->add_setting('ssalexis_text_overview', array(
		'default' => esc_html__('Edit or remove this text in the "Appearance" -> "Customize" settings.', 'ss-alexis'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('ssalexis_text_overview', array(
		'label' => esc_html__('Overview', 'ss-alexis'),
		'type' => 'text',
		'section' => 'title_tagline',
		'description' => __('Displayed in the header on the homepage.', 'ss-alexis'),
	));
	$wp_customize->add_setting('ssalexis_primary_color', array(
    'default' => '#01579B',
    'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ssalexis_primary_color', array(
		'label' => esc_html__('Primary Color', 'ss-alexis'),
		'section' => 'colors',
		'settings' => 'ssalexis_primary_color',
	)));
}
add_action('customize_register', 'ssalexis_customize_register');

// output customizer settings
function ssalexis_customize_css() {
	echo '<style type="text/css">';
	echo '#header .menu, #header h1 {background-color:' . esc_html(get_theme_mod('ssalexis_primary_color', '#01579B')) . ';}';
	echo 'a, #header-tagline, .teaser-heading, .teaser-header a {color:' . esc_html(get_theme_mod('ssalexis_primary_color', '#01579B')) . ';}';
	echo '</style>';
}
add_action('wp_head', 'ssalexis_customize_css');

// widgets
function ssalexis_widgets_init() {
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', 'ssalexis_widgets_init');

?>
