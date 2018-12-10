<?php
/**
 * Crumbs functions.php
 *
 * @package crumbs
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 600; // width 680px - content/article padding 80px
}

/**
 * REQUIRES
 */
require_once get_parent_theme_file_path( '/includes/common.php' );
require_once get_parent_theme_file_path( '/includes/comments.php' );
require_once get_parent_theme_file_path( '/includes/admin.php' );
require_once get_parent_theme_file_path( '/includes/customizer.php' );

/**
 * ACTIONS
 */
add_action( 'after_setup_theme', 'crumbs_after_theme_setup' );
add_action( 'wp_enqueue_scripts', 'crumbs_enqueue_assets' );
add_action( 'admin_notices', 'crumbs_admin_notices' );
add_action( 'customize_register', 'crumbs_customize_register' );
add_action( 'customize_preview_init', 'crumbs_customize_preview_js' );
add_action( 'wp_head', 'crumbs_pingback_header' );

/**
 * FILTERS
 */
add_filter( 'comment_form_defaults', 'crumbs_comment_form_defaults' );