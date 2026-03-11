/* ==============================================
   CONTACT FORM - NexaAgency Theme
   AJAX form submission with validation
   ============================================== */

( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		const form = document.querySelector( '#nexa-contact-form' );
		if ( ! form ) {
			return;
		}

		const submitBtn    = form.querySelector( '.nexa-contact-submit' );
		const msgContainer = form.querySelector( '.nexa-form__message' );

		// ------------------------------------------
		// Validation helpers
		// ------------------------------------------

		/**
		 * Show an error on a field.
		 *
		 * @param {HTMLElement} field   The input/textarea element.
		 * @param {string}      message Error message to display.
		 */
		function showFieldError( field, message ) {
			const wrap    = field.closest( '.nexa-form__field' );
			const errSpan = wrap ? wrap.querySelector( '.nexa-form__error' ) : null;

			field.classList.add( 'has-error' );
			if ( wrap ) {
				wrap.classList.add( 'has-error' );
			}
			if ( errSpan ) {
				errSpan.textContent = message;
			}
		}

		/**
		 * Clear error state from a field.
		 *
		 * @param {HTMLElement} field The input/textarea element.
		 */
		function clearFieldError( field ) {
			const wrap    = field.closest( '.nexa-form__field' );
			const errSpan = wrap ? wrap.querySelector( '.nexa-form__error' ) : null;

			field.classList.remove( 'has-error' );
			if ( wrap ) {
				wrap.classList.remove( 'has-error' );
			}
			if ( errSpan ) {
				errSpan.textContent = '';
			}
		}

		/**
		 * Validate the contact form fields.
		 *
		 * @return {boolean} True if valid, false otherwise.
		 */
		function validateForm() {
			let isValid = true;
			const i18n  = ( 'undefined' !== typeof nexaContact ) ? nexaContact.i18n : {};

			// Name
			const nameField = form.querySelector( '[name="nexa_name"]' );
			if ( nameField ) {
				clearFieldError( nameField );
				if ( ! nameField.value.trim() ) {
					showFieldError( nameField, i18n.name_required || 'Please enter your name.' );
					isValid = false;
				}
			}

			// Email
			const emailField = form.querySelector( '[name="nexa_email"]' );
			if ( emailField ) {
				clearFieldError( emailField );
				const emailVal = emailField.value.trim();
				if ( ! emailVal ) {
					showFieldError( emailField, i18n.email_required || 'Please enter your email address.' );
					isValid = false;
				} else if ( ! isValidEmail( emailVal ) ) {
					showFieldError( emailField, i18n.email_invalid || 'Please enter a valid email address.' );
					isValid = false;
				}
			}

			// Message
			const msgField = form.querySelector( '[name="nexa_message"]' );
			if ( msgField ) {
				clearFieldError( msgField );
				if ( ! msgField.value.trim() ) {
					showFieldError( msgField, i18n.message_required || 'Please enter your message.' );
					isValid = false;
				} else if ( msgField.value.trim().length < 10 ) {
					showFieldError( msgField, i18n.message_short || 'Message must be at least 10 characters.' );
					isValid = false;
				}
			}

			return isValid;
		}

		/**
		 * Basic email format check.
		 *
		 * @param {string} email Email string to test.
		 * @return {boolean} True if valid format.
		 */
		function isValidEmail( email ) {
			return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( email );
		}

		// Clear errors on input
		form.querySelectorAll( '.nexa-form__input, .nexa-form__textarea' ).forEach( function ( field ) {
			field.addEventListener( 'input', function () {
				clearFieldError( field );
			} );
		} );

		// ------------------------------------------
		// Show form message
		// ------------------------------------------

		/**
		 * Display a success or error message.
		 *
		 * @param {string}  text    Message text.
		 * @param {boolean} success Whether it is a success message.
		 */
		function showMessage( text, success ) {
			if ( ! msgContainer ) {
				return;
			}
			msgContainer.textContent = text;
			msgContainer.className   = 'nexa-form__message ' + ( success ? 'success' : 'error' );
			msgContainer.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
		}

		/** Hide the form message. */
		function hideMessage() {
			if ( msgContainer ) {
				msgContainer.className   = 'nexa-form__message';
				msgContainer.textContent = '';
			}
		}

		// ------------------------------------------
		// Form submission
		// ------------------------------------------
		form.addEventListener( 'submit', function ( e ) {
			e.preventDefault();
			hideMessage();

			if ( ! validateForm() ) {
				return;
			}

			if ( 'undefined' === typeof nexaContact ) {
				showMessage( 'Configuration error. Please try again later.', false );
				return;
			}

			// Loading state
			submitBtn.classList.add( 'is-loading' );
			submitBtn.disabled = true;

			const formData = new FormData( form );
			formData.append( 'action', 'nexa_contact_form' );
			formData.append( 'nonce', nexaContact.nonce );

			fetch( nexaContact.ajax_url, {
				method:      'POST',
				credentials: 'same-origin',
				body:        formData,
			} )
				.then( function ( response ) {
					if ( ! response.ok ) {
						throw new Error( 'Network response was not ok.' );
					}
					return response.json();
				} )
				.then( function ( data ) {
					if ( data.success ) {
						showMessage(
							data.data && data.data.message
								? data.data.message
								: ( nexaContact.i18n.success || 'Message sent successfully! We\'ll be in touch soon.' ),
							true
						);
						form.reset();
					} else {
						showMessage(
							data.data && data.data.message
								? data.data.message
								: ( nexaContact.i18n.error || 'Something went wrong. Please try again.' ),
							false
						);
					}
				} )
				.catch( function () {
					showMessage(
						nexaContact.i18n.network_error || 'A network error occurred. Please check your connection.',
						false
					);
				} )
				.finally( function () {
					submitBtn.classList.remove( 'is-loading' );
					submitBtn.disabled = false;
				} );
		} );
	} );

} )();
