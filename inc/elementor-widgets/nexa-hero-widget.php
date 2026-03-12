<?php
/**
 * Elementor Hero Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaHero_Widget class.
 */
class NexaHero_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_hero';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Hero Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-banner';
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
			'section_hero_content',
			array(
				'label' => esc_html__( 'Hero Content', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'   => esc_html__( 'Badge Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '🚀 Award-Winning Digital Agency', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'hero_title',
			array(
				'label'   => esc_html__( 'Hero Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We Build Digital Experiences That Drive Results', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'hero_subtitle',
			array(
				'label'   => esc_html__( 'Hero Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Full-service digital agency specializing in web design, mobile apps, and growth marketing. We transform your vision into high-performing digital products.', 'nexa-agency' ),
				'rows'    => 4,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hero_buttons',
			array(
				'label' => esc_html__( 'Buttons', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'btn1_text',
			array(
				'label'   => esc_html__( 'Button 1 Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View Our Work', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'btn1_url',
			array(
				'label'   => esc_html__( 'Button 1 URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#portfolio' ),
			)
		);

		$this->add_control(
			'btn2_text',
			array(
				'label'   => esc_html__( 'Button 2 Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Free Quote', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'btn2_url',
			array(
				'label'   => esc_html__( 'Button 2 URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hero_stats',
			array(
				'label' => esc_html__( 'Hero Stats', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'stat1_number',
			array(
				'label'   => esc_html__( 'Stat 1 Number', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '250',
			)
		);

		$this->add_control(
			'stat1_suffix',
			array(
				'label'   => esc_html__( 'Stat 1 Suffix', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+',
			)
		);

		$this->add_control(
			'stat1_label',
			array(
				'label'   => esc_html__( 'Stat 1 Label', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Projects Done', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'stat2_number',
			array(
				'label'   => esc_html__( 'Stat 2 Number', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '180',
			)
		);

		$this->add_control(
			'stat2_suffix',
			array(
				'label'   => esc_html__( 'Stat 2 Suffix', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+',
			)
		);

		$this->add_control(
			'stat2_label',
			array(
				'label'   => esc_html__( 'Stat 2 Label', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Happy Clients', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'stat3_number',
			array(
				'label'   => esc_html__( 'Stat 3 Number', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '8',
			)
		);

		$this->add_control(
			'stat3_suffix',
			array(
				'label'   => esc_html__( 'Stat 3 Suffix', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+',
			)
		);

		$this->add_control(
			'stat3_label',
			array(
				'label'   => esc_html__( 'Stat 3 Label', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Years Experience', 'nexa-agency' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hero_bg',
			array(
				'label' => esc_html__( 'Background', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'   => esc_html__( 'Background Image', 'nexa-agency' ),
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
		$settings = $this->get_settings_for_display();

		$badge    = $settings['badge_text'];
		$title    = $settings['hero_title'];
		$subtitle = $settings['hero_subtitle'];
		$btn1_text = $settings['btn1_text'];
		$btn1_url  = isset( $settings['btn1_url']['url'] ) ? $settings['btn1_url']['url'] : '#portfolio';
		$btn2_text = $settings['btn2_text'];
		$btn2_url  = isset( $settings['btn2_url']['url'] ) ? $settings['btn2_url']['url'] : '#contact';
		$bg_image  = isset( $settings['bg_image']['url'] ) ? $settings['bg_image']['url'] : '';

		$section_style = '';
		if ( $bg_image ) {
			$section_style = 'background-image:url(\'' . esc_url( $bg_image ) . '\');';
		}
		?>
		<section id="hero" class="nexa-hero" aria-label="<?php esc_attr_e( 'Hero section', 'nexa-agency' ); ?>"<?php if ( $section_style ) { echo ' style="' . esc_attr( $section_style ) . '"'; } ?>>
			<!-- Decorative shapes -->
			<div class="nexa-hero__shapes" aria-hidden="true">
				<div class="nexa-hero__shape nexa-hero__shape--1"></div>
				<div class="nexa-hero__shape nexa-hero__shape--2"></div>
				<div class="nexa-hero__shape nexa-hero__shape--3"></div>
			</div>

			<div class="nexa-hero__inner">
				<div class="nexa-hero__content">

					<!-- Badge -->
					<?php if ( $badge ) : ?>
						<div class="nexa-hero__badge">
							<span class="nexa-hero__badge-dot" aria-hidden="true"></span>
							<?php echo esc_html( $badge ); ?>
						</div>
					<?php endif; ?>

					<!-- Title -->
					<?php if ( $title ) : ?>
						<h1 class="nexa-hero__title">
							<?php
							$title_words = explode( ' ', $title );
							$mid         = (int) ceil( count( $title_words ) / 2 );
							$line1       = implode( ' ', array_slice( $title_words, 0, $mid ) );
							$line2       = implode( ' ', array_slice( $title_words, $mid ) );
							echo esc_html( $line1 ) . ' <span class="nexa-gradient-text">' . esc_html( $line2 ) . '</span>';
							?>
						</h1>
					<?php endif; ?>

					<!-- Subtitle -->
					<?php if ( $subtitle ) : ?>
						<p class="nexa-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
					<?php endif; ?>

					<!-- CTA Buttons -->
					<div class="nexa-hero__cta">
						<?php if ( $btn1_text && $btn1_url ) : ?>
							<a href="<?php echo esc_url( $btn1_url ); ?>" class="nexa-btn nexa-btn--primary nexa-btn--lg">
								<?php echo esc_html( $btn1_text ); ?>
								<span aria-hidden="true">&#8594;</span>
							</a>
						<?php endif; ?>
						<?php if ( $btn2_text && $btn2_url ) : ?>
							<a href="<?php echo esc_url( $btn2_url ); ?>" class="nexa-btn nexa-btn--ghost nexa-btn--lg">
								<?php echo esc_html( $btn2_text ); ?>
							</a>
						<?php endif; ?>
					</div>

					<!-- Stats -->
					<div class="nexa-hero__stats">
						<?php
						for ( $i = 1; $i <= 3; $i++ ) :
							$num    = $settings[ 'stat' . $i . '_number' ];
							$suffix = $settings[ 'stat' . $i . '_suffix' ];
							$label  = $settings[ 'stat' . $i . '_label' ];
							if ( ! $num && ! $label ) {
								continue;
							}
							?>
							<div class="nexa-hero__stat">
								<div class="nexa-hero__stat-number">
									<span class="nexa-counter" data-count="<?php echo esc_attr( absint( $num ) ); ?>" data-suffix="<?php echo esc_attr( $suffix ); ?>">
										<?php echo esc_html( $num . $suffix ); ?>
									</span>
								</div>
								<div class="nexa-hero__stat-label"><?php echo esc_html( $label ); ?></div>
							</div>
						<?php endfor; ?>
					</div>

				</div><!-- .nexa-hero__content -->
			</div><!-- .nexa-hero__inner -->

		</section><!-- #hero -->
		<?php
	}
}
