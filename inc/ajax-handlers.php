<?php
/**
 * AJAX handlers for contact form.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle the contact form AJAX submission.
 * Hooked to both wp_ajax_ (logged-in) and wp_ajax_nopriv_ (logged-out) actions.
 *
 * @return void Sends JSON response and exits.
 */
function nexa_handle_contact_form() {
	// Verify nonce.
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'nexa_contact_nonce' ) ) {
		wp_send_json_error(
			array( 'message' => esc_html__( 'Security check failed. Please refresh and try again.', 'nexa-agency' ) ),
			403
		);
	}

	// Sanitize inputs.
	$name    = isset( $_POST['nexa_name'] )    ? sanitize_text_field( wp_unslash( $_POST['nexa_name'] ) )       : '';
	$email   = isset( $_POST['nexa_email'] )   ? sanitize_email( wp_unslash( $_POST['nexa_email'] ) )           : '';
	$phone   = isset( $_POST['nexa_phone'] )   ? sanitize_text_field( wp_unslash( $_POST['nexa_phone'] ) )      : '';
	$subject = isset( $_POST['nexa_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['nexa_subject'] ) )    : '';
	$message = isset( $_POST['nexa_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nexa_message'] ) ) : '';

	// Validate required fields.
	$errors = array();

	if ( empty( $name ) ) {
		$errors['name'] = esc_html__( 'Name is required.', 'nexa-agency' );
	}

	if ( empty( $email ) ) {
		$errors['email'] = esc_html__( 'Email address is required.', 'nexa-agency' );
	} elseif ( ! is_email( $email ) ) {
		$errors['email'] = esc_html__( 'Please enter a valid email address.', 'nexa-agency' );
	}

	if ( empty( $message ) ) {
		$errors['message'] = esc_html__( 'Message is required.', 'nexa-agency' );
	} elseif ( strlen( $message ) < 10 ) {
		$errors['message'] = esc_html__( 'Message must be at least 10 characters.', 'nexa-agency' );
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please fix the errors and try again.', 'nexa-agency' ),
				'errors'  => $errors,
			),
			422
		);
	}

	// Build email.
	$admin_email = get_option( 'admin_email' );
	$to_email    = nexa_get_customizer( 'contact_email', $admin_email );
	$to_email    = is_email( $to_email ) ? $to_email : $admin_email;

	$email_subject = $subject
		? sprintf(
			/* translators: 1: Site name, 2: Subject */
			esc_html__( '[%1$s] %2$s', 'nexa-agency' ),
			get_bloginfo( 'name' ),
			$subject
		)
		: sprintf(
			/* translators: 1: Site name, 2: Sender name */
			esc_html__( '[%1$s] New Contact Message from %2$s', 'nexa-agency' ),
			get_bloginfo( 'name' ),
			$name
		);

	$email_body  = esc_html__( 'You have received a new message via the contact form.', 'nexa-agency' ) . "\n\n";
	$email_body .= esc_html__( 'Name:', 'nexa-agency' ) . ' ' . $name . "\n";
	$email_body .= esc_html__( 'Email:', 'nexa-agency' ) . ' ' . $email . "\n";
	if ( $phone ) {
		$email_body .= esc_html__( 'Phone:', 'nexa-agency' ) . ' ' . $phone . "\n";
	}
	$email_body .= "\n" . esc_html__( 'Message:', 'nexa-agency' ) . "\n" . $message . "\n\n";
	$email_body .= '---' . "\n";
	$email_body .= sprintf(
		/* translators: %s: Site URL */
		esc_html__( 'Sent via %s', 'nexa-agency' ),
		home_url()
	);

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	$sent = wp_mail( $to_email, $email_subject, $email_body, $headers );

	if ( $sent ) {
		wp_send_json_success(
			array(
				'message' => esc_html__( "Message sent successfully! We'll be in touch within 24 hours.", 'nexa-agency' ),
			)
		);
	} else {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'There was an error sending your message. Please try again or contact us directly.', 'nexa-agency' ),
			),
			500
		);
	}
}
add_action( 'wp_ajax_nexa_contact_form', 'nexa_handle_contact_form' );
add_action( 'wp_ajax_nopriv_nexa_contact_form', 'nexa_handle_contact_form' );
