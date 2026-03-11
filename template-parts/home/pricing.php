<?php
/**
 * Pricing section template part.
 *
 * @package NexaAgency
 */

$plans = array(
	array(
		'name'     => esc_html__( 'Basic', 'nexa-agency' ),
		'price'    => '29',
		'period'   => esc_html__( '/month', 'nexa-agency' ),
		'featured' => false,
		'badge'    => '',
		'features' => array(
			array( 'text' => esc_html__( '5 Page Website', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Mobile Responsive', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Basic SEO Setup', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( '3 Revisions', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'E-Commerce Features', 'nexa-agency' ), 'included' => false ),
			array( 'text' => esc_html__( 'Priority Support', 'nexa-agency' ), 'included' => false ),
			array( 'text' => esc_html__( 'Custom Integrations', 'nexa-agency' ), 'included' => false ),
		),
		'cta_text' => esc_html__( 'Get Started', 'nexa-agency' ),
		'cta_class' => 'nexa-btn--outline',
	),
	array(
		'name'     => esc_html__( 'Pro', 'nexa-agency' ),
		'price'    => '79',
		'period'   => esc_html__( '/month', 'nexa-agency' ),
		'featured' => true,
		'badge'    => esc_html__( 'Most Popular', 'nexa-agency' ),
		'features' => array(
			array( 'text' => esc_html__( '15 Page Website', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Mobile Responsive', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Advanced SEO Package', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Unlimited Revisions', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'E-Commerce Features', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Priority Support', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Custom Integrations', 'nexa-agency' ), 'included' => false ),
		),
		'cta_text' => esc_html__( 'Get Pro', 'nexa-agency' ),
		'cta_class' => 'nexa-btn--primary',
	),
	array(
		'name'     => esc_html__( 'Enterprise', 'nexa-agency' ),
		'price'    => '149',
		'period'   => esc_html__( '/month', 'nexa-agency' ),
		'featured' => false,
		'badge'    => '',
		'features' => array(
			array( 'text' => esc_html__( 'Unlimited Pages', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Mobile Responsive', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Full SEO & Marketing', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Unlimited Revisions', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'E-Commerce Features', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Dedicated Support Manager', 'nexa-agency' ), 'included' => true ),
			array( 'text' => esc_html__( 'Custom Integrations', 'nexa-agency' ), 'included' => true ),
		),
		'cta_text' => esc_html__( 'Contact Us', 'nexa-agency' ),
		'cta_class' => 'nexa-btn--outline',
	),
);
?>
<section id="pricing" class="nexa-section nexa-pricing" aria-label="<?php esc_attr_e( 'Pricing Plans', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'Pricing', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'Simple,', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Transparent Pricing', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( 'Choose the plan that best fits your needs. All plans include a 14-day free trial, no credit card required.', 'nexa-agency' ); ?>
			</p>
		</header>

		<div class="nexa-pricing__grid">
			<?php foreach ( $plans as $index => $plan ) : ?>
				<div
					class="nexa-pricing-card<?php echo $plan['featured'] ? ' nexa-pricing-card--featured' : ''; ?>"
					data-aos="fade-up"
					data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
				>
					<?php if ( $plan['badge'] ) : ?>
						<span class="nexa-pricing-card__badge"><?php echo esc_html( $plan['badge'] ); ?></span>
					<?php endif; ?>

					<p class="nexa-pricing-card__name"><?php echo esc_html( $plan['name'] ); ?></p>

					<div class="nexa-pricing-card__price">
						<div>
							<span class="nexa-pricing-card__currency">$</span>
							<span class="nexa-pricing-card__amount"><?php echo esc_html( $plan['price'] ); ?></span>
						</div>
						<p class="nexa-pricing-card__period"><?php echo esc_html( $plan['period'] ); ?></p>
					</div>

					<ul class="nexa-pricing-card__features">
						<?php foreach ( $plan['features'] as $feature ) : ?>
							<li class="nexa-pricing-card__feature">
								<span class="nexa-pricing-card__feature-icon nexa-pricing-card__feature-icon--<?php echo $feature['included'] ? 'yes' : 'no'; ?>" aria-hidden="true">
									<?php echo $feature['included'] ? '✓' : '✕'; ?>
								</span>
								<span><?php echo esc_html( $feature['text'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>

					<a href="#contact" class="nexa-btn nexa-pricing-card__cta <?php echo esc_attr( $plan['cta_class'] ); ?>">
						<?php echo esc_html( $plan['cta_text'] ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section><!-- #pricing -->
