<?php
/**
 * Template part for displaying single post content.
 *
 * @package NexaAgency
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexa-single-post' ); ?>>

	<header class="nexa-single-post__header">

		<div class="nexa-single-post__meta">
			<?php the_category( ', ' ); ?>
			<span><?php echo esc_html( get_the_date() ); ?></span>
			<span>
				<?php
				printf(
					/* translators: %s: Author name */
					esc_html__( 'By %s', 'nexa-agency' ),
					esc_html( get_the_author() )
				);
				?>
			</span>
		</div>

		<h1 class="nexa-single-post__title"><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="nexa-single-post__thumbnail">
				<?php the_post_thumbnail( 'nexa-hero', array( 'alt' => get_the_title() ) ); ?>
			</div>
		<?php endif; ?>

	</header>

	<div class="nexa-entry-content nexa-single-post__content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="nexa-page-links">' . esc_html__( 'Pages:', 'nexa-agency' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="nexa-single-post__footer">
		<?php
		the_tags(
			'<div class="nexa-post-tags">',
			', ',
			'</div>'
		);
		?>
	</footer>

</article>
