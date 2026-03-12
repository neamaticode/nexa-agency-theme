<?php
/**
 * NexaThemes Setup Page — Admin Onboarding Wizard.
 *
 * Adds Appearance → NexaThemes Setup with a 3-step flow:
 *   1. Install / Activate required plugins
 *   2. Import demo content
 *   3. Finish (homepage, menus, permalink hints)
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Setup admin menu page.
 */
function nexathemes_add_setup_menu() {
	add_theme_page(
		__( 'NexaThemes Setup', 'nexa-agency' ),
		__( 'NexaThemes Setup', 'nexa-agency' ),
		'manage_options',
		'nexathemes-setup',
		'nexathemes_render_setup_page'
	);
}
add_action( 'admin_menu', 'nexathemes_add_setup_menu' );

/**
 * Enqueue inline styles for the setup page.
 *
 * @param string $hook Current admin page hook.
 */
function nexathemes_setup_page_assets( $hook ) {
	if ( 'appearance_page_nexathemes-setup' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'nexathemes-setup', false, array(), NEXA_VERSION );
	wp_add_inline_style(
		'nexathemes-setup',
		nexathemes_setup_inline_css()
	);
}
add_action( 'admin_enqueue_scripts', 'nexathemes_setup_page_assets' );

/**
 * Return inline CSS for the setup page.
 *
 * @return string
 */
