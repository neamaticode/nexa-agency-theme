<?php
/**
 * Elementor Pricing Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaPricing_Widget class.
 */
class NexaPricing_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_pricing';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Pricing Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'nexa-agency' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing_header',
			array(
				'label' => esc_html__( 'Section Header', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'section_eyebrow',
			array(
				'label'   => esc_html__( 'Eyebrow Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Pricing', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => esc_html__( 'Section Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Simple, Transparent Pricing', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_subtitle',
			array(
				'label'   => esc_html__( 'Section Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Choose the plan that best fits your needs. All plans include a 14-day free trial, no credit card required.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		// Build plan sections for all 3 plans.
		$plan_defaults = array(
			1 => array(
				'name'      => esc_html__( 'Basic', 'nexa-agency' ),
				'price'     => '29',
				'period'    => esc_html__( '/month', 'nexa-agency' ),
				'features'  => "5 Page Website|yes\nMobile Responsive|yes\nBasic SEO Setup|yes\n3 Revisions|yes\nE-Commerce Features|no\nPriority Support|no\nCustom Integrations|no",
				'btn_text'  => esc_html__( 'Get Started', 'nexa-agency' ),
				'highlight' => '',
				'badge'     => '',
			),
			2 => array(
				'name'      => esc_html__( 'Pro', 'nexa-agency' ),
				'price'     => '79',
				'period'    => esc_html__( '/month', 'nexa-agency' ),
				'features'  => "15 Page Website|yes\nMobile Responsive|yes\nAdvanced SEO Package|yes\nUnlimited Revisions|yes\nE-Commerce Features|yes\nPriority Support|yes\nCustom Integrations|no",
				'btn_text'  => esc_html__( 'Get Pro', 'nexa-agency' ),
				'highlight' => 'yes',
				'badge'     => esc_html__( 'Most Popular', 'nexa-agency' ),
			),
			3 => array(
				'name'      => esc_html__( 'Enterprise', 'nexa-agency' ),
				'price'     => '149',
				'period'    => esc_html__( '/month', 'nexa-agency' ),
				'features'  => "Unlimited Pages|yes\nMobile Responsive|yes\nFull SEO & Marketing|yes\nUnlimited Revisions|yes\nE-Commerce Features|yes\nDedicated Support Manager|yes\nCustom Integrations|yes",
				'btn_text'  => esc_html__( 'Contact Us', 'nexa-agency' ),
				'highlight' => '',
				'badge'     => '',
			),
		);

		for ( $plan = 1; $plan <= 3; $plan++ ) {
			$defaults = $plan_defaults[ $plan ];

			/* translators: %d: plan number */
			$label = sprintf( esc_html__( 'Plan %d', 'nexa-agency' ), $plan );

			$this->start_controls_section(
				'section_plan_' . $plan,
				array(
					'label' => $label,
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'plan' . $plan . '_name',
				array(
					'label'   => esc_html__( 'Plan Name', 'nexa-agency' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => $defaults['name'],
				)
			);

			$this->add_control(
				'plan' . $plan . '_price',
				array(
					'label'   => esc_html__( 'Price', 'nexa-agency' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => $defaults['price'],
				)
			);

			$this->add_control(
				'plan' . $plan . '_period',
				array(
					'label'   => esc_html__( 'Period', 'nexa-agency' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => $defaults['period'],
				)
			);

			$this->add_control(
				'plan' . $plan . '_features',
				array(
					'label'       => esc_html__( 'Features (one per line: Feature Text|yes or Feature Text|no)', 'nexa-agency' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'default'     => $defaults['features'],
					'rows'        => 8,
					'description' => esc_html__( 'Enter each feature on a new line. Append |yes or |no to indicate if included (e.g. "Mobile Responsive|yes").', 'nexa-agency' ),
				)
			);

			$this->add_control(
				'plan' . $plan . '_btn_text',
				array(
					'label'   => esc_html__( 'Button Text', 'nexa-agency' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => $defaults['btn_text'],
				)
			);

			$this->add_control(
				'plan' . $plan . '_badge',
				array(
					'label'   => esc_html__( 'Badge Text (e.g. Most Popular)', 'nexa-agency' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => $defaults['badge'],
				)
			);

			$this->add_control(
				'plan' . $plan . '_highlight',
				array(
					'label'        => esc_html__( 'Highlight / Featured', 'nexa-agency' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'nexa-agency' ),
					'label_off'    => esc_html__( 'No', 'nexa-agency' ),
					'return_value' => 'yes',
					'default'      => $defaults['highlight'],
				)
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Parse features text into array.
	 *
	 * @param string $features_text Raw features text.
	 * @return array
	 */
	private function parse_features( $features_text ) {
		$features = array();
		$lines    = explode( "\n", $features_text );

		foreach ( $lines as $line ) {
			$line = trim( $line );
			if ( empty( $line ) ) {
				continue;
			}

			if ( strpos( $line, '|' ) !== false ) {
				$parts    = explode( '|', $line, 2 );
				$text     = trim( $parts[0] );
				$included = ( trim( $parts[1] ) === 'yes' );
			} else {
				$text     = $line;
				$included = true;
			}

			$features[] = array(
				'text'     => $text,
				'included' => $included,
			);
		}

		return $features;
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$section_eyebrow  = $settings['section_eyebrow'];
		$section_title    = $settings['section_title'];
		$section_subtitle = $settings['section_subtitle'];

		$plans = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$btn_class = ( 'yes' === $settings[ 'plan' . $i . '_highlight' ] ) ? 'nexa-btn--primary' : 'nexa-btn--outline';
			$plans[]   = array(
				'name'      => $settings[ 'plan' . $i . '_name' ],
				'price'     => $settings[ 'plan' . $i . '_price' ],
				'period'    => $settings[ 'plan' . $i . '_period' ],
				'features'  => $this->parse_features( $settings[ 'plan' . $i . '_features' ] ),
				'btn_text'  => $settings[ 'plan' . $i . '_btn_text' ],
				'badge'     => $settings[ 'plan' . $i . '_badge' ],
				'featured'  => ( 'yes' === $settings[ 'plan' . $i . '_highlight' ] ),
				'cta_class' => $btn_class,
			);
		}
		?>
		<section id="pricing" class="nexa-section nexa-pricing" aria-label="<?php esc_attr_e( 'Pricing Plans', 'nexa-agency' ); ?>">
			<div class="nexa-container">

				<header class="nexa-section-header" data-aos="fade-up">
					<?php if ( $section_eyebrow ) : ?>
						<span class="nexa-eyebrow"><?php echo esc_html( $section_eyebrow ); ?></span>
					<?php endif; ?>
					<?php if ( $section_title ) : ?>
						<h2 class="nexa-section-title">
							<?php
							$title_parts = explode( ',', $section_title, 2 );
							if ( count( $title_parts ) > 1 ) {
								echo esc_html( trim( $title_parts[0] ) ) . ', <span class="nexa-gradient-text">' . esc_html( trim( $title_parts[1] ) ) . '</span>';
							} else {
								echo esc_html( $section_title );
							}
							?>
						</h2>
					<?php endif; ?>
					<?php if ( $section_subtitle ) : ?>
						<p class="nexa-section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
					<?php endif; ?>
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
											<?php echo esc_html( $feature['included'] ? '✓' : '✕' ); ?>
										</span>
										<span><?php echo esc_html( $feature['text'] ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>

							<a href="#contact" class="nexa-btn nexa-pricing-card__cta <?php echo esc_attr( $plan['cta_class'] ); ?>">
								<?php echo esc_html( $plan['btn_text'] ); ?>
							</a>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section><!-- #pricing -->
		<?php
	}
}
