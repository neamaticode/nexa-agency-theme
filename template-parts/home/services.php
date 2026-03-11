<?php
/**
 * Services section template part.
 *
 * @package NexaAgency
 */

$services = array(
	array(
		'icon'  => '🎨',
		'title' => esc_html__( 'Web Design', 'nexa-agency' ),
		'desc'  => esc_html__( 'Stunning, conversion-focused websites that captivate your audience and reflect your brand identity with pixel-perfect precision.', 'nexa-agency' ),
	),
	array(
		'icon'  => '📱',
		'title' => esc_html__( 'Mobile Apps', 'nexa-agency' ),
		'desc'  => esc_html__( 'Native and cross-platform mobile applications for iOS and Android that deliver seamless user experiences and drive engagement.', 'nexa-agency' ),
	),
	array(
		'icon'  => '📈',
		'title' => esc_html__( 'SEO & Marketing', 'nexa-agency' ),
		'desc'  => esc_html__( 'Data-driven digital marketing strategies that boost your visibility, generate qualified leads, and maximize your ROI.', 'nexa-agency' ),
	),
	array(
		'icon'  => '✨',
		'title' => esc_html__( 'Brand Identity', 'nexa-agency' ),
		'desc'  => esc_html__( 'Comprehensive brand identity systems — logo, colors, typography, and guidelines — that make you instantly recognizable.', 'nexa-agency' ),
	),
	array(
		'icon'  => '🖥️',
		'title' => esc_html__( 'UI/UX Design', 'nexa-agency' ),
		'desc'  => esc_html__( 'User-centered interface design that turns complex workflows into intuitive, delightful experiences users love.', 'nexa-agency' ),
	),
	array(
		'icon'  => '☁️',
		'title' => esc_html__( 'Cloud Solutions', 'nexa-agency' ),
		'desc'  => esc_html__( 'Scalable cloud infrastructure and DevOps solutions that keep your applications fast, secure, and always available.', 'nexa-agency' ),
	),
);
?>
<section id="services" class="nexa-section nexa-services" aria-label="<?php esc_attr_e( 'Our Services', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'What We Do', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'Services That', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Move Businesses', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( 'From strategy to execution, we offer end-to-end digital services designed to transform your business and accelerate growth.', 'nexa-agency' ); ?>
			</p>
		</header>

		<div class="nexa-services__grid animate-stagger">
			<?php foreach ( $services as $index => $service ) : ?>
				<div
					class="nexa-service-card nexa-card"
					data-aos="fade-up"
					data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
				>
					<div class="nexa-service-card__icon" aria-hidden="true">
						<?php echo esc_html( $service['icon'] ); ?>
					</div>
					<h3 class="nexa-service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="nexa-service-card__description"><?php echo esc_html( $service['desc'] ); ?></p>
					<a href="#contact" class="nexa-service-card__link">
						<?php esc_html_e( 'Learn More', 'nexa-agency' ); ?>
						<span aria-hidden="true">&#8594;</span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section><!-- #services -->
