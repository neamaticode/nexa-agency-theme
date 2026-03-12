<?php
/**
 * Elementor Stats Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaStats_Widget class.
 */
class NexaStats_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_stats';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Stats Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-counter';
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
			'section_stats_items',
			array(
				'label' => esc_html__( 'Stats', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon (Emoji)', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '🏆',
			)
		);

		$repeater->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '250',
			)
		);

		$repeater->add_control(
			'suffix',
			array(
				'label'   => esc_html__( 'Suffix (e.g. + or %)', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+',
			)
		);

		$repeater->add_control(
			'label',
			array(
				'label'   => esc_html__( 'Label', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Projects Completed', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'stats',
			array(
				'label'       => esc_html__( 'Stats', 'nexa-agency' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'icon'   => '🏆',
						'number' => '250',
						'suffix' => '+',
						'label'  => esc_html__( 'Projects Completed', 'nexa-agency' ),
					),
					array(
						'icon'   => '😊',
						'number' => '180',
						'suffix' => '+',
						'label'  => esc_html__( 'Happy Clients', 'nexa-agency' ),
					),
					array(
						'icon'   => '📅',
						'number' => '8',
						'suffix' => '+',
						'label'  => esc_html__( 'Years Experience', 'nexa-agency' ),
					),
					array(
						'icon'   => '👥',
						'number' => '24',
						'suffix' => '+',
						'label'  => esc_html__( 'Team Members', 'nexa-agency' ),
					),
				),
				'title_field' => '{{{ label }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$stats    = $settings['stats'];
		?>
		<section class="nexa-stats" aria-label="<?php esc_attr_e( 'Company statistics', 'nexa-agency' ); ?>">
			<div class="nexa-container">
				<div class="nexa-stats__grid">
					<?php foreach ( $stats as $index => $stat ) : ?>
						<div
							class="nexa-stats__item"
							data-aos="fade-up"
							data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
						>
							<?php if ( ! empty( $stat['icon'] ) ) : ?>
								<span class="nexa-stats__icon" aria-hidden="true"><?php echo esc_html( $stat['icon'] ); ?></span>
							<?php endif; ?>
							<div class="nexa-stats__number">
								<span
									class="nexa-counter"
									data-count="<?php echo esc_attr( absint( $stat['number'] ) ); ?>"
									data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>"
								>
									<?php echo esc_html( $stat['number'] . $stat['suffix'] ); ?>
								</span>
							</div>
							<div class="nexa-stats__label"><?php echo esc_html( $stat['label'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
