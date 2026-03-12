<?php
/**
 * Elementor Services Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaServices_Widget class.
 */
class NexaServices_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_services';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Services Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-services';
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
			'section_services_header',
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
				'default' => esc_html__( 'What We Do', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => esc_html__( 'Section Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Services That Move Businesses', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_subtitle',
			array(
				'label'   => esc_html__( 'Section Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'From strategy to execution, we offer end-to-end digital services designed to transform your business and accelerate growth.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_services_items',
			array(
				'label' => esc_html__( 'Services', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon (Emoji)', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '🎨',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Web Design', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Stunning, conversion-focused websites that captivate your audience and reflect your brand identity.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'services',
			array(
				'label'       => esc_html__( 'Service Items', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'icon'        => '🎨',
						'title'       => esc_html__( 'Web Design', 'nexa-agency' ),
						'description' => esc_html__( 'Stunning, conversion-focused websites that captivate your audience and reflect your brand identity with pixel-perfect precision.', 'nexa-agency' ),
					),
					array(
						'icon'        => '📱',
						'title'       => esc_html__( 'Mobile Apps', 'nexa-agency' ),
						'description' => esc_html__( 'Native and cross-platform mobile applications for iOS and Android that deliver seamless user experiences.', 'nexa-agency' ),
					),
					array(
						'icon'        => '📈',
						'title'       => esc_html__( 'SEO & Marketing', 'nexa-agency' ),
						'description' => esc_html__( 'Data-driven digital marketing strategies that boost your visibility, generate qualified leads, and maximize your ROI.', 'nexa-agency' ),
					),
					array(
						'icon'        => '✨',
						'title'       => esc_html__( 'Brand Identity', 'nexa-agency' ),
						'description' => esc_html__( 'Comprehensive brand identity systems that make you instantly recognizable in your market.', 'nexa-agency' ),
					),
					array(
						'icon'        => '🖥️',
						'title'       => esc_html__( 'UI/UX Design', 'nexa-agency' ),
						'description' => esc_html__( 'User-centered interface design that turns complex workflows into intuitive, delightful experiences.', 'nexa-agency' ),
					),
					array(
						'icon'        => '☁️',
						'title'       => esc_html__( 'Cloud Solutions', 'nexa-agency' ),
						'description' => esc_html__( 'Scalable cloud infrastructure and DevOps solutions that keep your applications fast, secure, and available.', 'nexa-agency' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings        = $this->get_settings_for_display();
		$section_eyebrow = $settings['section_eyebrow'];
		$section_title   = $settings['section_title'];
		$section_subtitle = $settings['section_subtitle'];
		$services        = $settings['services'];
		?>
		<section id="services" class="nexa-section nexa-services" aria-label="<?php esc_attr_e( 'Our Services', 'nexa-agency' ); ?>">
			<div class="nexa-container">

				<header class="nexa-section-header" data-aos="fade-up">
					<?php if ( $section_eyebrow ) : ?>
						<span class="nexa-eyebrow"><?php echo esc_html( $section_eyebrow ); ?></span>
					<?php endif; ?>
					<?php if ( $section_title ) : ?>
						<h2 class="nexa-section-title">
							<?php
							$title_parts = explode( ' ', $section_title, 3 );
							$part1       = isset( $title_parts[0] ) ? $title_parts[0] : '';
							$part2       = implode( ' ', array_slice( $title_parts, 1 ) );
							echo esc_html( $part1 ) . ' <span class="nexa-gradient-text">' . esc_html( $part2 ) . '</span>';
							?>
						</h2>
					<?php endif; ?>
					<?php if ( $section_subtitle ) : ?>
						<p class="nexa-section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
					<?php endif; ?>
				</header>

				<div class="nexa-services__grid animate-stagger">
					<?php foreach ( $services as $index => $service ) : ?>
						<div
							class="nexa-service-card nexa-card"
							data-aos="fade-up"
							data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
						>
							<?php if ( ! empty( $service['icon'] ) ) : ?>
								<div class="nexa-service-card__icon" aria-hidden="true">
									<?php echo esc_html( $service['icon'] ); ?>
								</div>
							<?php endif; ?>
							<h3 class="nexa-service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
							<p class="nexa-service-card__description"><?php echo esc_html( $service['description'] ); ?></p>
							<a href="#contact" class="nexa-service-card__link">
								<?php esc_html_e( 'Learn More', 'nexa-agency' ); ?>
								<span aria-hidden="true">&#8594;</span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section><!-- #services -->
		<?php
	}
}
