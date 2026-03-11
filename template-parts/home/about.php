<?php
/**
 * About section template part.
 *
 * @package NexaAgency
 */

$title       = nexa_get_customizer( 'about_title', esc_html__( 'We Are a Team of Creative Problem Solvers', 'nexa-agency' ) );
$subtitle    = nexa_get_customizer( 'about_subtitle', esc_html__( 'About NexaAgency', 'nexa-agency' ) );
$description = nexa_get_customizer( 'about_description', esc_html__( "Founded in 2016, NexaAgency has grown into one of the most trusted digital partners for ambitious brands. We combine strategic thinking with world-class design and engineering to deliver results that matter. Our multidisciplinary team brings together experts in design, development, marketing, and strategy — all under one roof.", 'nexa-agency' ) );
$btn_text    = nexa_get_customizer( 'about_btn_text', esc_html__( 'Learn Our Story', 'nexa-agency' ) );
$btn_url     = nexa_get_customizer( 'about_btn_url', '#contact' );
$about_image = nexa_get_customizer( 'about_image', '' );

$features = array(
	esc_html__( 'Results-driven approach with measurable KPIs', 'nexa-agency' ),
	esc_html__( 'Dedicated project manager for every client', 'nexa-agency' ),
	esc_html__( 'Agile methodology with transparent communication', 'nexa-agency' ),
	esc_html__( 'Post-launch support and optimization included', 'nexa-agency' ),
	esc_html__( 'ISO-quality processes and industry best practices', 'nexa-agency' ),
);
?>
<section id="about" class="nexa-section nexa-about" aria-label="<?php esc_attr_e( 'About Us', 'nexa-agency' ); ?>">
	<div class="nexa-container">
		<div class="nexa-about__inner">

			<!-- Text Side -->
			<div class="nexa-about__text-side" data-aos="fade-right">
				<span class="nexa-eyebrow nexa-about__eyebrow"><?php echo esc_html( $subtitle ); ?></span>
				<h2 class="nexa-about__title">
					<?php echo esc_html( $title ); ?>
				</h2>
				<p class="nexa-about__text"><?php echo esc_html( $description ); ?></p>

				<ul class="nexa-about__features">
					<?php foreach ( $features as $feature ) : ?>
						<li class="nexa-about__feature">
							<span class="nexa-about__feature-icon" aria-hidden="true">✓</span>
							<?php echo esc_html( $feature ); ?>
						</li>
					<?php endforeach; ?>
				</ul>

				<?php if ( $btn_text && $btn_url ) : ?>
					<a href="<?php echo esc_url( $btn_url ); ?>" class="nexa-btn nexa-btn--primary">
						<?php echo esc_html( $btn_text ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Visual Side -->
			<div class="nexa-about__visual" data-aos="fade-left" data-aos-delay="150">
				<div class="nexa-about__image-wrap">
					<?php if ( $about_image ) : ?>
						<img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'About NexaAgency', 'nexa-agency' ); ?>">
					<?php else : ?>
						<div class="nexa-about__placeholder" aria-hidden="true">🏢</div>
					<?php endif; ?>
				</div>
				<div class="nexa-about__badge">
					<div class="nexa-about__badge-number">8+</div>
					<div class="nexa-about__badge-text"><?php esc_html_e( 'Years of Excellence', 'nexa-agency' ); ?></div>
				</div>
			</div>

		</div>
	</div>
</section><!-- #about -->
