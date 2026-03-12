<?php
/**
 * One Click Demo Import (OCDI) integration for NexaThemes.
 *
 * Registers the demo import files and handles post-import setup:
 * - Sets front page to the imported Home page
 * - Assigns menus to registered theme locations
 * - Sets blog page if present
 * - Imports Elementor template if available
 * - Flushes rewrite rules
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register demo import files for One Click Demo Import.
 *
 * @param array $import_files Existing import file definitions.
 * @return array
 */
function nexathemes_ocdi_import_files( $import_files ) {
	$demo_dir = NEXA_DIR . '/demo-data/';
	$demo_uri = NEXA_URI . '/demo-data/';

	$import_files[] = array(
		'import_file_name'           => __( 'NexaThemes — Full Demo', 'nexa-agency' ),
		'import_file_path'           => $demo_dir . 'demo-content.xml',
		'import_widget_file_path'    => $demo_dir . 'widgets.wie',
		'import_customizer_file_path' => $demo_dir . 'customizer.dat',
		'import_preview_image_url'   => $demo_uri . 'preview.jpg',
		'import_notice'              => __( 'After the import finishes, your site will match the NexaThemes demo — including pages, menus, and sample content. If Elementor is active, the homepage template will also be imported (if available).', 'nexa-agency' ),
		'preview_url'                => 'https://github.com/neamaticode/nexa-agency-theme',
	);

	return $import_files;
}
add_filter( 'ocdi/import_files', 'nexathemes_ocdi_import_files' );

/**
 * Run after demo import is complete.
 *
 * @param array $selected_import The import that was run.
 */
function nexathemes_ocdi_after_import( $selected_import ) {
	// 1. Set front page to the imported "Home" page.
	$home_page = nexathemes_get_page_by_title( 'Home' );
	if ( $home_page ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_page->ID );
	}

	// 2. Set blog page if imported.
	$blog_page = nexathemes_get_page_by_title( 'Blog' );
	if ( $blog_page ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	// 3. Assign menus to theme locations.
	$menu_locations = array(
		'primary' => array( 'Main Menu', 'Primary Menu', 'Main Navigation' ),
		'footer'  => array( 'Footer Menu', 'Footer Navigation' ),
	);
	$assigned = array();
	foreach ( $menu_locations as $location => $names ) {
		foreach ( $names as $menu_name ) {
			$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
			if ( $menu ) {
				$assigned[ $location ] = $menu->term_id;
				break;
			}
		}
	}
	if ( ! empty( $assigned ) ) {
		set_theme_mod( 'nav_menu_locations', $assigned );
	}

	// 4. Import Elementor template for Home page (if Elementor is active and JSON exists).
	if ( defined( 'ELEMENTOR_VERSION' ) && $home_page ) {
		nexathemes_import_elementor_template( $home_page->ID );
	}

	// 5. Flush rewrite rules.
	flush_rewrite_rules();

	// 6. Mark demo as imported.
	update_option( 'nexathemes_demo_imported', true );
}
add_action( 'ocdi/after_import', 'nexathemes_ocdi_after_import' );

/**
 * Check whether the Elementor home-template.json is a real (non-placeholder) file.
 *
 * @return bool
 */
function nexathemes_elementor_json_is_real() {
	$json_path = NEXA_DIR . '/demo-data/elementor/home-template.json';
	if ( ! file_exists( $json_path ) ) {
		return false;
	}
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$contents = file_get_contents( $json_path );
	// The placeholder file contains this marker — treat as "not real".
	return ( false === strpos( $contents, '"__nexathemes_placeholder"' ) );
}

/**
 * Import an Elementor template JSON onto a page.
 *
 * Gracefully aborts if the JSON is a placeholder or Elementor is not active.
 *
 * @param int $page_id Target page ID.
 */
function nexathemes_import_elementor_template( $page_id ) {
	$json_path = NEXA_DIR . '/demo-data/elementor/home-template.json';

	if ( ! nexathemes_elementor_json_is_real() ) {
		return; // Placeholder — skip silently.
	}

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}

	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$json_raw = file_get_contents( $json_path );
	if ( ! $json_raw ) {
		return;
	}

	$data = json_decode( $json_raw, true );
	if ( ! is_array( $data ) || empty( $data['content'] ) ) {
		return;
	}

	try {
		$document = \Elementor\Plugin::instance()->documents->get( $page_id );
		if ( $document ) {
			$document->import( $data );
			// Set Elementor as the page builder for this page.
			update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
		}
	} catch ( \Exception $e ) {
		// Silently fail — the rest of the import is unaffected.
	}
}

/**
 * OCDI helper: show an admin notice if the Elementor JSON is missing.
 */
function nexathemes_ocdi_elementor_notice() {
	if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
		return;
	}
	if ( nexathemes_elementor_json_is_real() ) {
		return;
	}
	// Only show on the OCDI import screen.
	$screen = get_current_screen();
	if ( ! $screen || false === strpos( $screen->id, 'pt-one-click-demo-import' ) ) {
		return;
	}
	?>
	<div class="notice notice-warning">
		<p>
			<strong><?php esc_html_e( 'NexaThemes', 'nexa-agency' ); ?></strong> &mdash;
			<?php
			printf(
				/* translators: %s: path to JSON file */
				esc_html__( 'The Elementor homepage template is not yet available. To import the full visual design, upload your Elementor JSON export to %s and re-import.', 'nexa-agency' ),
				'<code>demo-data/elementor/home-template.json</code>'
			);
			?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'nexathemes_ocdi_elementor_notice' );

/**
 * Wrapper for get_page_by_title() compatible with WordPress 6.2+.
 *
 * @param string $title Page title.
 * @return WP_Post|null
 */
function nexathemes_get_page_by_title( $title ) {
	$pages = get_posts(
		array(
			'post_type'              => 'page',
			'title'                  => $title,
			'posts_per_page'         => 1,
			'post_status'            => 'publish',
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);
	return ! empty( $pages ) ? $pages[0] : null;
}
