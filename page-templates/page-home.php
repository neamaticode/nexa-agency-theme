<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package NexaAgency
 */

get_header();

// Check if Elementor is active and this page has Elementor content.
$use_elementor = (
	did_action( 'elementor/loaded' ) &&
	class_exists( '\Elementor\Plugin' ) &&
	\Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() )
);

if ( $use_elementor ) {
	// Render via Elementor. Elementor handles its own output sanitization.
	?>
	<main id="main" class="nexa-main elementor-page">
		<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Elementor sanitizes its own output ?>
	</main>
	<?php
} else {
	?>
	<main id="main" class="nexa-main">
		<?php get_template_part( 'template-parts/home/hero' ); ?>
		<?php get_template_part( 'template-parts/home/services' ); ?>
		<?php get_template_part( 'template-parts/home/about' ); ?>
		<?php get_template_part( 'template-parts/home/stats' ); ?>
		<?php get_template_part( 'template-parts/home/portfolio' ); ?>
		<?php get_template_part( 'template-parts/home/team' ); ?>
		<?php get_template_part( 'template-parts/home/testimonials' ); ?>
		<?php get_template_part( 'template-parts/home/pricing' ); ?>
		<?php get_template_part( 'template-parts/home/blog-preview' ); ?>
		<?php get_template_part( 'template-parts/home/contact' ); ?>
	</main>
	<?php
}

get_footer();

