<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package NexaAgency
 */

get_header();

$email   = nexa_get_customizer( 'contact_email', 'hello@nexaagency.com' );
$phone   = nexa_get_customizer( 'contact_phone', '+1 (555) 123-4567' );
$address = nexa_get_customizer( 'contact_address', '123 Agency Street, New York, NY 10001' );
?>
<main id="main" class="nexa-main">

	<!-- Page Header -->
	<div class="nexa-archive-header">
		<div class="nexa-container">
			<?php nexa_breadcrumbs(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="nexa-archive-title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="nexa-archive-description"><?php the_excerpt(); ?></p>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>

	<!-- Contact Section -->
	<?php get_template_part( 'template-parts/home/contact' ); ?>

	<!-- Map Placeholder -->
	<div class="nexa-section" style="padding-top:0;">
		<div class="nexa-container">
			<div
				style="
					background: var(--dark-2);
					border: 1px solid rgba(255,255,255,0.06);
					border-radius: 16px;
					height: 350px;
					display: flex;
					align-items: center;
					justify-content: center;
					font-size: 3rem;
				"
				aria-label="<?php esc_attr_e( 'Map placeholder', 'nexa-agency' ); ?>"
			>
				🗺️
			</div>
		</div>
	</div>

</main>
<?php
get_footer();
