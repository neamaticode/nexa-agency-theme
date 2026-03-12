<?php
/**
 * Elementor Team Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaTeam_Widget class.
 */
class NexaTeam_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_team';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Team Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-person';
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
			'section_team_header',
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
				'default' => esc_html__( 'The People', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => esc_html__( 'Section Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Meet The Dream Team', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_subtitle',
			array(
				'label'   => esc_html__( 'Section Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'A talented group of designers, developers, and strategists dedicated to making your project a success.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_members',
			array(
				'label' => esc_html__( 'Team Members', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'photo',
			array(
				'label'   => esc_html__( 'Photo', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'emoji',
			array(
				'label'   => esc_html__( 'Placeholder Emoji', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '👤',
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Name', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Team Member', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'role',
			array(
				'label'   => esc_html__( 'Role', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Developer', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'bio',
			array(
				'label'   => esc_html__( 'Bio', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Passionate professional dedicated to delivering exceptional results.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$repeater->add_control(
			'linkedin',
			array(
				'label'   => esc_html__( 'LinkedIn URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'twitter',
			array(
				'label'   => esc_html__( 'Twitter URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'github',
			array(
				'label'   => esc_html__( 'GitHub URL', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '' ),
			)
		);

		$this->add_control(
			'team_members',
			array(
				'label'       => esc_html__( 'Team Members', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'emoji' => '👨‍💼',
						'name'  => esc_html__( 'Alex Morgan', 'nexa-agency' ),
						'role'  => esc_html__( 'CEO & Founder', 'nexa-agency' ),
						'bio'   => esc_html__( 'Visionary leader with 12+ years building digital products for Fortune 500 companies.', 'nexa-agency' ),
					),
					array(
						'emoji' => '👩‍🎨',
						'name'  => esc_html__( 'Sarah Chen', 'nexa-agency' ),
						'role'  => esc_html__( 'Creative Director', 'nexa-agency' ),
						'bio'   => esc_html__( 'Award-winning designer who crafts brand identities and digital experiences that resonate.', 'nexa-agency' ),
					),
					array(
						'emoji' => '👨‍💻',
						'name'  => esc_html__( 'Marcus Rivera', 'nexa-agency' ),
						'role'  => esc_html__( 'Lead Developer', 'nexa-agency' ),
						'bio'   => esc_html__( 'Full-stack engineer passionate about clean code, performance, and cutting-edge technologies.', 'nexa-agency' ),
					),
					array(
						'emoji' => '👩‍📊',
						'name'  => esc_html__( 'Emma Johnson', 'nexa-agency' ),
						'role'  => esc_html__( 'Marketing Strategist', 'nexa-agency' ),
						'bio'   => esc_html__( 'Growth hacker who has scaled startups from zero to millions in revenue through strategic marketing.', 'nexa-agency' ),
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
		$members          = $settings['team_members'];
		?>
		<section id="team" class="nexa-section nexa-team" aria-label="<?php esc_attr_e( 'Our Team', 'nexa-agency' ); ?>">
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

				<div class="nexa-team__grid">
					<?php foreach ( $members as $index => $member ) : ?>
						<?php
						$photo    = isset( $member['photo']['url'] ) ? $member['photo']['url'] : '';
						$linkedin = isset( $member['linkedin']['url'] ) ? $member['linkedin']['url'] : '';
						$twitter  = isset( $member['twitter']['url'] ) ? $member['twitter']['url'] : '';
						$github   = isset( $member['github']['url'] ) ? $member['github']['url'] : '';
						?>
						<div
							class="nexa-team-card"
							data-aos="fade-up"
							data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
						>
							<div class="nexa-team-card__photo">
								<?php if ( $photo ) : ?>
									<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
								<?php else : ?>
									<div class="nexa-team-card__placeholder" aria-hidden="true">
										<?php echo esc_html( $member['emoji'] ); ?>
									</div>
								<?php endif; ?>
								<div class="nexa-team-card__social" aria-label="<?php esc_attr_e( 'Social links', 'nexa-agency' ); ?>">
									<?php if ( $linkedin ) : ?>
										<a href="<?php echo esc_url( $linkedin ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'nexa-agency' ); ?>">in</a>
									<?php endif; ?>
									<?php if ( $twitter ) : ?>
										<a href="<?php echo esc_url( $twitter ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Twitter', 'nexa-agency' ); ?>">𝕏</a>
									<?php endif; ?>
									<?php if ( $github ) : ?>
										<a href="<?php echo esc_url( $github ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'GitHub', 'nexa-agency' ); ?>">⌥</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="nexa-team-card__body">
								<h3 class="nexa-team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
								<?php if ( ! empty( $member['role'] ) ) : ?>
									<p class="nexa-team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $member['bio'] ) ) : ?>
									<p class="nexa-team-card__bio"><?php echo esc_html( $member['bio'] ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!-- .nexa-team__grid -->

			</div>
		</section><!-- #team -->
		<?php
	}
}
