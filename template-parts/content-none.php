<?php
/**
 * Template part for displaying no results.
 *
 * @package NexaAgency
 */
?>
<section class="nexa-no-results">
	<div class="nexa-no-results__icon" aria-hidden="true">🔍</div>
	<h2 class="nexa-no-results__title">
		<?php esc_html_e( 'Nothing Found', 'nexa-agency' ); ?>
	</h2>
	<p class="nexa-no-results__text">
		<?php
		if ( is_search() ) {
			esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nexa-agency' );
		} else {
			esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'nexa-agency' );
		}
		?>
	</p>
	<?php get_search_form(); ?>
</section>
