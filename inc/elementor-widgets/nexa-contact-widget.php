<?php
/**
 * Elementor Contact Widget.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * NexaContact_Widget class.
 */
class NexaContact_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'nexa_contact';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Contact Section', 'nexa-agency' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'nexa-agency' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_contact_info',
			array(
				'label' => esc_html__( 'Contact Info', 'nexa-agency' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'contact_eyebrow',
			array(
				'label'   => esc_html__( 'Eyebrow Text', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get In Touch', 'nexa-agency' ),
			)
		);

		$this->add_control(
			'contact_title',
			array(
				'label'   => esc_html__( 'Title', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Let's Start Your Next Project", 'nexa-agency' ),
			)
		);

		$this->add_control(
			'contact_text',
			array(
				'label'   => esc_html__( 'Description', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Ready to transform your digital presence? Tell us about your project and we'll get back to you within 24 hours with a free consultation.", 'nexa-agency' ),
				'rows'    => 4,
			)
		);

		$this->add_control(
			'contact_email',
			array(
				'label'   => esc_html__( 'Email', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'hello@nexaagency.com',
			)
		);

		$this->add_control(
			'contact_phone',
			array(
				'label'   => esc_html__( 'Phone', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+1 (555) 123-4567',
			)
		);

		$this->add_control(
			'contact_address',
			array(
				'label'   => esc_html__( 'Address', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '123 Agency Street, New York, NY 10001',
			)
		);

		$this->add_control(
			'contact_hours',
			array(
				'label'   => esc_html__( 'Business Hours', 'nexa-agency' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Mon–Fri: 9:00 AM – 6:00 PM EST', 'nexa-agency' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings        = $this->get_settings_for_display();
		$contact_eyebrow = $settings['contact_eyebrow'];
		$contact_title   = $settings['contact_title'];
		$contact_text    = $settings['contact_text'];
		$email           = $settings['contact_email'];
		$phone           = $settings['contact_phone'];
		$address         = $settings['contact_address'];
		$hours           = $settings['contact_hours'];
		?>
		<section id="contact" class="nexa-section nexa-contact" aria-label="<?php esc_attr_e( 'Contact Us', 'nexa-agency' ); ?>">
			<div class="nexa-container">
				<div class="nexa-contact__inner">

					<!-- Contact Info -->
					<div class="nexa-contact__info-side" data-aos="fade-right">
						<?php if ( $contact_eyebrow ) : ?>
							<span class="nexa-eyebrow"><?php echo esc_html( $contact_eyebrow ); ?></span>
						<?php endif; ?>
						<?php if ( $contact_title ) : ?>
							<h2 class="nexa-contact__title">
								<?php
								if ( strpos( $contact_title, 'Your' ) !== false ) {
									$pos   = strpos( $contact_title, 'Your' );
									$part1 = substr( $contact_title, 0, $pos );
									$part2 = substr( $contact_title, $pos );
									echo esc_html( $part1 ) . '<span class="nexa-gradient-text">' . esc_html( $part2 ) . '</span>';
								} else {
									echo esc_html( $contact_title );
								}
								?>
							</h2>
						<?php endif; ?>
						<?php if ( $contact_text ) : ?>
							<p class="nexa-contact__text"><?php echo esc_html( $contact_text ); ?></p>
						<?php endif; ?>

						<div class="nexa-contact__info">
							<?php if ( $email ) : ?>
								<div class="nexa-contact__info-item">
									<div class="nexa-contact__info-icon" aria-hidden="true">✉️</div>
									<div>
										<p class="nexa-contact__info-label"><?php esc_html_e( 'Email', 'nexa-agency' ); ?></p>
										<p class="nexa-contact__info-value">
											<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
										</p>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( $phone ) : ?>
								<div class="nexa-contact__info-item">
									<div class="nexa-contact__info-icon" aria-hidden="true">📞</div>
									<div>
										<p class="nexa-contact__info-label"><?php esc_html_e( 'Phone', 'nexa-agency' ); ?></p>
										<p class="nexa-contact__info-value">
											<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
										</p>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( $address ) : ?>
								<div class="nexa-contact__info-item">
									<div class="nexa-contact__info-icon" aria-hidden="true">📍</div>
									<div>
										<p class="nexa-contact__info-label"><?php esc_html_e( 'Address', 'nexa-agency' ); ?></p>
										<p class="nexa-contact__info-value"><?php echo esc_html( $address ); ?></p>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( $hours ) : ?>
								<div class="nexa-contact__info-item">
									<div class="nexa-contact__info-icon" aria-hidden="true">🕐</div>
									<div>
										<p class="nexa-contact__info-label"><?php esc_html_e( 'Business Hours', 'nexa-agency' ); ?></p>
										<p class="nexa-contact__info-value"><?php echo esc_html( $hours ); ?></p>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<!-- Social Links -->
						<?php if ( function_exists( 'nexa_social_links' ) ) : ?>
							<?php $social = nexa_social_links( false ); ?>
							<?php if ( $social ) : ?>
								<div class="nexa-contact__social">
									<?php echo $social; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<!-- Contact Form -->
					<div class="nexa-contact__form-side" data-aos="fade-left" data-aos-delay="150">
						<div class="nexa-contact__form-wrap">
							<form
								id="nexa-contact-form"
								class="nexa-form"
								method="post"
								novalidate
								aria-label="<?php esc_attr_e( 'Contact form', 'nexa-agency' ); ?>"
							>
								<?php wp_nonce_field( 'nexa_contact_nonce', 'nexa_nonce' ); ?>

								<div class="nexa-form__row">
									<div class="nexa-form__field">
										<label class="nexa-form__label" for="nexa_name">
											<?php esc_html_e( 'Your Name', 'nexa-agency' ); ?>
											<span class="required" aria-hidden="true">*</span>
										</label>
										<input
											type="text"
											id="nexa_name"
											name="nexa_name"
											class="nexa-form__input"
											placeholder="<?php esc_attr_e( 'John Doe', 'nexa-agency' ); ?>"
											required
											autocomplete="name"
										>
										<span class="nexa-form__error" role="alert"></span>
									</div>

									<div class="nexa-form__field">
										<label class="nexa-form__label" for="nexa_email">
											<?php esc_html_e( 'Email Address', 'nexa-agency' ); ?>
											<span class="required" aria-hidden="true">*</span>
										</label>
										<input
											type="email"
											id="nexa_email"
											name="nexa_email"
											class="nexa-form__input"
											placeholder="<?php esc_attr_e( 'john@example.com', 'nexa-agency' ); ?>"
											required
											autocomplete="email"
										>
										<span class="nexa-form__error" role="alert"></span>
									</div>
								</div>

								<div class="nexa-form__row">
									<div class="nexa-form__field">
										<label class="nexa-form__label" for="nexa_phone">
											<?php esc_html_e( 'Phone (Optional)', 'nexa-agency' ); ?>
										</label>
										<input
											type="tel"
											id="nexa_phone"
											name="nexa_phone"
											class="nexa-form__input"
											placeholder="<?php esc_attr_e( '+1 (555) 000-0000', 'nexa-agency' ); ?>"
											autocomplete="tel"
										>
									</div>

									<div class="nexa-form__field">
										<label class="nexa-form__label" for="nexa_subject">
											<?php esc_html_e( 'Subject', 'nexa-agency' ); ?>
										</label>
										<input
											type="text"
											id="nexa_subject"
											name="nexa_subject"
											class="nexa-form__input"
											placeholder="<?php esc_attr_e( 'Project Inquiry', 'nexa-agency' ); ?>"
										>
									</div>
								</div>

								<div class="nexa-form__field">
									<label class="nexa-form__label" for="nexa_message">
										<?php esc_html_e( 'Message', 'nexa-agency' ); ?>
										<span class="required" aria-hidden="true">*</span>
									</label>
									<textarea
										id="nexa_message"
										name="nexa_message"
										class="nexa-form__textarea"
										rows="6"
										placeholder="<?php esc_attr_e( 'Tell us about your project, goals, and timeline...', 'nexa-agency' ); ?>"
										required
									></textarea>
									<span class="nexa-form__error" role="alert"></span>
								</div>

								<div class="nexa-form__message" role="status" aria-live="polite"></div>

								<button
									type="submit"
									class="nexa-btn nexa-btn--primary nexa-btn--lg nexa-contact-submit"
									style="width:100%;justify-content:center;"
								>
									<span class="nexa-btn__spinner" aria-hidden="true"></span>
									<?php esc_html_e( 'Send Message', 'nexa-agency' ); ?>
									<span aria-hidden="true">&#8594;</span>
								</button>

							</form>
						</div>
					</div>

				</div>
			</div>
		</section><!-- #contact -->
		<?php
	}
}