function nexathemes_setup_inline_css() {
	return '
.nexa-setup-wrap { max-width:860px; margin:30px auto; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; }
.nexa-setup-header { background:linear-gradient(135deg,#6C63FF 0%,#3ecfcf 100%); border-radius:10px 10px 0 0; padding:30px 40px; color:#fff; display:flex; align-items:center; gap:18px; }
.nexa-setup-header h1 { margin:0; font-size:24px; font-weight:700; color:#fff; }
.nexa-setup-header p { margin:6px 0 0; opacity:.85; font-size:14px; }
.nexa-setup-body { background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 10px 10px; padding:30px 40px; }
.nexa-steps { display:flex; gap:0; margin-bottom:30px; }
.nexa-step { flex:1; text-align:center; padding:14px 10px; border-bottom:3px solid #ddd; font-size:13px; color:#666; cursor:default; }
.nexa-step.active { border-bottom-color:#6C63FF; color:#6C63FF; font-weight:600; }
.nexa-step.done { border-bottom-color:#3ecfcf; color:#3ecfcf; }
.nexa-step-num { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:50%; background:#ddd; color:#666; font-size:12px; font-weight:700; margin-bottom:6px; }
.nexa-step.active .nexa-step-num { background:#6C63FF; color:#fff; }
.nexa-step.done .nexa-step-num { background:#3ecfcf; color:#fff; }
.nexa-section { margin-bottom:24px; }
.nexa-plugin-row { display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border:1px solid #e5e7eb; border-radius:6px; margin-bottom:10px; }
.nexa-plugin-info strong { font-size:13px; }
.nexa-plugin-info span { font-size:12px; color:#666; display:block; }
.nexa-badge { display:inline-block; padding:2px 8px; border-radius:20px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.nexa-badge.required { background:#fef3cd; color:#856404; }
.nexa-badge.recommended { background:#d1ecf1; color:#0c5460; }
.nexa-badge.active { background:#d4edda; color:#155724; }
.nexa-notice { padding:12px 16px; border-radius:6px; margin-bottom:16px; font-size:13px; }
.nexa-notice.info { background:#e8f4fd; border-left:4px solid #3498db; }
.nexa-notice.warning { background:#fff3cd; border-left:4px solid #ffc107; }
.nexa-notice.success { background:#d4edda; border-left:4px solid #28a745; }
.nexa-btn { display:inline-block; padding:9px 20px; border-radius:5px; font-size:13px; font-weight:600; text-decoration:none; cursor:pointer; border:none; }
.nexa-btn-primary { background:#6C63FF; color:#fff; }
.nexa-btn-primary:hover { background:#5a52d5; color:#fff; }
.nexa-btn-secondary { background:#fff; color:#6C63FF; border:2px solid #6C63FF; }
.nexa-btn-secondary:hover { background:#f0eeff; color:#6C63FF; }
.nexa-btn-success { background:#28a745; color:#fff; }
.nexa-logo { width:48px; height:48px; background:rgba(255,255,255,.2); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:24px; flex-shrink:0; }
.nexa-finish-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #f0f0f0; }
.nexa-finish-item:last-child { border-bottom:none; }
.nexa-finish-item .nexa-icon { font-size:20px; }
.nexa-finish-item strong { font-size:13px; }
.nexa-finish-item span { font-size:12px; color:#666; display:block; }
';
}

/**
 * Get the current wizard step (1, 2, or 3).
 *
 * @return int
 */
function nexathemes_get_current_step() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$step = isset( $_GET['step'] ) ? absint( $_GET['step'] ) : 0;
	if ( $step >= 1 && $step <= 3 ) {
		return $step;
	}

	// Auto-detect step.
	$pa = NexaThemes_Plugin_Activation::get_instance();
	$pending = $pa->get_pending_plugins();
	if ( ! empty( $pending ) ) {
		return 1;
	}
	if ( ! get_option( 'nexathemes_demo_imported' ) ) {
		return 2;
	}
	return 3;
}

/**
 * Render the setup page.
 */
function nexathemes_render_setup_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'nexa-agency' ) );
	}

	$pa          = NexaThemes_Plugin_Activation::get_instance();
	$pending     = $pa->get_pending_plugins();
	$all_active  = empty( $pending );
	$demo_done   = (bool) get_option( 'nexathemes_demo_imported' );
	$current_step = nexathemes_get_current_step();

	$step_url = function ( $n ) {
		return esc_url( admin_url( 'themes.php?page=nexathemes-setup&step=' . $n ) );
	};
	?>
	<div class="nexa-setup-wrap">

		<!-- Header -->
		<div class="nexa-setup-header">
			<div class="nexa-logo">🎨</div>
			<div>
				<h1><?php esc_html_e( 'NexaThemes Setup', 'nexa-agency' ); ?></h1>
				<p><?php esc_html_e( 'Get your theme ready in 3 easy steps — install plugins, import demo, and go live.', 'nexa-agency' ); ?></p>
			</div>
		</div>

		<div class="nexa-setup-body">

			<!-- Step Indicator -->
			<div class="nexa-steps">
				<?php
				$steps = array(
					1 => __( 'Install Plugins', 'nexa-agency' ),
					2 => __( 'Import Demo', 'nexa-agency' ),
					3 => __( 'Finish', 'nexa-agency' ),
				);
				foreach ( $steps as $n => $label ) {
					$class = 'nexa-step';
					if ( $n === $current_step ) {
						$class .= ' active';
					} elseif ( $n < $current_step ) {
						$class .= ' done';
					}
					echo '<div class="' . esc_attr( $class ) . '">';
					echo '<div class="nexa-step-num">' . ( $n < $current_step ? '✓' : esc_html( $n ) ) . '</div>';
					echo '<br>' . esc_html( $label );
					echo '</div>';
				}
				?>
			</div>

			<?php if ( 1 === $current_step ) : ?>
				<?php nexathemes_render_step_plugins( $pa, $pending, $all_active, $step_url ); ?>
			<?php elseif ( 2 === $current_step ) : ?>
				<?php nexathemes_render_step_import( $all_active, $demo_done, $step_url ); ?>
			<?php else : ?>
				<?php nexathemes_render_step_finish( $step_url ); ?>
			<?php endif; ?>

		</div><!-- .nexa-setup-body -->
	</div><!-- .nexa-setup-wrap -->
	<?php
}

/**
 * Render Step 1 — Plugin installation.
 *
 * @param NexaThemes_Plugin_Activation $pa       Plugin activation helper.
 * @param array                        $pending  Pending plugins.
 * @param bool                         $all_active Whether all plugins are active.
 * @param callable                     $step_url  Step URL helper.
 */
function nexathemes_render_step_plugins( $pa, $pending, $all_active, $step_url ) {
	$all_plugins = nexathemes_get_plugin_list();
	?>
	<div class="nexa-section">
		<h2 style="margin-top:0;"><?php esc_html_e( 'Step 1 — Install & Activate Plugins', 'nexa-agency' ); ?></h2>
		<p style="color:#555;font-size:13px;">
			<?php esc_html_e( 'The following plugins are needed to get the full NexaThemes experience. Required plugins must be installed for the demo import to work correctly.', 'nexa-agency' ); ?>
		</p>

		<?php if ( $all_active ) : ?>
		<div class="nexa-notice success">
			✅ <?php esc_html_e( 'All required and recommended plugins are installed and active!', 'nexa-agency' ); ?>
		</div>
		<?php endif; ?>

		<?php foreach ( $all_plugins as $plugin ) : ?>
			<?php
			$is_active    = $pa->is_active( $plugin['slug'] );
			$is_installed = $pa->is_installed( $plugin['slug'] );
			$action_url   = $pa->get_action_url( $plugin['slug'] );
			$badge_label  = ! empty( $plugin['required'] ) ? __( 'Required', 'nexa-agency' ) : __( 'Recommended', 'nexa-agency' );
			$badge_class  = ! empty( $plugin['required'] ) ? 'required' : 'recommended';
			?>
			<div class="nexa-plugin-row">
				<div class="nexa-plugin-info">
					<strong><?php echo esc_html( $plugin['name'] ); ?></strong>
					<span><?php echo esc_html( $plugin['description'] ); ?></span>
				</div>
				<div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
					<?php if ( $is_active ) : ?>
						<span class="nexa-badge active">✓ <?php esc_html_e( 'Active', 'nexa-agency' ); ?></span>
					<?php else : ?>
						<span class="nexa-badge <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $badge_label ); ?></span>
						<a href="<?php echo esc_url( $action_url ); ?>" class="nexa-btn nexa-btn-primary" style="padding:6px 14px;font-size:12px;">
							<?php echo $is_installed ? esc_html__( 'Activate', 'nexa-agency' ) : esc_html__( 'Install & Activate', 'nexa-agency' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>

		<div style="margin-top:24px;">
			<a href="<?php echo $step_url( 2 ); ?>" class="nexa-btn <?php echo $all_active ? 'nexa-btn-primary' : 'nexa-btn-secondary'; ?>">
				<?php echo $all_active ? esc_html__( 'Continue to Import Demo →', 'nexa-agency' ) : esc_html__( 'Skip & Continue →', 'nexa-agency' ); ?>
			</a>
		</div>
	</div>
	<?php
}

/**
 * Render Step 2 — Demo Import.
 *
 * @param bool     $all_active Whether all plugins are active.
 * @param bool     $demo_done  Whether demo has already been imported.
 * @param callable $step_url   Step URL helper.
 */
function nexathemes_render_step_import( $all_active, $demo_done, $step_url ) {
	$ocdi_active        = is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' );
	$elementor_active   = is_plugin_active( 'elementor/elementor.php' );
	$elementor_json_ok  = nexathemes_elementor_json_is_real();
	$demo_content_path  = NEXA_DIR . '/demo-data/demo-content.xml';
	$demo_content_ok    = file_exists( $demo_content_path ) && filesize( $demo_content_path ) > 200;
	?>
	<div class="nexa-section">
		<h2 style="margin-top:0;"><?php esc_html_e( 'Step 2 — Import Demo Content', 'nexa-agency' ); ?></h2>
		<p style="color:#555;font-size:13px;">
			<?php esc_html_e( 'Import demo pages, sample content, menus, and widget settings to match the theme demo instantly.', 'nexa-agency' ); ?>
		</p>

		<?php if ( $demo_done ) : ?>
		<div class="nexa-notice success">
			✅ <?php esc_html_e( 'Demo content has already been imported!', 'nexa-agency' ); ?>
			<a href="<?php echo $step_url( 3 ); ?>"><?php esc_html_e( 'Go to Finish →', 'nexa-agency' ); ?></a>
		</div>
		<?php endif; ?>

		<?php if ( ! $elementor_active ) : ?>
		<div class="nexa-notice warning">
			⚠️ <?php esc_html_e( 'Elementor is not active. The Elementor homepage template will not be imported, but all other demo content (pages, CPT entries, menus) will still work.', 'nexa-agency' ); ?>
		</div>
		<?php endif; ?>

		<?php if ( $elementor_active && ! $elementor_json_ok ) : ?>
		<div class="nexa-notice warning">
			⚠️ <strong><?php esc_html_e( 'Elementor homepage template not found.', 'nexa-agency' ); ?></strong>
			<?php
			printf(
				/* translators: %s: path to JSON file */
				esc_html__( 'To import the Elementor homepage design, upload/replace the file at: %s', 'nexa-agency' ),
				'<code>demo-data/elementor/home-template.json</code>'
			);
			?>
			<br><em><?php esc_html_e( 'The rest of the import will continue safely without it.', 'nexa-agency' ); ?></em>
		</div>
		<?php endif; ?>

		<?php if ( ! $ocdi_active ) : ?>
		<div class="nexa-notice info">
			ℹ️
			<?php
			printf(
				/* translators: %s: plugin page URL */
				esc_html__( 'For one-click demo import, please activate the %s plugin first, then return to this page.', 'nexa-agency' ),
				'<strong>One Click Demo Import</strong>'
			);
			?>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=nexathemes-setup&step=1' ) ); ?>">
				← <?php esc_html_e( 'Back to Plugins', 'nexa-agency' ); ?>
			</a>
		</div>
		<?php else : ?>
		<div class="nexa-notice info">
			ℹ️
			<?php
			printf(
				/* translators: %s: import page URL */
				esc_html__( 'Click the button below to start the demo import via the %s plugin.', 'nexa-agency' ),
				'<strong>One Click Demo Import</strong>'
			);
			?>
		</div>

		<div style="margin:20px 0;">
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ); ?>"
			   class="nexa-btn nexa-btn-primary">
				🚀 <?php esc_html_e( 'Import Demo Content (One Click)', 'nexa-agency' ); ?>
			</a>
		</div>
		<?php endif; ?>

		<hr style="margin:24px 0;border:none;border-top:1px solid #eee;">

		<h3 style="font-size:14px;"><?php esc_html_e( 'What will be imported:', 'nexa-agency' ); ?></h3>
		<ul style="font-size:13px;color:#555;list-style:disc;margin-left:20px;">
			<li><?php esc_html_e( 'Pages: Home, About, Contact, Portfolio', 'nexa-agency' ); ?></li>
			<li><?php esc_html_e( 'Sample Services, Portfolio items, Team members, Testimonials', 'nexa-agency' ); ?></li>
			<li><?php esc_html_e( 'Primary and Footer menus', 'nexa-agency' ); ?></li>
			<li><?php esc_html_e( 'Widget settings', 'nexa-agency' ); ?></li>
			<li><?php esc_html_e( 'Customizer settings (colors, social links, contact info)', 'nexa-agency' ); ?></li>
			<?php if ( $elementor_active && $elementor_json_ok ) : ?>
			<li><?php esc_html_e( 'Elementor homepage template', 'nexa-agency' ); ?></li>
			<?php endif; ?>
		</ul>

		<div style="margin-top:24px;">
			<a href="<?php echo $step_url( 1 ); ?>" class="nexa-btn nexa-btn-secondary" style="margin-right:10px;">
				← <?php esc_html_e( 'Back', 'nexa-agency' ); ?>
			</a>
			<a href="<?php echo $step_url( 3 ); ?>" class="nexa-btn nexa-btn-secondary">
				<?php esc_html_e( 'Skip & Finish →', 'nexa-agency' ); ?>
			</a>
		</div>
	</div>
	<?php
}

/**
 * Render Step 3 — Finish.
 *
 * @param callable $step_url Step URL helper.
 */
function nexathemes_render_step_finish( $step_url ) {
	$homepage_id   = (int) get_option( 'page_on_front' );
	$homepage_set  = $homepage_id > 0 && 'page' === get_option( 'show_on_front' );
	$primary_menu  = has_nav_menu( 'primary' );
	$permalinks_ok = '' !== get_option( 'permalink_structure' );
	?>
	<div class="nexa-section">
		<h2 style="margin-top:0;"><?php esc_html_e( 'Step 3 — Finish Setup', 'nexa-agency' ); ?></h2>
		<p style="color:#555;font-size:13px;">
			<?php esc_html_e( 'Almost done! Review the checklist below to make sure everything is configured correctly.', 'nexa-agency' ); ?>
		</p>

		<div class="nexa-finish-item">
			<span class="nexa-icon"><?php echo $homepage_set ? '✅' : '⚠️'; ?></span>
			<div>
				<strong><?php esc_html_e( 'Homepage set', 'nexa-agency' ); ?></strong>
				<span>
					<?php if ( $homepage_set ) : ?>
						<?php
						printf(
							/* translators: %s: page title */
							esc_html__( 'Front page is set to "%s".', 'nexa-agency' ),
							get_the_title( $homepage_id )
						);
						?>
					<?php else : ?>
						<?php
						printf(
							/* translators: %s: Reading settings URL */
							esc_html__( 'Go to %s and set "Your homepage displays" to a static page.', 'nexa-agency' ),
							'<a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '">' . esc_html__( 'Settings → Reading', 'nexa-agency' ) . '</a>'
						);
						?>
					<?php endif; ?>
				</span>
			</div>
		</div>

		<div class="nexa-finish-item">
			<span class="nexa-icon"><?php echo $primary_menu ? '✅' : '⚠️'; ?></span>
			<div>
				<strong><?php esc_html_e( 'Primary menu assigned', 'nexa-agency' ); ?></strong>
				<span>
					<?php if ( $primary_menu ) : ?>
						<?php esc_html_e( 'A menu is assigned to the Primary Navigation location.', 'nexa-agency' ); ?>
					<?php else : ?>
						<?php
						printf(
							/* translators: %s: Menus URL */
							esc_html__( 'Go to %s and assign a menu to "Primary Navigation".', 'nexa-agency' ),
							'<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Appearance → Menus', 'nexa-agency' ) . '</a>'
						);
						?>
					<?php endif; ?>
				</span>
			</div>
		</div>

		<div class="nexa-finish-item">
			<span class="nexa-icon"><?php echo $permalinks_ok ? '✅' : '⚠️'; ?></span>
			<div>
				<strong><?php esc_html_e( 'Pretty permalinks enabled', 'nexa-agency' ); ?></strong>
				<span>
					<?php if ( $permalinks_ok ) : ?>
						<?php esc_html_e( 'Permalink structure is configured.', 'nexa-agency' ); ?>
					<?php else : ?>
						<?php
						printf(
							/* translators: %s: Permalinks settings URL */
							esc_html__( 'Go to %s and choose a permalink structure (e.g. "Post name").', 'nexa-agency' ),
							'<a href="' . esc_url( admin_url( 'options-permalink.php' ) ) . '">' . esc_html__( 'Settings → Permalinks', 'nexa-agency' ) . '</a>'
						);
						?>
					<?php endif; ?>
				</span>
			</div>
		</div>

		<div class="nexa-finish-item">
			<span class="nexa-icon">ℹ️</span>
			<div>
				<strong><?php esc_html_e( 'Customize your theme', 'nexa-agency' ); ?></strong>
				<span>
					<?php
					printf(
						/* translators: %s: Customizer URL */
						esc_html__( 'Visit %s to set your brand colors, contact info, social links, and more.', 'nexa-agency' ),
						'<a href="' . esc_url( admin_url( 'customize.php' ) ) . '">' . esc_html__( 'Appearance → Customize', 'nexa-agency' ) . '</a>'
					);
					?>
				</span>
			</div>
		</div>

		<div class="nexa-finish-item">
			<span class="nexa-icon">ℹ️</span>
			<div>
				<strong><?php esc_html_e( 'Edit pages with Elementor', 'nexa-agency' ); ?></strong>
				<span>
					<?php
					printf(
						/* translators: %s: Pages list URL */
						esc_html__( 'Go to %s, open any page, and click "Edit with Elementor" to customize the design visually.', 'nexa-agency' ),
						'<a href="' . esc_url( admin_url( 'edit.php?post_type=page' ) ) . '">' . esc_html__( 'Pages', 'nexa-agency' ) . '</a>'
					);
					?>
				</span>
			</div>
		</div>

		<div style="margin-top:30px;text-align:center;padding:20px;background:#f8f9fa;border-radius:8px;">
			<div style="font-size:40px;margin-bottom:8px;">🎉</div>
			<h3 style="margin:0 0 6px;"><?php esc_html_e( 'You\'re all set!', 'nexa-agency' ); ?></h3>
			<p style="color:#555;font-size:13px;margin:0 0 16px;">
				<?php esc_html_e( 'NexaThemes is configured and ready. Enjoy building your site!', 'nexa-agency' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexa-btn nexa-btn-success" target="_blank">
				🌐 <?php esc_html_e( 'View Your Site', 'nexa-agency' ); ?>
			</a>
			&nbsp;
			<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="nexa-btn nexa-btn-primary">
				🎨 <?php esc_html_e( 'Open Customizer', 'nexa-agency' ); ?>
			</a>
		</div>

		<div style="margin-top:24px;">
			<a href="<?php echo $step_url( 2 ); ?>" class="nexa-btn nexa-btn-secondary">
				← <?php esc_html_e( 'Back to Import', 'nexa-agency' ); ?>
			</a>
		</div>
	</div>
	<?php
}

/**
 * Return the full list of plugins the theme needs.
 *
 * @return array
 */
function nexathemes_get_plugin_list() {
	return array(
		array(
			'name'        => 'Elementor Website Builder',
			'slug'        => 'elementor',
			'required'    => true,
			'description' => __( 'Required to edit all page sections visually with drag & drop.', 'nexa-agency' ),
		),
		array(
			'name'        => 'One Click Demo Import',
			'slug'        => 'one-click-demo-import',
			'required'    => false,
			'description' => __( 'Recommended for importing demo content with a single click.', 'nexa-agency' ),
		),
		array(
			'name'        => 'Contact Form 7',
			'slug'        => 'contact-form-7',
			'required'    => false,
			'description' => __( 'Recommended for the contact form section.', 'nexa-agency' ),
		),
	);
}
