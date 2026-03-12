<?php
/**
 * Elementor Portfolio Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaPortfolio_Widget class.
 */
class NexaPortfolio_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_portfolio';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Portfolio Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'section_portfolio_header',
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
				'default' => esc_html__( 'Our Work', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'   => esc_html__( 'Section Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Projects We Are Proud Of', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'section_subtitle',
			array(
				'label'   => esc_html__( 'Section Subtitle', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'A selection of our best work across web design, mobile development, and brand identity projects.', 'nexa-agency' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_portfolio_items',
			array(
				'label' => esc_html__( 'Portfolio Items', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'item_emoji',
			array(
				'label'   => esc_html__( 'Placeholder Emoji', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '🌐',
			)
		);

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Project Title', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'item_category',
			array(
				'label'   => esc_html__( 'Category Slug', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'web-design',
			)
		);

		$repeater->add_control(
			'item_category_label',
			array(
				'label'   => esc_html__( 'Category Label', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Web Design', 'nexa-agency' ),
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'   => esc_html__( 'Project Link', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);

		$this->add_control(
			'portfolio_items',
			array(
				'label'       => esc_html__( 'Portfolio Items', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item_emoji'          => '🌐',
						'item_title'          => esc_html__( 'TechCorp Website Redesign', 'nexa-agency' ),
						'item_category'       => 'web-design',
						'item_category_label' => esc_html__( 'Web Design', 'nexa-agency' ),
					),
					array(
						'item_emoji'          => '📱',
						'item_title'          => esc_html__( 'HealthTrack Mobile App', 'nexa-agency' ),
						'item_category'       => 'mobile-app',
						'item_category_label' => esc_html__( 'Mobile App', 'nexa-agency' ),
					),
					array(
						'item_emoji'          => '✨',
						'item_title'          => esc_html__( 'LuxeBrand Identity System', 'nexa-agency' ),
						'item_category'       => 'branding',
						'item_category_label' => esc_html__( 'Branding', 'nexa-agency' ),
					),
					array(
						'item_emoji'          => '🛒',
						'item_title'          => esc_html__( 'ShopNow E-Commerce Platform', 'nexa-agency' ),
						'item_category'       => 'web-design',
						'item_category_label' => esc_html__( 'Web Design', 'nexa-agency' ),
					),
					array(
						'item_emoji'          => '🚗',
						'item_title'          => esc_html__( 'DriveEasy Fleet Management App', 'nexa-agency' ),
						'item_category'       => 'mobile-app',
						'item_category_label' => esc_html__( 'Mobile App', 'nexa-agency' ),
					),
					array(
						'item_emoji'          => '🎯',
						'item_title'          => esc_html__( 'StartupCo Brand Launch', 'nexa-agency' ),
						'item_category'       => 'branding',
						'item_category_label' => esc_html__( 'Branding', 'nexa-agency' ),
					),
				),
				'title_field' => '{{{ item_title }}}',
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
		$items            = $settings['portfolio_items'];
		?>
		<section id="portfolio" class="nexa-section nexa-portfolio" aria-label="<?php esc_attr_e( 'Portfolio', 'nexa-agency' ); ?>">
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

				<!-- Filter Buttons -->
				<div class="nexa-portfolio__filters" role="tablist" aria-label="<?php esc_attr_e( 'Portfolio filter', 'nexa-agency' ); ?>">
					<button class="nexa-filter-btn is-active" data-filter="all" role="tab" aria-selected="true">
						<?php esc_html_e( 'All', 'nexa-agency' ); ?>
					</button>
					<button class="nexa-filter-btn" data-filter="web-design" role="tab" aria-selected="false">
						<?php esc_html_e( 'Web Design', 'nexa-agency' ); ?>
					</button>
					<button class="nexa-filter-btn" data-filter="mobile-app" role="tab" aria-selected="false">
						<?php esc_html_e( 'Mobile App', 'nexa-agency' ); ?>
					</button>
					<button class="nexa-filter-btn" data-filter="branding" role="tab" aria-selected="false">
						<?php esc_html_e( 'Branding', 'nexa-agency' ); ?>
					</button>
				</div>

				<!-- Portfolio Grid -->
				<div class="nexa-portfolio__grid">
					<?php foreach ( $items as $index => $item ) : ?>
						<?php
						$item_url   = isset( $item['item_link']['url'] ) ? $item['item_link']['url'] : '#contact';
						$item_image = isset( $item['item_image']['url'] ) ? $item['item_image']['url'] : '';
						?>
						<div
							class="nexa-portfolio__item"
							data-category="<?php echo esc_attr( $item['item_category'] ); ?>"
							data-aos="fade-up"
							data-aos-delay="<?php echo esc_attr( ( $index % 3 ) * 100 ); ?>"
						>
							<?php if ( $item_image ) : ?>
								<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $item['item_title'] ); ?>">
							<?php else : ?>
								<div class="nexa-portfolio__placeholder" aria-hidden="true">
									<?php echo esc_html( $item['item_emoji'] ); ?>
								</div>
							<?php endif; ?>
							<div class="nexa-portfolio__overlay">
								<div class="nexa-portfolio__overlay-content">
									<p class="nexa-portfolio__category"><?php echo esc_html( $item['item_category_label'] ); ?></p>
									<h3 class="nexa-portfolio__title"><?php echo esc_html( $item['item_title'] ); ?></h3>
									<a href="<?php echo esc_url( $item_url ); ?>" class="nexa-btn nexa-btn--sm nexa-btn--primary">
										<?php esc_html_e( 'View Project', 'nexa-agency' ); ?>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!-- .nexa-portfolio__grid -->

				<div class="nexa-text-center" style="margin-top:3rem;" data-aos="fade-up">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'nexa_portfolio' ) ? get_post_type_archive_link( 'nexa_portfolio' ) : '#' ); ?>" class="nexa-btn nexa-btn--outline nexa-btn--lg">
						<?php esc_html_e( 'View All Projects', 'nexa-agency' ); ?>
					</a>
				</div>

			</div>
		</section><!-- #portfolio -->
		<?php
	}
}
