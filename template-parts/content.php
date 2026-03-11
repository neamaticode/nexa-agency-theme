<?php
/**
 * Template part for displaying posts.
 *
 * @package NexaAgency
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexa-post-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="nexa-post-card__image">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
				<?php the_post_thumbnail( 'nexa-card', array( 'alt' => '' ) ); ?>
			</a>
		</div>
	<?php else : ?>
		<div class="nexa-post-card__image">
			<div class="nexa-post-card__image-placeholder">📝</div>
		</div>
	<?php endif; ?>

	<div class="nexa-post-card__body">
		<div class="nexa-post-card__meta">
			<span class="nexa-post-card__category"><?php the_category( ', ' ); ?></span>
			<span class="nexa-post-card__date"><?php echo esc_html( get_the_date() ); ?></span>
		</div>
		<h2 class="nexa-post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="nexa-post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php the_permalink(); ?>" class="nexa-btn nexa-btn--outline nexa-btn--sm">
			<?php esc_html_e( 'Read More', 'nexa-agency' ); ?>
		</a>
	</div>

</article>
