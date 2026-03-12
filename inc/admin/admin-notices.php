<?php
/**
 * Admin notices for NexaThemes.
 *
 * Shows a branded notice after theme activation prompting the user
 * to visit the NexaThemes Setup page.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Show a one-time "welcome" notice after theme activation.
 */
function nexathemes_activation_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Only show once.
	if ( ! get_transient( 'nexathemes_activation_notice' ) ) {
		return;
	}

	$setup_url = admin_url( 'themes.php?page=nexathemes-setup' );
	?>
	<div class="notice notice-success is-dismissible nexathemes-welcome-notice" style="border-left-color:#6C63FF;padding:16px 12px;">
		<div style="display:flex;align-items:center;gap:12px;">
			<div style="font-size:32px;line-height:1;">🚀</div>
			<div>
				<p style="margin:0 0 6px;font-size:14px;">
					<strong><?php esc_html_e( 'NexaThemes — Theme Activated!', 'nexa-agency' ); ?></strong>
				</p>
				<p style="margin:0;font-size:13px;">
					<?php
					printf(
						/* translators: %s: Setup page URL */
						esc_html__( 'Welcome! To get started quickly, visit the %s to install required plugins and import the demo content with one click.', 'nexa-agency' ),
						'<a href="' . esc_url( $setup_url ) . '" style="font-weight:600;">' . esc_html__( 'NexaThemes Setup', 'nexa-agency' ) . '</a>'
					);
					?>
				</p>
			</div>
		</div>
	</div>
	<?php
	delete_transient( 'nexathemes_activation_notice' );
}
add_action( 'admin_notices', 'nexathemes_activation_notice' );

/**
 * Set the activation transient when the theme is switched to NexaAgency.
 *
 * @param string $new_name New theme name.
 * @param WP_Theme $new_theme New theme object.
 */
function nexathemes_set_activation_transient( $new_name, $new_theme ) {
	if ( 'NexaAgency' === $new_name ) {
		set_transient( 'nexathemes_activation_notice', true, HOUR_IN_SECONDS );
	}
}
add_action( 'switch_theme', 'nexathemes_set_activation_transient', 10, 2 );
