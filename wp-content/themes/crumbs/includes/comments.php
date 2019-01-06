<?php

/**
 * Comment template
 *
 * @param object $comment
 * @param array $args
 * @param int $depth
 */
function crumbs_single_comment( $comment, $args, $depth ) {
	?>
<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
	<?php echo get_avatar( $comment, 75 ); ?>

	<div class="comment-content">
		<?php comment_author_link(); ?>

		<small><?php printf( esc_html__( '%1$s at %2$s', 'crumbs' ), get_comment_date(), get_comment_time() ); ?></small>

		<?php comment_text(); ?>

		<?php if ( $comment->comment_approved === '0' ) { ?>
			<em class="not-approved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'crumbs' ); ?></em>
		<?php } ?>

		<div class="comment-actions">
			<?php
			echo get_comment_reply_link( array(
				'add_below'  => 'div-after-comment',
				'depth'      => $depth,
				'max_depth'  => $args['max_depth'],
				'reply_text' => sprintf( '<i class="fa fa-mail-reply"></i> %s', esc_html__( 'Reply', 'crumbs' ) )
			), $comment->comment_ID, $comment->comment_post_ID
			);

			edit_comment_link( sprintf( '<i class="fa fa-pencil"></i> %s', esc_html__( 'Edit', 'crumbs' ) ) );
			?>
		</div>
	</div>
	<div id="div-after-comment-<?php comment_ID(); ?>" class="clear"></div>
	<hr class="separator"/>
	<?php
}

/**
 * Alter contact form default
 *
 * @param array $args
 *
 * @return array
 */
function crumbs_comment_form_defaults( $args ) {
	$req       = get_option( 'require_name_email' );
	$aria_req  = $req ? " aria-required='true'" : '';
	$commenter = wp_get_current_commenter();
	$html5     = 'html5' === $args['format'];

	$args['label_submit'] = __( 'Send', 'crumbs' );

	$args['comment_field']        = '<textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__( 'Comment', 'crumbs' ) . '"></textarea>';
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';

	$args['fields']['author']       = '<div class="info"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name', 'crumbs' ) . '"' . $aria_req . '/>';
	$args['fields']['email']        = '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email', 'crumbs' ) . '"' . $aria_req . '/>';
	$args['fields']['url']          = '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'crumbs' ) . '"/></div>';
	$args['fields']['clear_floats'] = '<div class="clear"></div>';

	return $args;
}

/**
 * Display post comments_link
 *
 * @param string $before
 * @param string $after
 */
function crumbs_comments_link( $before = '', $after = '' ) {
	$link = sprintf( '<a href="%s" title="%s">%s</a>', get_comments_link(), esc_attr__( 'View post comments', 'crumbs' ), get_comments_number_text( __( 'No Comments', 'crumbs' ), __( '1 Comment', 'crumbs' ), __( '% Comments', 'crumbs' ) ) );

	echo $before . $link . $after;
}
