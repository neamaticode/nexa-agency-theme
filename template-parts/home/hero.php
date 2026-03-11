<?php
/**
 * Hero section template part.
 *
 * @package NexaAgency
 */

$badge    = nexa_get_customizer( 'hero_badge', esc_html__( '🚀 Award-Winning Digital Agency', 'nexa-agency' ) );
$title    = nexa_get_customizer( 'hero_title', esc_html__( 'We Build Digital Experiences That Drive Results', 'nexa-agency' ) );
$subtitle = nexa_get_customizer( 'hero_subtitle', esc_html__( 'Full-service digital agency specializing in web design, mobile apps, and growth marketing. We transform your vision into high-performing digital products.', 'nexa-agency' ) );
$btn1_text = nexa_get_customizer( 'hero_btn1_text', esc_html__( 'View Our Work', 'nexa-agency' ) );
$btn1_url  = nexa_get_customizer( 'hero_btn1_url', '#portfolio' );
$btn2_text = nexa_get_customizer( 'hero_btn2_text', esc_html__( 'Get Free Quote', 'nexa-agency' ) );
$btn2_url  = nexa_get_customizer( 'hero_btn2_url', '#contact' );
?>
<section id="hero" class="nexa-hero" aria-label="<?php esc_attr_e( 'Hero section', 'nexa-agency' ); ?>">

	<!-- Decorative shapes -->
	<div class="nexa-hero__shapes" aria-hidden="true">
		<div class="nexa-hero__shape nexa-hero__shape--1"></div>
		<div class="nexa-hero__shape nexa-hero__shape--2"></div>
		<div class="nexa-hero__shape nexa-hero__shape--3"></div>
	</div>

	<div class="nexa-hero__inner">
		<div class="nexa-hero__content">

			<!-- Badge -->
			<?php if ( $badge ) : ?>
				<div class="nexa-hero__badge">
					<span class="nexa-hero__badge-dot" aria-hidden="true"></span>
					<?php echo esc_html( $badge ); ?>
				</div>
			<?php endif; ?>

			<!-- Title -->
			<h1 class="nexa-hero__title">
				<?php
				$title_words = explode( ' ', $title );
				$mid         = (int) ceil( count( $title_words ) / 2 );
				$line1       = implode( ' ', array_slice( $title_words, 0, $mid ) );
				$line2       = implode( ' ', array_slice( $title_words, $mid ) );
				echo esc_html( $line1 ) . ' <span class="nexa-gradient-text">' . esc_html( $line2 ) . '</span>';
				?>
			</h1>

			<!-- Subtitle -->
			<?php if ( $subtitle ) : ?>
				<p class="nexa-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>

			<!-- CTA Buttons -->
			<div class="nexa-hero__cta">
				<?php if ( $btn1_text && $btn1_url ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" class="nexa-btn nexa-btn--primary nexa-btn--lg">
						<?php echo esc_html( $btn1_text ); ?>
						<span aria-hidden="true">&#8594;</span>
					</a>
				<?php endif; ?>
				<?php if ( $btn2_text && $btn2_url ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" class="nexa-btn nexa-btn--ghost nexa-btn--lg">
						<?php echo esc_html( $btn2_text ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Stats -->
			<div class="nexa-hero__stats">
				<div class="nexa-hero__stat">
					<div class="nexa-hero__stat-number">
						<span class="nexa-counter" data-count="250" data-suffix="+">250+</span>
					</div>
					<div class="nexa-hero__stat-label"><?php esc_html_e( 'Projects Done', 'nexa-agency' ); ?></div>
				</div>
				<div class="nexa-hero__stat">
					<div class="nexa-hero__stat-number">
						<span class="nexa-counter" data-count="180" data-suffix="+">180+</span>
					</div>
					<div class="nexa-hero__stat-label"><?php esc_html_e( 'Happy Clients', 'nexa-agency' ); ?></div>
				</div>
				<div class="nexa-hero__stat">
					<div class="nexa-hero__stat-number">
						<span class="nexa-counter" data-count="8" data-suffix="+">8+</span>
					</div>
					<div class="nexa-hero__stat-label"><?php esc_html_e( 'Years Experience', 'nexa-agency' ); ?></div>
				</div>
			</div>

		</div><!-- .nexa-hero__content -->
	</div><!-- .nexa-hero__inner -->

</section><!-- #hero -->
