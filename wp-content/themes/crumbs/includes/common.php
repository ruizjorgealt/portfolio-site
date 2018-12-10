<?php
/**
 * Common functions
 *
 * @package crumbs
 * @since 1.0.0
 */

/**
 * After setup theme
 */
function crumbs_after_theme_setup() {
	// Languages
	load_theme_textdomain( 'crumbs', get_theme_file_path( 'languages' ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Title tag
	add_theme_support( 'title-tag' );

	// Enable support for Custom Logo. See https://codex.wordpress.org/Theme_Logo
	add_theme_support( 'custom-logo', array(
		'width'       => 300,
		'height'      => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title' ),
	) );

	// Menus
	register_nav_menus( array(
		'primary' => __( 'Header menu', 'crumbs' )
	) );

	// Thumbnails
	add_theme_support( 'post-thumbnails' );
	$thumbs_list = array(
		'crumbs-listing' => array(
			'width'  => '600',
			'height' => '300',
			'crop'   => true,
		)
	);

	foreach ( $thumbs_list as $name => $item ) {
		add_image_size( $name, $item['width'], $item['height'], $item['crop'] );
	}

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function crumbs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Newsletter', 'crumbs' ),
		'id'            => 'sidebar-mc-newsletter',
		'description'   => esc_html__( 'Suitable for "MailChimp for WordPress" plugin widget.', 'crumbs' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer', 'crumbs' ),
		'id'            => 'sidebar-footer',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'crumbs_widgets_init' );

/**
 * Enqueue assets
 */
function crumbs_enqueue_assets() {
	// CSS
	wp_enqueue_style( 'crumbs-fontawesome', get_theme_file_uri( 'assets/css/font-awesome.min.css' ), array(), '4.7.0' );
	wp_enqueue_style( 'crumbs-style', get_stylesheet_uri(), array(), '1.1.1' );

	// Fonts
	wp_enqueue_style( 'crumbs-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,500', array() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Posts pagination
 *
 * @return
 */
function crumbs_pagination() {
	the_posts_pagination( array(
		'mid_size'  => 3,
		'prev_text' => __( '&laquo;', 'crumbs' ),
		'next_text' => __( '&raquo;', 'crumbs' ),
		'type'      => 'list'
	) );
}

/**
 * Display post categories
 *
 * @param string $before
 * @param string $separator
 * @param string $after
 */
function crumbs_the_categories( $before = '', $separator = ', ', $after = '' ) {
	$categories = get_the_category( get_the_ID() );

	$list = array();
	foreach ( $categories as $category ) {
		$title  = sprintf( __( 'View all posts in %s', 'crumbs' ), $category->name );
		$list[] = sprintf( '<a href="%s" title="%s">%s</a>', esc_url( get_category_link( $category->term_id ) ), esc_attr( $title ), esc_html( $category->cat_name ) );
	}

	if ( empty( $list ) ) {
		return;
	}

	echo $before . implode( $separator, $list ) . $after;
}

/**
 * Related posts
 *
 * @param array $args
 *
 * @global object $post
 * @return
 */
function crumbs_related_posts( $args = array() ) {
	global $post;

	// default args
	$args = wp_parse_args( $args, array(
		'post_id'   => ! empty( $post ) ? $post->ID : '',
		'taxonomy'  => get_theme_mod( 'crumbs_related_posts_setting', 'category' ),
		'limit'     => 3,
		'post_type' => ! empty( $post ) ? $post->post_type : 'post',
		'orderby'   => 'date',
		'order'     => 'DESC'
	) );

	// check taxonomy
	if ( ! taxonomy_exists( $args['taxonomy'] ) ) {
		return;
	}

	// post taxonomies
	$taxonomies = wp_get_post_terms( $args['post_id'], $args['taxonomy'], array( 'fields' => 'ids' ) );

	if ( empty( $taxonomies ) ) {
		return;
	}

	// query
	$related_posts = get_posts( apply_filters( 'crumbs_related_posts_query_args', array(
		'post__not_in'   => (array) $args['post_id'],
		'post_type'      => $args['post_type'],
		'tax_query'      => array(
			array(
				'taxonomy' => $args['taxonomy'],
				'field'    => 'term_id',
				'terms'    => $taxonomies
			),
		),
		'posts_per_page' => $args['limit'],
		'orderby'        => $args['orderby'],
		'order'          => $args['order']
	) ) );

	include( locate_template( 'template-parts/related-posts.php', false, false ) );

	wp_reset_postdata();
}

/**
 * Prints HTML with date and author of the current post
 */
function crumbs_posted_on() {
	printf( esc_html__( '%1$s by %2$s', 'crumbs' ), get_the_date( 'd F, Y' ), get_the_author_posts_link() );
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * Source: Twentyseventeen theme
 */
function crumbs_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}

/**
 * Menu fallback (when there is no menu saved)
 *
 * @param array $args
 */
function crumbs_menu_fallback( $args = array() ) {
	wp_page_menu( array(
		'depth'      => $args['depth'],
		'container'  => 'ul',
		'menu_id'    => $args['menu_id'],
		'menu_class' => $args['menu_class'],
		'before'     => '',
		'after'      => ''
	) );
}