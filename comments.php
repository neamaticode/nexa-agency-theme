<?php
/**
 * Comments template.
 *
 * @package NexaAgency
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="nexa-comments">

	<?php if ( have_comments() ) : ?>

		<h2 class="nexa-comments-title">
			<?php
			$nexa_comment_count = get_comments_number();
			printf(
				/* translators: 1: Comment count, 2: Post title */
				esc_html( _nx( '%1$s Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', $nexa_comment_count, 'comments title', 'nexa-agency' ) ),
				esc_html( number_format_i18n( $nexa_comment_count ) ),
				'<span>' . esc_html( get_the_title() ) . '</span>'
			);
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="nexa-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 50,
					'item_class'  => 'nexa-comment',
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="nexa-comments-closed">
				<?php esc_html_e( 'Comments are closed.', 'nexa-agency' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply_before' => '<h2 id="reply-title" class="nexa-comments-title">',
			'title_reply_after'  => '</h2>',
			'title_reply'        => esc_html__( 'Leave a Comment', 'nexa-agency' ),
			'cancel_reply_link'  => esc_html__( 'Cancel reply', 'nexa-agency' ),
			'label_submit'       => esc_html__( 'Post Comment', 'nexa-agency' ),
			'comment_field'      => '<p class="comment-form-comment">' .
				'<label for="comment">' . esc_html__( 'Comment', 'nexa-agency' ) . ' <span class="required">*</span></label>' .
				'<textarea id="comment" name="comment" class="nexa-form__textarea" cols="45" rows="6" maxlength="65525" required></textarea></p>',
			'class_form'         => 'comment-form nexa-form',
			'class_submit'       => 'nexa-btn nexa-btn--primary',
		)
	);
	?>

</div><!-- #comments -->
