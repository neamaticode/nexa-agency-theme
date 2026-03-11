<?php
/**
 * 404 template.
 *
 * @package NexaAgency
 */

get_header();
?>
<main id="main" class="nexa-main">
	<div class="nexa-404">
		<div>
			<div class="nexa-404__number" aria-hidden="true">404</div>
			<h1 class="nexa-404__title"><?php esc_html_e( 'Page Not Found', 'nexa-agency' ); ?></h1>
			<p class="nexa-404__text">
				<?php esc_html_e( "Oops! The page you're looking for doesn't exist or has been moved. Let's get you back on track.", 'nexa-agency' ); ?>
			</p>

			<div class="nexa-404__actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexa-btn nexa-btn--primary nexa-btn--lg">
					<?php esc_html_e( '&#8592; Back to Home', 'nexa-agency' ); ?>
				</a>
				<a href="#contact" class="nexa-btn nexa-btn--outline nexa-btn--lg">
					<?php esc_html_e( 'Contact Support', 'nexa-agency' ); ?>
				</a>
			</div>

			<?php get_search_form(); ?>
		</div>
	</div>
</main>
<?php
get_footer();
