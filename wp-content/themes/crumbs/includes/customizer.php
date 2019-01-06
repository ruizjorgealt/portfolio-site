<?php
/**
 * Crumbs Theme Customizer.
 *
 * @package crumbs
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function crumbs_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Social Media Icons
	$social_buttons = crumbs_social_buttons_list();

	if ( ! empty( $social_buttons ) && is_array( $social_buttons ) ) {

		$section_name = 'crumbs_social_media_section';

		$wp_customize->add_section(
			$section_name,
			array(
				'title'    => __( 'Social Media Icons', 'crumbs' ),
				'priority' => 1,
			)
		);

		foreach ( $social_buttons as $network => $details ) {

			$setting_name = sprintf( 'crumbs_social_media_%s', $network );
			$control_name = sprintf( 'crumbs_sm_%s', $network );

			$wp_customize->add_setting(
				$setting_name,
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					$control_name,
					array(
						'label'    => $details['label'],
						'section'  => $section_name,
						'settings' => $setting_name,
						'type'     => 'text',
					)
				)
			);

		}

	}

	// Related posts
	$section_name = 'crumbs_related_posts';
	$setting_name = 'crumbs_related_posts_setting';
	$control_name = 'crumbs_related_posts_control';

	$wp_customize->add_section(
		$section_name,
		array(
			'title'    => __( 'Related Posts', 'crumbs' ),
			'priority' => 2,
		)
	);

	$wp_customize->add_setting(
		$setting_name,
		array(
			'sanitize_callback' => 'crumbs_sanitize_related_posts_taxonomy',
			'transport'         => 'refresh',
			'default'           => 'category'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			$control_name,
			array(
				'label'    => __( 'Get related posts by', 'crumbs' ),
				'section'  => $section_name,
				'settings' => $setting_name,
				'type'     => 'select',
				'choices'  => crumbs_related_posts_taxonomies()
			)
		)
	);
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function crumbs_customize_preview_js() {
	wp_enqueue_script( 'crumbs_customizer', get_theme_file_uri( 'assets/js/customizer.js' ), array( 'customize-preview' ), '1.0.9', true );
}

/**
 * Get taxonomies array for related_posts
 *
 * @return array
 */
function crumbs_related_posts_taxonomies() {
	$taxonomies = get_taxonomies( array(
		'public'  => true,
		'show_ui' => true
	), 'names' );

	return apply_filters( 'crumbs_related_posts_taxonomies', $taxonomies );
}

/**
 * Sanitize taxonomy for related_posts
 *
 * @param string $taxonomy_name
 *
 * @return string
 */
function crumbs_sanitize_related_posts_taxonomy( $taxonomy_name ) {
	$taxonomies = crumbs_related_posts_taxonomies();

	// set default value if taxonomy name doesn't exists
	if ( ! in_array( $taxonomy_name, $taxonomies ) ) {
		return key( $taxonomies );
	}

	return $taxonomy_name;
}

/**
 * Returns Social Buttons list
 *
 * @return array
 */
function crumbs_social_buttons_list() {
	$social_buttons = array(
		'twitter'    => array(
			'label' => __( 'Twitter URL', 'crumbs' ),
		),
		'facebook'   => array(
			'label' => __( 'Facebook URL', 'crumbs' ),
		),
		'instagram'  => array(
			'label' => __( 'Instagram URL', 'crumbs' ),
		),
		'pinterest'  => array(
			'label' => __( 'Pinterest URL', 'crumbs' ),
		),
		'snapchat'   => array(
			'label' => __( 'Snapchat URL', 'crumbs' ),
			'icon'  => 'snapchat-ghost'
		),
		'youtube'    => array(
			'label' => __( 'YouTube URL', 'crumbs' ),
			'icon'  => 'youtube-play'
		),
		'googleplus' => array(
			'label' => __( 'Google+ URL', 'crumbs' ),
			'icon'  => 'google-plus'
		)
	);

	return apply_filters( 'crumbs_social_buttons_list', $social_buttons );
}

/**
 * Displays Social Buttons
 *
 * @return
 */
function crumbs_social_buttons() {
	$social_buttons = crumbs_social_buttons_list();
	$output         = array();

	if ( empty( $social_buttons ) || ! is_array( $social_buttons ) ) {
		return;
	}

	foreach ( $social_buttons as $network => $details ) {
		$url = get_theme_mod( sprintf( 'crumbs_social_media_%s', $network ), '' );

		if ( empty( $url ) ) {
			continue;
		}

		$icon = ! empty( $details['icon'] ) ? $details['icon'] : $network;
		$item = sprintf( '<li><a href="%s"><i class="fa fa-%s"></i></a></li>', esc_url( $url ), esc_attr( $icon ) );

		$output[] = apply_filters( 'crumbs_social_buttons_item', $item, $network );
	}

	if ( empty( $output ) ) {
		return;
	}

	echo apply_filters( 'crumbs_social_buttons', '<ul class="social-buttons">' . implode( "\n", $output ) . '</ul>' );
}