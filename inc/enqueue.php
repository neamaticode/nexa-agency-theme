<?php
/**
 * Scripts and styles enqueue.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme styles and scripts.
 */
function nexa_enqueue_assets() {
	$ver = NEXA_VERSION;

	// Google Fonts.
	wp_enqueue_style(
		'nexa-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	);

	// AOS CSS.
	wp_enqueue_style(
		'aos',
		'https://unpkg.com/aos@2.3.4/dist/aos.css',
		array(),
		'2.3.4'
	);

	// Main stylesheet (style.css imports the sub-stylesheets).
	wp_enqueue_style(
		'nexa-style',
		get_stylesheet_uri(),
		array( 'nexa-google-fonts', 'aos' ),
		$ver
	);

	// AOS JS.
	wp_enqueue_script(
		'aos',
		'https://unpkg.com/aos@2.3.4/dist/aos.js',
		array(),
		'2.3.4',
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Main JS.
	wp_enqueue_script(
		'nexa-main',
		NEXA_URI . '/assets/js/main.js',
		array(),
		$ver,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Animations JS.
	wp_enqueue_script(
		'nexa-animations',
		NEXA_URI . '/assets/js/animations.js',
		array( 'aos' ),
		$ver,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Contact JS (only when contact form is present).
	if ( nexa_is_home_template() || is_page_template( 'page-templates/page-contact.php' ) ) {
		wp_enqueue_script(
			'nexa-contact',
			NEXA_URI . '/assets/js/contact.js',
			array(),
			$ver,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		wp_localize_script(
			'nexa-contact',
			'nexaContact',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'nexa_contact_nonce' ),
				'i18n'     => array(
					'name_required'  => esc_html__( 'Please enter your name.', 'nexa-agency' ),
					'email_required' => esc_html__( 'Please enter your email address.', 'nexa-agency' ),
					'email_invalid'  => esc_html__( 'Please enter a valid email address.', 'nexa-agency' ),
					'message_required' => esc_html__( 'Please enter your message.', 'nexa-agency' ),
					'message_short'  => esc_html__( 'Message must be at least 10 characters.', 'nexa-agency' ),
					'success'        => esc_html__( "Message sent successfully! We'll be in touch soon.", 'nexa-agency' ),
					'error'          => esc_html__( 'Something went wrong. Please try again.', 'nexa-agency' ),
					'network_error'  => esc_html__( 'A network error occurred. Please check your connection.', 'nexa-agency' ),
				),
			)
		);
	}

	// Comments reply script.
	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nexa_enqueue_assets' );

/**
 * Enqueue block editor styles.
 */
function nexa_editor_styles() {
	wp_enqueue_style(
		'nexa-editor-style',
		NEXA_URI . '/assets/css/main.css',
		array(),
		NEXA_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'nexa_editor_styles' );
