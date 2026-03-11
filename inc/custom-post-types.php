<?php
/**
 * Custom post types and taxonomies.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register all custom post types.
 */
function nexa_register_post_types() {

	// Services CPT.
	register_post_type(
		'nexa_service',
		array(
			'labels'             => array(
				'name'               => esc_html_x( 'Services', 'post type general name', 'nexa-agency' ),
				'singular_name'      => esc_html_x( 'Service', 'post type singular name', 'nexa-agency' ),
				'add_new'            => esc_html__( 'Add New Service', 'nexa-agency' ),
				'add_new_item'       => esc_html__( 'Add New Service', 'nexa-agency' ),
				'edit_item'          => esc_html__( 'Edit Service', 'nexa-agency' ),
				'new_item'           => esc_html__( 'New Service', 'nexa-agency' ),
				'view_item'          => esc_html__( 'View Service', 'nexa-agency' ),
				'search_items'       => esc_html__( 'Search Services', 'nexa-agency' ),
				'not_found'          => esc_html__( 'No services found', 'nexa-agency' ),
				'not_found_in_trash' => esc_html__( 'No services found in trash', 'nexa-agency' ),
				'menu_name'          => esc_html__( 'Services', 'nexa-agency' ),
			),
			'public'             => true,
			'show_in_rest'       => true,
			'has_archive'        => false,
			'rewrite'            => array( 'slug' => 'services' ),
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'menu_icon'          => 'dashicons-admin-tools',
			'menu_position'      => 5,
			'show_in_menu'       => true,
		)
	);

	// Portfolio CPT.
	register_post_type(
		'nexa_portfolio',
		array(
			'labels'             => array(
				'name'               => esc_html_x( 'Portfolio', 'post type general name', 'nexa-agency' ),
				'singular_name'      => esc_html_x( 'Project', 'post type singular name', 'nexa-agency' ),
				'add_new'            => esc_html__( 'Add New Project', 'nexa-agency' ),
				'add_new_item'       => esc_html__( 'Add New Project', 'nexa-agency' ),
				'edit_item'          => esc_html__( 'Edit Project', 'nexa-agency' ),
				'new_item'           => esc_html__( 'New Project', 'nexa-agency' ),
				'view_item'          => esc_html__( 'View Project', 'nexa-agency' ),
				'search_items'       => esc_html__( 'Search Projects', 'nexa-agency' ),
				'not_found'          => esc_html__( 'No projects found', 'nexa-agency' ),
				'not_found_in_trash' => esc_html__( 'No projects found in trash', 'nexa-agency' ),
				'menu_name'          => esc_html__( 'Portfolio', 'nexa-agency' ),
			),
			'public'             => true,
			'show_in_rest'       => true,
			'has_archive'        => 'portfolio',
			'rewrite'            => array( 'slug' => 'portfolio' ),
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'menu_icon'          => 'dashicons-portfolio',
			'menu_position'      => 6,
		)
	);

	// Team Members CPT.
	register_post_type(
		'nexa_team',
		array(
			'labels'             => array(
				'name'               => esc_html_x( 'Team Members', 'post type general name', 'nexa-agency' ),
				'singular_name'      => esc_html_x( 'Team Member', 'post type singular name', 'nexa-agency' ),
				'add_new'            => esc_html__( 'Add New Member', 'nexa-agency' ),
				'add_new_item'       => esc_html__( 'Add New Team Member', 'nexa-agency' ),
				'edit_item'          => esc_html__( 'Edit Team Member', 'nexa-agency' ),
				'new_item'           => esc_html__( 'New Team Member', 'nexa-agency' ),
				'view_item'          => esc_html__( 'View Team Member', 'nexa-agency' ),
				'search_items'       => esc_html__( 'Search Team Members', 'nexa-agency' ),
				'not_found'          => esc_html__( 'No team members found', 'nexa-agency' ),
				'not_found_in_trash' => esc_html__( 'No team members found in trash', 'nexa-agency' ),
				'menu_name'          => esc_html__( 'Team', 'nexa-agency' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'show_in_rest'       => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'menu_icon'          => 'dashicons-groups',
			'menu_position'      => 7,
		)
	);

	// Testimonials CPT.
	register_post_type(
		'nexa_testimonial',
		array(
			'labels'             => array(
				'name'               => esc_html_x( 'Testimonials', 'post type general name', 'nexa-agency' ),
				'singular_name'      => esc_html_x( 'Testimonial', 'post type singular name', 'nexa-agency' ),
				'add_new'            => esc_html__( 'Add New Testimonial', 'nexa-agency' ),
				'add_new_item'       => esc_html__( 'Add New Testimonial', 'nexa-agency' ),
				'edit_item'          => esc_html__( 'Edit Testimonial', 'nexa-agency' ),
				'new_item'           => esc_html__( 'New Testimonial', 'nexa-agency' ),
				'view_item'          => esc_html__( 'View Testimonial', 'nexa-agency' ),
				'search_items'       => esc_html__( 'Search Testimonials', 'nexa-agency' ),
				'not_found'          => esc_html__( 'No testimonials found', 'nexa-agency' ),
				'not_found_in_trash' => esc_html__( 'No testimonials found in trash', 'nexa-agency' ),
				'menu_name'          => esc_html__( 'Testimonials', 'nexa-agency' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'show_in_rest'       => true,
			'has_archive'        => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon'          => 'dashicons-format-quote',
			'menu_position'      => 8,
		)
	);
}
add_action( 'init', 'nexa_register_post_types' );

/**
 * Register custom taxonomies.
 */
function nexa_register_taxonomies() {

	// Portfolio Category taxonomy.
	register_taxonomy(
		'nexa_portfolio_category',
		array( 'nexa_portfolio' ),
		array(
			'labels'            => array(
				'name'              => esc_html_x( 'Portfolio Categories', 'taxonomy general name', 'nexa-agency' ),
				'singular_name'     => esc_html_x( 'Portfolio Category', 'taxonomy singular name', 'nexa-agency' ),
				'search_items'      => esc_html__( 'Search Portfolio Categories', 'nexa-agency' ),
				'all_items'         => esc_html__( 'All Portfolio Categories', 'nexa-agency' ),
				'parent_item'       => esc_html__( 'Parent Portfolio Category', 'nexa-agency' ),
				'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'nexa-agency' ),
				'edit_item'         => esc_html__( 'Edit Portfolio Category', 'nexa-agency' ),
				'update_item'       => esc_html__( 'Update Portfolio Category', 'nexa-agency' ),
				'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'nexa-agency' ),
				'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'nexa-agency' ),
				'menu_name'         => esc_html__( 'Categories', 'nexa-agency' ),
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-category' ),
		)
	);
}
add_action( 'init', 'nexa_register_taxonomies' );

/**
 * Add meta boxes for custom post types.
 */
function nexa_add_meta_boxes() {
	add_meta_box(
		'nexa_portfolio_details',
		esc_html__( 'Project Details', 'nexa-agency' ),
		'nexa_portfolio_meta_box_callback',
		'nexa_portfolio',
		'normal',
		'high'
	);

	add_meta_box(
		'nexa_team_details',
		esc_html__( 'Team Member Details', 'nexa-agency' ),
		'nexa_team_meta_box_callback',
		'nexa_team',
		'normal',
		'high'
	);

	add_meta_box(
		'nexa_testimonial_details',
		esc_html__( 'Testimonial Details', 'nexa-agency' ),
		'nexa_testimonial_meta_box_callback',
		'nexa_testimonial',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'nexa_add_meta_boxes' );

/**
 * Portfolio meta box HTML.
 *
 * @param WP_Post $post Current post object.
 */
function nexa_portfolio_meta_box_callback( $post ) {
	wp_nonce_field( 'nexa_portfolio_meta', 'nexa_portfolio_meta_nonce' );
	$client = get_post_meta( $post->ID, '_nexa_portfolio_client', true );
	$year   = get_post_meta( $post->ID, '_nexa_portfolio_year', true );
	$url    = get_post_meta( $post->ID, '_nexa_portfolio_url', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="nexa_portfolio_client"><?php esc_html_e( 'Client', 'nexa-agency' ); ?></label></th>
			<td><input type="text" id="nexa_portfolio_client" name="nexa_portfolio_client" value="<?php echo esc_attr( $client ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_portfolio_year"><?php esc_html_e( 'Year', 'nexa-agency' ); ?></label></th>
			<td><input type="number" id="nexa_portfolio_year" name="nexa_portfolio_year" value="<?php echo esc_attr( $year ); ?>" class="small-text" min="2000" max="2099"></td>
		</tr>
		<tr>
			<th><label for="nexa_portfolio_url"><?php esc_html_e( 'Live URL', 'nexa-agency' ); ?></label></th>
			<td><input type="url" id="nexa_portfolio_url" name="nexa_portfolio_url" value="<?php echo esc_attr( $url ); ?>" class="regular-text"></td>
		</tr>
	</table>
	<?php
}

/**
 * Team member meta box HTML.
 *
 * @param WP_Post $post Current post object.
 */
function nexa_team_meta_box_callback( $post ) {
	wp_nonce_field( 'nexa_team_meta', 'nexa_team_meta_nonce' );
	$role     = get_post_meta( $post->ID, '_nexa_team_role', true );
	$linkedin = get_post_meta( $post->ID, '_nexa_team_linkedin', true );
	$twitter  = get_post_meta( $post->ID, '_nexa_team_twitter', true );
	$github   = get_post_meta( $post->ID, '_nexa_team_github', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="nexa_team_role"><?php esc_html_e( 'Role / Title', 'nexa-agency' ); ?></label></th>
			<td><input type="text" id="nexa_team_role" name="nexa_team_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_team_linkedin"><?php esc_html_e( 'LinkedIn URL', 'nexa-agency' ); ?></label></th>
			<td><input type="url" id="nexa_team_linkedin" name="nexa_team_linkedin" value="<?php echo esc_attr( $linkedin ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_team_twitter"><?php esc_html_e( 'Twitter/X URL', 'nexa-agency' ); ?></label></th>
			<td><input type="url" id="nexa_team_twitter" name="nexa_team_twitter" value="<?php echo esc_attr( $twitter ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_team_github"><?php esc_html_e( 'GitHub URL', 'nexa-agency' ); ?></label></th>
			<td><input type="url" id="nexa_team_github" name="nexa_team_github" value="<?php echo esc_attr( $github ); ?>" class="regular-text"></td>
		</tr>
	</table>
	<?php
}

/**
 * Testimonial meta box HTML.
 *
 * @param WP_Post $post Current post object.
 */
function nexa_testimonial_meta_box_callback( $post ) {
	wp_nonce_field( 'nexa_testimonial_meta', 'nexa_testimonial_meta_nonce' );
	$role    = get_post_meta( $post->ID, '_nexa_testimonial_role', true );
	$company = get_post_meta( $post->ID, '_nexa_testimonial_company', true );
	$rating  = get_post_meta( $post->ID, '_nexa_testimonial_rating', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="nexa_testimonial_role"><?php esc_html_e( 'Role', 'nexa-agency' ); ?></label></th>
			<td><input type="text" id="nexa_testimonial_role" name="nexa_testimonial_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_testimonial_company"><?php esc_html_e( 'Company', 'nexa-agency' ); ?></label></th>
			<td><input type="text" id="nexa_testimonial_company" name="nexa_testimonial_company" value="<?php echo esc_attr( $company ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th><label for="nexa_testimonial_rating"><?php esc_html_e( 'Star Rating (1-5)', 'nexa-agency' ); ?></label></th>
			<td>
				<select id="nexa_testimonial_rating" name="nexa_testimonial_rating">
					<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $rating, $i ); ?>>
							<?php echo esc_html( $i ); ?>
						</option>
					<?php endfor; ?>
				</select>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save portfolio meta box data.
 *
 * @param int $post_id Post ID.
 */
function nexa_save_portfolio_meta( $post_id ) {
	if ( ! isset( $_POST['nexa_portfolio_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexa_portfolio_meta_nonce'] ) ), 'nexa_portfolio_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['nexa_portfolio_client'] ) ) {
		update_post_meta( $post_id, '_nexa_portfolio_client', sanitize_text_field( wp_unslash( $_POST['nexa_portfolio_client'] ) ) );
	}
	if ( isset( $_POST['nexa_portfolio_year'] ) ) {
		update_post_meta( $post_id, '_nexa_portfolio_year', absint( $_POST['nexa_portfolio_year'] ) );
	}
	if ( isset( $_POST['nexa_portfolio_url'] ) ) {
		update_post_meta( $post_id, '_nexa_portfolio_url', esc_url_raw( wp_unslash( $_POST['nexa_portfolio_url'] ) ) );
	}
}
add_action( 'save_post_nexa_portfolio', 'nexa_save_portfolio_meta' );

/**
 * Save team meta box data.
 *
 * @param int $post_id Post ID.
 */
function nexa_save_team_meta( $post_id ) {
	if ( ! isset( $_POST['nexa_team_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexa_team_meta_nonce'] ) ), 'nexa_team_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array( 'nexa_team_role', 'nexa_team_linkedin', 'nexa_team_twitter', 'nexa_team_github' );
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			$meta_key   = '_' . $field;
			$meta_value = in_array( $field, array( 'nexa_team_linkedin', 'nexa_team_twitter', 'nexa_team_github' ), true )
				? esc_url_raw( wp_unslash( $_POST[ $field ] ) )
				: sanitize_text_field( wp_unslash( $_POST[ $field ] ) );
			update_post_meta( $post_id, $meta_key, $meta_value );
		}
	}
}
add_action( 'save_post_nexa_team', 'nexa_save_team_meta' );

/**
 * Save testimonial meta box data.
 *
 * @param int $post_id Post ID.
 */
function nexa_save_testimonial_meta( $post_id ) {
	if ( ! isset( $_POST['nexa_testimonial_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexa_testimonial_meta_nonce'] ) ), 'nexa_testimonial_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['nexa_testimonial_role'] ) ) {
		update_post_meta( $post_id, '_nexa_testimonial_role', sanitize_text_field( wp_unslash( $_POST['nexa_testimonial_role'] ) ) );
	}
	if ( isset( $_POST['nexa_testimonial_company'] ) ) {
		update_post_meta( $post_id, '_nexa_testimonial_company', sanitize_text_field( wp_unslash( $_POST['nexa_testimonial_company'] ) ) );
	}
	if ( isset( $_POST['nexa_testimonial_rating'] ) ) {
		update_post_meta( $post_id, '_nexa_testimonial_rating', min( 5, max( 1, absint( $_POST['nexa_testimonial_rating'] ) ) ) );
	}
}
add_action( 'save_post_nexa_testimonial', 'nexa_save_testimonial_meta' );
