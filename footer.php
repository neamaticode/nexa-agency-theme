<?php
/**
 * Footer template.
 *
 * @package NexaAgency
 */

$footer_copyright = nexa_get_customizer( 'footer_copyright', '' );
$social_links     = nexa_social_links( false );
?>

<footer id="colophon" class="nexa-footer" role="contentinfo">

	<div class="nexa-footer__main">
		<div class="nexa-container">
			<div class="nexa-footer__grid">

				<!-- Brand Column -->
				<div class="nexa-footer__brand">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexa-footer__logo" rel="home">
							<?php
							$site_name  = get_bloginfo( 'name' );
							$name_parts = explode( ' ', $site_name, 2 );
							echo esc_html( $name_parts[0] );
							if ( isset( $name_parts[1] ) ) {
								echo '<span>' . esc_html( $name_parts[1] ) . '</span>';
							}
							?>
						</a>
					<?php endif; ?>

					<?php $footer_desc = nexa_get_customizer( 'footer_description', get_bloginfo( 'description' ) ); ?>
					<?php if ( $footer_desc ) : ?>
						<p><?php echo esc_html( $footer_desc ); ?></p>
					<?php endif; ?>

					<?php if ( $social_links ) : ?>
						<div class="nexa-footer__social">
							<?php echo $social_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Widget Areas -->
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="nexa-footer__col">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php else : ?>
					<div class="nexa-footer__col">
						<h3 class="nexa-footer__col-title"><?php esc_html_e( 'Services', 'nexa-agency' ); ?></h3>
						<nav class="nexa-footer__nav" aria-label="<?php esc_attr_e( 'Footer Services', 'nexa-agency' ); ?>">
							<a href="#"><?php esc_html_e( 'Web Design', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Mobile Apps', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'SEO & Marketing', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Brand Identity', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'UI/UX Design', 'nexa-agency' ); ?></a>
						</nav>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="nexa-footer__col">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				<?php else : ?>
					<div class="nexa-footer__col">
						<h3 class="nexa-footer__col-title"><?php esc_html_e( 'Company', 'nexa-agency' ); ?></h3>
						<nav class="nexa-footer__nav" aria-label="<?php esc_attr_e( 'Footer Company', 'nexa-agency' ); ?>">
							<a href="#"><?php esc_html_e( 'About Us', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Portfolio', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Our Team', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Blog', 'nexa-agency' ); ?></a>
							<a href="#"><?php esc_html_e( 'Contact', 'nexa-agency' ); ?></a>
						</nav>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="nexa-footer__col">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				<?php else : ?>
					<div class="nexa-footer__col">
						<h3 class="nexa-footer__col-title"><?php esc_html_e( 'Contact', 'nexa-agency' ); ?></h3>
						<div class="nexa-footer__contact-info">
							<?php $email = nexa_get_customizer( 'contact_email', '' ); ?>
							<?php if ( $email ) : ?>
								<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
							<?php endif; ?>
							<?php $phone = nexa_get_customizer( 'contact_phone', '' ); ?>
							<?php if ( $phone ) : ?>
								<p><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
							<?php endif; ?>
							<?php $address = nexa_get_customizer( 'contact_address', '' ); ?>
							<?php if ( $address ) : ?>
								<p><?php echo esc_html( $address ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

			</div><!-- .nexa-footer__grid -->
		</div><!-- .nexa-container -->
	</div><!-- .nexa-footer__main -->

	<!-- Footer Bottom Bar -->
	<div class="nexa-footer__bottom">
		<div class="nexa-container">
			<div class="nexa-footer__bottom-inner">
				<p class="nexa-footer__copyright">
					<?php
					if ( $footer_copyright ) {
						echo wp_kses_post( $footer_copyright );
					} else {
						printf(
							/* translators: 1: Year, 2: Site name */
							esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'nexa-agency' ),
							esc_html( date_i18n( 'Y' ) ),
							'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'
						);
					}
					?>
				</p>
				<nav class="nexa-footer__legal" aria-label="<?php esc_attr_e( 'Legal Links', 'nexa-agency' ); ?>">
					<a href="#"><?php esc_html_e( 'Privacy Policy', 'nexa-agency' ); ?></a>
					<a href="#"><?php esc_html_e( 'Terms of Service', 'nexa-agency' ); ?></a>
				</nav>
			</div>
		</div>
	</div><!-- .nexa-footer__bottom -->

</footer><!-- #colophon -->

<!-- Scroll to Top -->
<button class="nexa-scroll-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'nexa-agency' ); ?>">
	&#8593;
</button>

<?php wp_footer(); ?>
</body>
</html>
