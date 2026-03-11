<?php
/**
 * Search results template.
 *
 * @package NexaAgency
 */

get_header();
?>
<main id="main" class="nexa-main">

	<div class="nexa-search-header">
		<div class="nexa-container">
			<h1 class="nexa-archive-title">
				<?php
				printf(
					/* translators: %s: Search query */
					esc_html__( 'Search Results for: %s', 'nexa-agency' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
			<p class="nexa-search-header__count">
				<?php
				$found_posts = $wp_query->found_posts; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				printf(
					/* translators: 1: Found count, 2: Search query */
					esc_html( _n( 'Found <strong>%1$s</strong> result for "%2$s"', 'Found <strong>%1$s</strong> results for "%2$s"', $found_posts, 'nexa-agency' ) ),
					esc_html( number_format_i18n( $found_posts ) ),
					esc_html( get_search_query() )
				);
				?>
			</p>
		</div>
	</div>

	<div class="nexa-section">
		<div class="nexa-container">
			<?php if ( have_posts() ) : ?>
				<div class="nexa-blog-grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
					<?php endwhile; ?>
				</div>

				<nav class="nexa-pagination" aria-label="<?php esc_attr_e( 'Search results pagination', 'nexa-agency' ); ?>">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => esc_html__( '&larr;', 'nexa-agency' ),
							'next_text' => esc_html__( '&rarr;', 'nexa-agency' ),
						)
					);
					?>
				</nav>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</div>

</main>
<?php
get_footer();
