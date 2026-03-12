<?php
/**
 * TGM Plugin Activation - Simplified implementation for NexaThemes.
 *
 * Prompts users to install and activate required/recommended plugins.
 * Based on the TGM Plugin Activation library pattern (GPL-2.0+).
 *
 * @package NexaAgency
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NexaThemes_Plugin_Activation' ) ) {

	/**
	 * Plugin activation helper for NexaThemes.
	 */
	class NexaThemes_Plugin_Activation {

		/**
		 * Registered plugins.
		 *
		 * @var array
		 */
		protected $plugins = array();

		/**
		 * Singular instance.
		 *
		 * @var NexaThemes_Plugin_Activation|null
		 */
		protected static $instance = null;

		/**
		 * Get or create the singleton instance.
		 *
		 * @return NexaThemes_Plugin_Activation
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor — hooks into admin.
		 */
		protected function __construct() {
			add_action( 'admin_notices', array( $this, 'notices' ) );
			add_action( 'wp_ajax_nexathemes_dismiss_notice', array( $this, 'ajax_dismiss_notice' ) );
		}

		/**
		 * Register plugins to check.
		 *
		 * @param array $plugins List of plugin definition arrays.
		 */
		public function register( array $plugins ) {
			foreach ( $plugins as $plugin ) {
				$this->plugins[] = wp_parse_args(
					$plugin,
					array(
						'name'     => '',
						'slug'     => '',
						'required' => false,
						'source'   => 'repo', // 'repo' = wordpress.org
					)
				);
			}
		}

		/**
		 * Check if a plugin is active.
		 *
		 * @param string $slug Plugin slug (e.g. elementor).
		 * @return bool
		 */
		public function is_active( $slug ) {
			// Derive the main file path heuristic: slug/slug.php.
			$plugin_file = trailingslashit( $slug ) . $slug . '.php';
			if ( is_plugin_active( $plugin_file ) ) {
				return true;
			}
			// Some plugins have different main file names; check active plugins list.
			$active = get_option( 'active_plugins', array() );
			foreach ( $active as $plugin ) {
				if ( 0 === strpos( $plugin, $slug . '/' ) ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Check if a plugin is installed (in the plugins directory).
		 *
		 * @param string $slug Plugin slug.
		 * @return bool
		 */
		public function is_installed( $slug ) {
			$all = array_keys( get_plugins() );
			foreach ( $all as $file ) {
				if ( 0 === strpos( $file, $slug . '/' ) ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Get the main plugin file for a slug.
		 *
		 * @param string $slug Plugin slug.
		 * @return string|false
		 */
		protected function get_plugin_file( $slug ) {
			$all = array_keys( get_plugins() );
			foreach ( $all as $file ) {
				if ( 0 === strpos( $file, $slug . '/' ) ) {
					return $file;
				}
			}
			return false;
		}

		/**
		 * Get install/activate URL for a plugin.
		 *
		 * @param string $slug Plugin slug.
		 * @return string
		 */
		public function get_action_url( $slug ) {
			if ( ! $this->is_installed( $slug ) ) {
				return wp_nonce_url(
					admin_url( 'update.php?action=install-plugin&plugin=' . rawurlencode( $slug ) ),
					'install-plugin_' . $slug
				);
			}
			$file = $this->get_plugin_file( $slug );
			if ( $file ) {
				return wp_nonce_url(
					admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $file ) ),
					'activate-plugin_' . $file
				);
			}
			return admin_url( 'plugins.php' );
		}

		/**
		 * Return list of plugins that still need action.
		 *
		 * @return array
		 */
		public function get_pending_plugins() {
			$pending = array();
			foreach ( $this->plugins as $plugin ) {
				if ( ! $this->is_active( $plugin['slug'] ) ) {
					$plugin['installed'] = $this->is_installed( $plugin['slug'] );
					$plugin['action_url'] = $this->get_action_url( $plugin['slug'] );
					$pending[]           = $plugin;
				}
			}
			return $pending;
		}

		/**
		 * Display admin notices for pending plugins.
		 */
		public function notices() {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if ( get_user_meta( get_current_user_id(), 'nexathemes_notice_dismissed', true ) ) {
				return;
			}

			$pending = $this->get_pending_plugins();
			if ( empty( $pending ) ) {
				return;
			}

			$required     = array_filter(
				$pending,
				function ( $p ) {
					return ! empty( $p['required'] );
				}
			);
			$recommended  = array_filter(
				$pending,
				function ( $p ) {
					return empty( $p['required'] );
				}
			);
			$setup_url    = admin_url( 'themes.php?page=nexathemes-setup' );
			?>
			<div class="notice notice-info nexathemes-notice" style="border-left-color:#6C63FF;">
				<p>
					<strong><?php esc_html_e( 'NexaThemes', 'nexa-agency' ); ?></strong> &mdash;
					<?php esc_html_e( 'Your theme requires a few plugins to work correctly.', 'nexa-agency' ); ?>
					<a href="<?php echo esc_url( $setup_url ); ?>" style="font-weight:600;">
						<?php esc_html_e( 'Open NexaThemes Setup', 'nexa-agency' ); ?> &rarr;
					</a>
				</p>
				<?php if ( ! empty( $required ) ) : ?>
				<ul style="margin:0 0 4px 20px;list-style:disc;">
					<?php foreach ( $required as $plugin ) : ?>
					<li>
						<strong><?php echo esc_html( $plugin['name'] ); ?></strong>
						&mdash; <?php esc_html_e( 'Required', 'nexa-agency' ); ?>
						&nbsp;
						<a href="<?php echo esc_url( $plugin['action_url'] ); ?>">
							<?php echo $plugin['installed'] ? esc_html__( 'Activate', 'nexa-agency' ) : esc_html__( 'Install & Activate', 'nexa-agency' ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<?php if ( ! empty( $recommended ) ) : ?>
				<ul style="margin:0 0 4px 20px;list-style:disc;">
					<?php foreach ( $recommended as $plugin ) : ?>
					<li>
						<strong><?php echo esc_html( $plugin['name'] ); ?></strong>
						&mdash; <?php esc_html_e( 'Recommended', 'nexa-agency' ); ?>
						&nbsp;
						<a href="<?php echo esc_url( $plugin['action_url'] ); ?>">
							<?php echo $plugin['installed'] ? esc_html__( 'Activate', 'nexa-agency' ) : esc_html__( 'Install & Activate', 'nexa-agency' ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<p>
					<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin-ajax.php?action=nexathemes_dismiss_notice' ), 'nexathemes_dismiss_notice' ) ); ?>"
					   class="button button-secondary">
						<?php esc_html_e( 'Dismiss', 'nexa-agency' ); ?>
					</a>
				</p>
			</div>
			<?php
		}

		/**
		 * AJAX handler to dismiss the notice permanently for the current user.
		 */
		public function ajax_dismiss_notice() {
			check_ajax_referer( 'nexathemes_dismiss_notice' );
			if ( current_user_can( 'install_plugins' ) ) {
				update_user_meta( get_current_user_id(), 'nexathemes_notice_dismissed', 1 );
			}
			wp_safe_redirect( wp_get_referer() ?: admin_url() );
			exit;
		}
	}
}

/**
 * Helper function to register plugins with NexaThemes_Plugin_Activation.
 *
 * @param array $plugins Array of plugin definitions.
 */
function nexathemes_register_required_plugins( array $plugins ) {
	NexaThemes_Plugin_Activation::get_instance()->register( $plugins );
}
