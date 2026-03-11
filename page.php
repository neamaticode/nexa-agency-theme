<?php
/**
 * Page template.
 *
 * @package NexaAgency
 */

get_header();
?>
<main id="main" class="nexa-main nexa-page">
	<div class="nexa-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexa-page-content' ); ?>>
				<header class="nexa-entry-header">
					<?php nexa_breadcrumbs(); ?>
					<h1 class="nexa-entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="nexa-entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nexa-agency' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</article>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
