<?php
/**
 * Elementor Testimonials Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaTestimonials_Widget class.
 */
class NexaTestimonials_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_testimonials';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Testimonials Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-testimonial';
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
			'section_testimonials_header',
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
				'default' => esc_html__( 'Client Stories', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => esc_html__( 'Section Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'What Our Clients Say', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_subtitle',
			array(
				'label'   => esc_html__( 'Section Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Don't take our word for it. Here's what our clients have to say about working with NexaAgency.", 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonials_items',
			array(
				'label' => esc_html__( 'Testimonials', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'avatar',
			array(
				'label'   => esc_html__( 'Avatar Image', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'avatar_emoji',
			array(
				'label'   => esc_html__( 'Avatar Emoji (fallback)', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '👤',
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Client Name', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Client Name', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'role',
			array(
				'label'   => esc_html__( 'Role / Company', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'CEO, Company', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'quote',
			array(
				'label'   => esc_html__( 'Quote', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Working with NexaAgency was an absolute game-changer. They delivered outstanding results.', 'nexa-agency' ),
				'rows'    => 4,
			)
		);

		$repeater->add_control(
			'rating',
			array(
				'label'   => esc_html__( 'Rating (1-5)', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 5,
				'step'    => 1,
				'default' => 5,
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'label'       => esc_html__( 'Testimonials', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'avatar_emoji' => '👨‍💼',
						'name'         => esc_html__( 'James Mitchell', 'nexa-agency' ),
						'role'         => esc_html__( 'CEO, TechVentures Inc.', 'nexa-agency' ),
						'quote'        => esc_html__( 'Working with NexaAgency was an absolute game-changer. They didn\'t just build us a website — they built us a growth engine. Our conversions increased by 340% within the first three months.', 'nexa-agency' ),
						'rating'       => 5,
					),
					array(
						'avatar_emoji' => '👩‍💼',
						'name'         => esc_html__( 'Priya Sharma', 'nexa-agency' ),
						'role'         => esc_html__( 'Founder, StyleHub', 'nexa-agency' ),
						'quote'        => esc_html__( 'The team at NexaAgency understood our vision from day one. Their attention to detail, creative thinking, and technical expertise are unmatched.', 'nexa-agency' ),
						'rating'       => 5,
					),
					array(
						'avatar_emoji' => '👨‍💻',
						'name'         => esc_html__( 'Carlos Reyes', 'nexa-agency' ),
						'role'         => esc_html__( 'CTO, HealthFlow', 'nexa-agency' ),
						'quote'        => esc_html__( 'Our mobile app launched on time, on budget, and exceeded every expectation. NexaAgency is our long-term technology partner.', 'nexa-agency' ),
						'rating'       => 5,
					),
				),
				'title_field' => '{{{ name }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$section_eyebrow  = $settings['section_eyebrow'];
		$section_title    = $settings['section_title'];
		$section_subtitle = $settings['section_subtitle'];
		$testimonials     = $settings['testimonials'];
		?>
		<section id="testimonials" class="nexa-section nexa-testimonials" aria-label="<?php esc_attr_e( 'Testimonials', 'nexa-agency' ); ?>">
			<div class="nexa-container">

				<header class="nexa-section-header" data-aos="fade-up">
					<?php if ( $section_eyebrow ) : ?>
						<span class="nexa-eyebrow"><?php echo esc_html( $section_eyebrow ); ?></span>
					<?php endif; ?>
					<?php if ( $section_title ) : ?>
						<h2 class="nexa-section-title">
							<?php
							$title_parts = explode( ' ', $section_title, 2 );
							$part1       = isset( $title_parts[0] ) ? $title_parts[0] : '';
							$part2       = isset( $title_parts[1] ) ? $title_parts[1] : '';
							echo esc_html( $part1 ) . ' <span class="nexa-gradient-text">' . esc_html( $part2 ) . '</span>';
							?>
						</h2>
					<?php endif; ?>
					<?php if ( $section_subtitle ) : ?>
						<p class="nexa-section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
					<?php endif; ?>
				</header>

				<div class="nexa-testimonials__grid">
					<?php foreach ( $testimonials as $index => $item ) : ?>
						<?php
						$rating     = (int) $item['rating'];
						$rating     = ( $rating >= 1 && $rating <= 5 ) ? $rating : 5;
						$avatar_url = isset( $item['avatar']['url'] ) ? $item['avatar']['url'] : '';
						?>
						<div
							class="nexa-testimonial-card"
							data-aos="fade-up"
							data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
						>
							<div class="nexa-testimonial-card__stars" aria-label="<?php echo esc_attr( sprintf( '%d star rating', $rating ) ); ?>">
								<?php for ( $i = 0; $i < 5; $i++ ) : ?>
									<span><?php echo esc_html( $i < $rating ? '★' : '☆' ); ?></span>
								<?php endfor; ?>
							</div>
							<p class="nexa-testimonial-card__quote">"<?php echo esc_html( $item['quote'] ); ?>"</p>
							<div class="nexa-testimonial-card__author">
								<div class="nexa-testimonial-card__avatar" aria-hidden="true">
									<?php if ( $avatar_url ) : ?>
										<img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
									<?php else : ?>
										<?php echo esc_html( $item['avatar_emoji'] ); ?>
									<?php endif; ?>
								</div>
								<div>
									<p class="nexa-testimonial-card__name"><?php echo esc_html( $item['name'] ); ?></p>
									<?php if ( ! empty( $item['role'] ) ) : ?>
										<p class="nexa-testimonial-card__role"><?php echo esc_html( $item['role'] ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!-- .nexa-testimonials__grid -->

			</div>
		</section><!-- #testimonials -->
		<?php
	}
}
