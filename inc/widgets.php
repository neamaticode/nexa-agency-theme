<?php
/**
 * Widget areas registration.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register sidebar widget areas.
 */
function nexa_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'nexa-agency' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Appears on blog posts and pages with a sidebar.', 'nexa-agency' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'nexa-agency' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'First column in the footer widget area.', 'nexa-agency' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="nexa-footer__col-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'nexa-agency' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Second column in the footer widget area.', 'nexa-agency' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="nexa-footer__col-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'nexa-agency' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Third column in the footer widget area.', 'nexa-agency' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="nexa-footer__col-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'nexa_widgets_init' );
