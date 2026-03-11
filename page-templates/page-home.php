<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package NexaAgency
 */

get_header();
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
get_footer();
