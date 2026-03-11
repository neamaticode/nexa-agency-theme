<?php
/**
 * WordPress Customizer settings.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings, sections, and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function nexa_customizer_register( $wp_customize ) {

	// -------------------------------------------------------
	// PANEL: Theme Options
	// -------------------------------------------------------
	$wp_customize->add_panel(
		'nexa_options',
		array(
			'title'    => esc_html__( 'Theme Options', 'nexa-agency' ),
			'priority' => 130,
		)
	);

	// -------------------------------------------------------
	// SECTION: Colors
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_colors',
		array(
			'title' => esc_html__( 'Colors', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$color_settings = array(
		'primary_color'   => array( '#6C63FF', esc_html__( 'Primary Color', 'nexa-agency' ) ),
		'secondary_color' => array( '#FF6584', esc_html__( 'Secondary Color', 'nexa-agency' ) ),
		'accent_color'    => array( '#3ecfcf', esc_html__( 'Accent Color', 'nexa-agency' ) ),
	);

	foreach ( $color_settings as $key => [ $default, $label ] ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => $label,
					'section' => 'nexa_colors',
				)
			)
		);
	}

	// -------------------------------------------------------
	// SECTION: Hero
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_hero',
		array(
			'title' => esc_html__( 'Hero Section', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$hero_fields = array(
		'hero_badge'    => array( esc_html__( '🚀 Award-Winning Digital Agency', 'nexa-agency' ), esc_html__( 'Badge Text', 'nexa-agency' ), 'text' ),
		'hero_title'    => array( esc_html__( 'We Build Digital Experiences That Drive Results', 'nexa-agency' ), esc_html__( 'Hero Title', 'nexa-agency' ), 'text' ),
		'hero_subtitle' => array( esc_html__( 'Full-service digital agency specializing in web design, mobile apps, and growth marketing.', 'nexa-agency' ), esc_html__( 'Hero Subtitle', 'nexa-agency' ), 'textarea' ),
		'hero_btn1_text' => array( esc_html__( 'View Our Work', 'nexa-agency' ), esc_html__( 'Button 1 Text', 'nexa-agency' ), 'text' ),
		'hero_btn1_url'  => array( '#portfolio', esc_html__( 'Button 1 URL', 'nexa-agency' ), 'url' ),
		'hero_btn2_text' => array( esc_html__( 'Get Free Quote', 'nexa-agency' ), esc_html__( 'Button 2 Text', 'nexa-agency' ), 'text' ),
		'hero_btn2_url'  => array( '#contact', esc_html__( 'Button 2 URL', 'nexa-agency' ), 'url' ),
	);

	nexa_register_customizer_fields( $wp_customize, 'nexa_hero', $hero_fields );

	// -------------------------------------------------------
	// SECTION: About
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_about',
		array(
			'title' => esc_html__( 'About Section', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$about_fields = array(
		'about_subtitle'     => array( esc_html__( 'About NexaAgency', 'nexa-agency' ), esc_html__( 'Eyebrow Text', 'nexa-agency' ), 'text' ),
		'about_title'        => array( esc_html__( 'We Are a Team of Creative Problem Solvers', 'nexa-agency' ), esc_html__( 'Section Title', 'nexa-agency' ), 'text' ),
		'about_description'  => array( esc_html__( 'Founded in 2016, NexaAgency has grown into one of the most trusted digital partners for ambitious brands.', 'nexa-agency' ), esc_html__( 'Description', 'nexa-agency' ), 'textarea' ),
		'about_btn_text'     => array( esc_html__( 'Learn Our Story', 'nexa-agency' ), esc_html__( 'Button Text', 'nexa-agency' ), 'text' ),
		'about_btn_url'      => array( '#contact', esc_html__( 'Button URL', 'nexa-agency' ), 'url' ),
	);

	nexa_register_customizer_fields( $wp_customize, 'nexa_about', $about_fields );

	// About image.
	$wp_customize->add_setting(
		'about_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_image',
			array(
				'label'   => esc_html__( 'About Image', 'nexa-agency' ),
				'section' => 'nexa_about',
			)
		)
	);

	// -------------------------------------------------------
	// SECTION: Stats
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_stats',
		array(
			'title' => esc_html__( 'Stats Section', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		$defaults = array(
			1 => array( '250', esc_html__( 'Projects Completed', 'nexa-agency' ) ),
			2 => array( '180', esc_html__( 'Happy Clients', 'nexa-agency' ) ),
			3 => array( '8', esc_html__( 'Years Experience', 'nexa-agency' ) ),
			4 => array( '24', esc_html__( 'Team Members', 'nexa-agency' ) ),
		);

		$wp_customize->add_setting(
			"stat{$i}_number",
			array(
				'default'           => $defaults[ $i ][0],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"stat{$i}_number",
			array(
				/* translators: %d: stat number */
				'label'   => sprintf( esc_html__( 'Stat %d Number', 'nexa-agency' ), $i ),
				'section' => 'nexa_stats',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"stat{$i}_label",
			array(
				'default'           => $defaults[ $i ][1],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"stat{$i}_label",
			array(
				/* translators: %d: stat number */
				'label'   => sprintf( esc_html__( 'Stat %d Label', 'nexa-agency' ), $i ),
				'section' => 'nexa_stats',
				'type'    => 'text',
			)
		);
	}

	// -------------------------------------------------------
	// SECTION: Contact Info
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_contact_info',
		array(
			'title' => esc_html__( 'Contact Info', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$contact_fields = array(
		'contact_email'   => array( 'hello@nexaagency.com', esc_html__( 'Email Address', 'nexa-agency' ), 'email' ),
		'contact_phone'   => array( '+1 (555) 123-4567', esc_html__( 'Phone Number', 'nexa-agency' ), 'text' ),
		'contact_address' => array( '123 Agency Street, New York, NY 10001', esc_html__( 'Address', 'nexa-agency' ), 'text' ),
	);

	nexa_register_customizer_fields( $wp_customize, 'nexa_contact_info', $contact_fields );

	// -------------------------------------------------------
	// SECTION: Social Media
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_social',
		array(
			'title' => esc_html__( 'Social Media', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$social_fields = array(
		'social_facebook'  => array( '', esc_html__( 'Facebook URL', 'nexa-agency' ), 'url' ),
		'social_twitter'   => array( '', esc_html__( 'Twitter/X URL', 'nexa-agency' ), 'url' ),
		'social_instagram' => array( '', esc_html__( 'Instagram URL', 'nexa-agency' ), 'url' ),
		'social_linkedin'  => array( '', esc_html__( 'LinkedIn URL', 'nexa-agency' ), 'url' ),
		'social_youtube'   => array( '', esc_html__( 'YouTube URL', 'nexa-agency' ), 'url' ),
	);

	nexa_register_customizer_fields( $wp_customize, 'nexa_social', $social_fields );

	// -------------------------------------------------------
	// SECTION: Footer
	// -------------------------------------------------------
	$wp_customize->add_section(
		'nexa_footer',
		array(
			'title' => esc_html__( 'Footer', 'nexa-agency' ),
			'panel' => 'nexa_options',
		)
	);

	$footer_fields = array(
		'footer_description' => array( '', esc_html__( 'Footer Tagline', 'nexa-agency' ), 'textarea' ),
		'footer_copyright'   => array( '', esc_html__( 'Copyright Text (leave blank for auto)', 'nexa-agency' ), 'text' ),
	);

	nexa_register_customizer_fields( $wp_customize, 'nexa_footer', $footer_fields );
}
add_action( 'customize_register', 'nexa_customizer_register' );

/**
 * Helper to register a batch of text/textarea/url/email fields in a section.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $section      Section ID.
 * @param array                $fields       Array of field_key => [default, label, type].
 */
function nexa_register_customizer_fields( $wp_customize, $section, $fields ) {
	foreach ( $fields as $key => [ $default, $label, $type ] ) {
		$sanitize = 'url' === $type ? 'esc_url_raw' : ( 'email' === $type ? 'sanitize_email' : ( 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field' ) );

		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => $sanitize,
			)
		);

		$wp_customize->add_control(
			$key,
			array(
				'label'   => $label,
				'section' => $section,
				'type'    => in_array( $type, array( 'textarea' ), true ) ? $type : 'text',
			)
		);
	}
}

/**
 * Output live preview postMessage JS for color changes.
 */
function nexa_customizer_preview_js() {
	?>
	<script>
	( function ( wp ) {
		var style = document.createElement( 'style' );
		style.id = 'nexa-customizer-live';
		document.head.appendChild( style );

		function updateColors( primaryColor, secondaryColor, accentColor ) {
			style.textContent = ':root{' +
				'--primary:' + primaryColor + ';' +
				'--secondary:' + secondaryColor + ';' +
				'--accent:' + accentColor + ';' +
			'}';
		}

		wp.customize( 'primary_color', function ( value ) {
			value.bind( function ( newVal ) {
				updateColors(
					newVal,
					wp.customize( 'secondary_color' ).get(),
					wp.customize( 'accent_color' ).get()
				);
			} );
		} );

		wp.customize( 'secondary_color', function ( value ) {
			value.bind( function ( newVal ) {
				updateColors(
					wp.customize( 'primary_color' ).get(),
					newVal,
					wp.customize( 'accent_color' ).get()
				);
			} );
		} );

		wp.customize( 'accent_color', function ( value ) {
			value.bind( function ( newVal ) {
				updateColors(
					wp.customize( 'primary_color' ).get(),
					wp.customize( 'secondary_color' ).get(),
					newVal
				);
			} );
		} );
	} )( wp );
	</script>
	<?php
}
add_action( 'customize_preview_init', function () {
	add_action( 'wp_footer', 'nexa_customizer_preview_js' );
} );

/**
 * Output inline CSS for customized colors.
 */
function nexa_customizer_css() {
	$primary   = get_theme_mod( 'primary_color', '#6C63FF' );
	$secondary = get_theme_mod( 'secondary_color', '#FF6584' );
	$accent    = get_theme_mod( 'accent_color', '#3ecfcf' );

	if ( '#6C63FF' === $primary && '#FF6584' === $secondary && '#3ecfcf' === $accent ) {
		return;
	}

	$css = ':root{';
	if ( '#6C63FF' !== $primary ) {
		$css .= '--primary:' . sanitize_hex_color( $primary ) . ';';
	}
	if ( '#FF6584' !== $secondary ) {
		$css .= '--secondary:' . sanitize_hex_color( $secondary ) . ';';
	}
	if ( '#3ecfcf' !== $accent ) {
		$css .= '--accent:' . sanitize_hex_color( $accent ) . ';';
	}
	$css .= '}';

	wp_add_inline_style( 'nexa-style', $css );
}
add_action( 'wp_enqueue_scripts', 'nexa_customizer_css', 20 );
