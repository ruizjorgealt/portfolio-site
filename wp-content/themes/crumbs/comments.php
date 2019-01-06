<?php
/**
 * The template for displaying Comments.
 *
 * @package crumbs
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet 
 * entered the password we will not return the comments list
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="content-spacing" id="comments">
	<?php if ( have_comments() ) { ?>
		<ul class="comments">
			<?php wp_list_comments( array( 'callback' => 'crumbs_single_comment' ) ); ?>
		</ul>

		<div class="clear"></div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav">
				<div class="nav-previous"><?php previous_comments_link( __( ' &larr;  Older Comments', 'crumbs' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments  &rarr; ', 'crumbs' ) ); ?></div>
				<div class="clear"></div>
			</nav><!-- end #comment-nav -->
		<?php endif; // check for comment navigation ?>

		<div class="clear"><br/></div>

		<?php
	}

	// If comments are closed and there are comments, let's leave a little note
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'crumbs' ); ?></p>
		<?php
	}

	comment_form();
	?>
</div>
