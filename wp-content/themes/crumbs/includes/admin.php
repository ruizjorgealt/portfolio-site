<?php
/**
 * Admin functions
 *
 * @package crumbs
 * @since 1.0.0
 */

/**
 * Add admin notices
 *
 * @global string $pagenow
 */
function crumbs_admin_notices() {
	global $pagenow;

	$notices = array();

	// add notice after theme activation
	if ( $pagenow === 'themes.php' && isset( $_GET['activated'] ) ) {
		$notices['plugin-dependencies'] = array(
			'message'     => crumbs_plugin_dependencies_notice(),
			'dismissible' => true
		);
	}

	$notices = apply_filters( 'crumbs_admin_notices', $notices );

	// show notices
	foreach ( $notices as $key => $notice ) {
		if ( empty( $notice['message'] ) ) {
			continue;
		}

		$classes = array( 'updated', 'notice' );

		if ( $notice['dismissible'] ) {
			$classes[] = 'is-dismissible';
		}

		$classes = implode( ' ', $classes );

		echo '<div class="' . esc_attr( $classes ) . '">';
		echo wp_kses_post( $notice['message'] );
		echo '</div>';
	}
}

/**
 * Plugin dependencies notice
 *
 * @return string
 */
function crumbs_plugin_dependencies_notice() {
	$activated_plugins = get_option( 'active_plugins', array() );
	$required_plugins  = array(
		'mailchimp-for-wp/mailchimp-for-wp.php' => array(
			'name' => 'MailChimp for WordPress',
			'url'  => 'https://wordpress.org/plugins/mailchimp-for-wp/'
		)
	);
	$message_parts     = array();

	$message_parts[] = __( 'Crumbs recommended plugin(s):', 'crumbs' );
	$message_parts[] = '<ol>';
	foreach ( $required_plugins as $path => $plugin ) {
		$message_parts[] = sprintf(
			'<li><a href="%s" target="%s">%s</a> <small>(%s)</small></li>', esc_attr( $plugin['url'] ), esc_attr( '_blank' ), esc_html( $plugin['name'] ), in_array( $path, $activated_plugins ) ? __( 'activated', 'crumbs' ) : __( 'missing', 'crumbs' )
		);
	}
	$message_parts[] = '</ol>';

	return sprintf( '<p>%s</p>', implode( $message_parts ) );
}