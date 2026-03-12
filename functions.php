<?php
/**
 * NexaAgency Theme Functions
 *
 * @package NexaAgency
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NEXA_VERSION', '1.0.0' );
define( 'NEXA_DIR', get_template_directory() );
define( 'NEXA_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function nexa_setup() {
	load_theme_textdomain( 'nexa-agency', NEXA_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '0F0E17',
		)
	);

	// Image sizes.
	add_image_size( 'nexa-hero', 1920, 1080, true );
	add_image_size( 'nexa-card', 600, 400, true );
	add_image_size( 'nexa-portrait', 400, 500, true );

	// Menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Navigation', 'nexa-agency' ),
			'footer'  => esc_html__( 'Footer Navigation', 'nexa-agency' ),
			'social'  => esc_html__( 'Social Links', 'nexa-agency' ),
		)
	);
}
add_action( 'after_setup_theme', 'nexa_setup' );

/**
 * Content width.
 */
function nexa_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'nexa_content_width', 0 );

// Include files.
require NEXA_DIR . '/inc/enqueue.php';
require NEXA_DIR . '/inc/custom-post-types.php';
require NEXA_DIR . '/inc/customizer.php';
require NEXA_DIR . '/inc/widgets.php';
require NEXA_DIR . '/inc/helpers.php';
require NEXA_DIR . '/inc/ajax-handlers.php';

// Admin: onboarding, plugin activation helper, demo import.
if ( is_admin() ) {
	require NEXA_DIR . '/inc/tgmpa/class-tgm-plugin-activation.php';
	require NEXA_DIR . '/inc/admin/admin-notices.php';
	require NEXA_DIR . '/inc/admin/setup-page.php';
	require NEXA_DIR . '/inc/admin/demo-import.php';

	/**
	 * Register required and recommended plugins.
	 */
	function nexa_register_plugins() {
		nexathemes_register_required_plugins( nexathemes_get_plugin_list() );
	}
	add_action( 'init', 'nexa_register_plugins' );
}
