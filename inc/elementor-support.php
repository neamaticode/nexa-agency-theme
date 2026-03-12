<?php
/**
 * Elementor support for NexaAgency theme.
 *
 * Registers widget categories and loads custom Elementor widgets.
 * Falls back gracefully when Elementor is not installed.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if Elementor is active.
 *
 * @return bool
 */
function nexa_is_elementor_active() {
	return did_action( 'elementor/loaded' );
}

/**
 * Initialize Elementor support.
 */
function nexa_elementor_init() {
	if ( ! nexa_is_elementor_active() ) {
		return;
	}

	// Register custom widget category.
	add_action( 'elementor/elements/categories_registered', 'nexa_register_elementor_categories' );

	// Register custom widgets.
	add_action( 'elementor/widgets/register', 'nexa_register_elementor_widgets' );
}
add_action( 'init', 'nexa_elementor_init' );

/**
 * Register NexaAgency widget category.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
 */
function nexa_register_elementor_categories( $elements_manager ) {
	$elements_manager->add_category(
		'nexa-agency',
		array(
			'title' => esc_html__( 'NexaAgency', 'nexa-agency' ),
			'icon'  => 'fa fa-plug',
		)
	);
}

/**
 * Register NexaAgency Elementor widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function nexa_register_elementor_widgets( $widgets_manager ) {
	$widgets_dir = NEXA_DIR . '/inc/elementor-widgets/';

	$widget_files = array(
		'nexa-hero-widget.php',
		'nexa-about-widget.php',
		'nexa-services-widget.php',
		'nexa-portfolio-widget.php',
		'nexa-team-widget.php',
		'nexa-testimonials-widget.php',
		'nexa-stats-widget.php',
		'nexa-pricing-widget.php',
		'nexa-contact-widget.php',
	);

	$widget_classes = array(
		'NexaHero_Widget',
		'NexaAbout_Widget',
		'NexaServices_Widget',
		'NexaPortfolio_Widget',
		'NexaTeam_Widget',
		'NexaTestimonials_Widget',
		'NexaStats_Widget',
		'NexaPricing_Widget',
		'NexaContact_Widget',
	);

	foreach ( $widget_files as $index => $file ) {
		$file_path = $widgets_dir . $file;
		if ( file_exists( $file_path ) ) {
			require_once $file_path;
			if ( isset( $widget_classes[ $index ] ) && class_exists( $widget_classes[ $index ] ) ) {
				$widgets_manager->register( new $widget_classes[ $index ]() );
			}
		}
	}
}
