<?php
/**
 * Elementor About Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaAbout_Widget class.
 */
class NexaAbout_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_about';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'About Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-info-box';
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
			'section_about_content',
			array(
				'label' => esc_html__( 'About Content', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => esc_html__( 'Eyebrow / Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'About NexaAgency', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We Are a Team of Creative Problem Solvers', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Founded in 2016, NexaAgency has grown into one of the most trusted digital partners for ambitious brands. We combine strategic thinking with world-class design and engineering to deliver results that matter.', 'nexa-agency' ),
				'rows'    => 5,
			)
		);

		$this->add_control(
			'years_badge',
			array(
				'label'   => esc_html__( 'Years Badge Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '8+ Years of Excellence', 'nexa-agency' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_about_features',
			array(
				'label' => esc_html__( 'Features List', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'feature_text',
			array(
				'label'   => esc_html__( 'Feature', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Results-driven approach with measurable KPIs', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'features',
			array(
				'label'       => esc_html__( 'Features', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'feature_text' => esc_html__( 'Results-driven approach with measurable KPIs', 'nexa-agency' ) ),
					array( 'feature_text' => esc_html__( 'Dedicated project manager for every client', 'nexa-agency' ) ),
					array( 'feature_text' => esc_html__( 'Agile methodology with transparent communication', 'nexa-agency' ) ),
					array( 'feature_text' => esc_html__( 'Post-launch support and optimization included', 'nexa-agency' ) ),
					array( 'feature_text' => esc_html__( 'ISO-quality processes and industry best practices', 'nexa-agency' ) ),
				),
				'title_field' => '{{{ feature_text }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_about_button',
			array(
				'label' => esc_html__( 'Button & Image', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn Our Story', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'btn_url',
			array(
				'label'   => esc_html__( 'Button URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'about_image',
			array(
				'label'   => esc_html__( 'About Image', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$subtitle    = $settings['subtitle'];
		$title       = $settings['title'];
		$description = $settings['description'];
		$years_badge = $settings['years_badge'];
		$features    = $settings['features'];
		$btn_text    = $settings['btn_text'];
		$btn_url     = isset( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '#contact';
		$about_image = isset( $settings['about_image']['url'] ) ? $settings['about_image']['url'] : '';
		?>
		<section id="about" class="nexa-section nexa-about" aria-label="<?php esc_attr_e( 'About Us', 'nexa-agency' ); ?>">
			<div class="nexa-container">
				<div class="nexa-about__inner">

					<!-- Text Side -->
					<div class="nexa-about__text-side" data-aos="fade-right">
						<?php if ( $subtitle ) : ?>
							<span class="nexa-eyebrow nexa-about__eyebrow"><?php echo esc_html( $subtitle ); ?></span>
						<?php endif; ?>
						<?php if ( $title ) : ?>
							<h2 class="nexa-about__title"><?php echo esc_html( $title ); ?></h2>
						<?php endif; ?>
						<?php if ( $description ) : ?>
							<p class="nexa-about__text"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $features ) ) : ?>
							<ul class="nexa-about__features">
								<?php foreach ( $features as $feature ) : ?>
									<li class="nexa-about__feature">
										<span class="nexa-about__feature-icon" aria-hidden="true">✓</span>
										<?php echo esc_html( $feature['feature_text'] ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

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
						<?php if ( $years_badge ) : ?>
							<div class="nexa-about__badge">
								<?php
								$parts = explode( ' ', $years_badge, 2 );
								?>
								<div class="nexa-about__badge-number"><?php echo esc_html( $parts[0] ); ?></div>
								<div class="nexa-about__badge-text"><?php echo esc_html( isset( $parts[1] ) ? $parts[1] : '' ); ?></div>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</section><!-- #about -->
		<?php
	}
}
