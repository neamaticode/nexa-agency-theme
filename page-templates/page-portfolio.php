<?php
/**
 * Template Name: Portfolio
 * Template Post Type: page
 *
 * @package NexaAgency
 */

get_header();

$current_filter = isset( $_GET['filter'] ) ? sanitize_key( $_GET['filter'] ) : 'all'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

$tax_query = array();
if ( 'all' !== $current_filter ) {
	$tax_query = array(
		array(
			'taxonomy' => 'nexa_portfolio_category',
			'field'    => 'slug',
			'terms'    => $current_filter,
		),
	);
}

$portfolio_query = new WP_Query(
	array(
		'post_type'      => 'nexa_portfolio',
		'posts_per_page' => 12,
		'post_status'    => 'publish',
		'tax_query'      => $tax_query, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	)
);

$categories = get_terms(
	array(
		'taxonomy'   => 'nexa_portfolio_category',
		'hide_empty' => true,
	)
);
?>
<main id="main" class="nexa-main">

	<!-- Page Header -->
	<div class="nexa-archive-header">
		<div class="nexa-container">
			<?php nexa_breadcrumbs(); ?>
			<h1 class="nexa-archive-title"><?php the_title(); ?></h1>
			<?php
			while ( have_posts() ) :
				the_post();
				$page_desc = get_the_excerpt();
				if ( $page_desc ) :
					?>
					<p class="nexa-archive-description"><?php echo esc_html( $page_desc ); ?></p>
					<?php
				endif;
			endwhile;
			?>
		</div>
	</div>

	<!-- Portfolio Content -->
	<div class="nexa-section">
		<div class="nexa-container">

			<!-- Filter Buttons -->
			<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
				<div class="nexa-portfolio__filters">
					<a
						href="<?php echo esc_url( get_permalink() ); ?>"
						class="nexa-filter-btn<?php echo 'all' === $current_filter ? ' is-active' : ''; ?>"
					>
						<?php esc_html_e( 'All', 'nexa-agency' ); ?>
					</a>
					<?php foreach ( $categories as $cat ) : ?>
						<a
							href="<?php echo esc_url( add_query_arg( 'filter', $cat->slug, get_permalink() ) ); ?>"
							class="nexa-filter-btn<?php echo $current_filter === $cat->slug ? ' is-active' : ''; ?>"
						>
							<?php echo esc_html( $cat->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<!-- Portfolio Grid -->
			<?php if ( $portfolio_query->have_posts() ) : ?>
				<div class="nexa-portfolio__grid">
					<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
						<?php
						$cat_terms = get_the_terms( get_the_ID(), 'nexa_portfolio_category' );
						$cat_slug  = ( $cat_terms && ! is_wp_error( $cat_terms ) ) ? $cat_terms[0]->slug : '';
						$cat_name  = ( $cat_terms && ! is_wp_error( $cat_terms ) ) ? $cat_terms[0]->name : '';
						$client    = get_post_meta( get_the_ID(), '_nexa_portfolio_client', true );
						$year      = get_post_meta( get_the_ID(), '_nexa_portfolio_year', true );
						$url       = get_post_meta( get_the_ID(), '_nexa_portfolio_url', true );
						?>
						<div class="nexa-portfolio__item" data-category="<?php echo esc_attr( $cat_slug ); ?>" data-aos="fade-up">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'nexa-card', array( 'alt' => '' ) ); ?>
							<?php else : ?>
								<div class="nexa-portfolio__placeholder" aria-hidden="true">🎨</div>
							<?php endif; ?>
							<div class="nexa-portfolio__overlay">
								<div class="nexa-portfolio__overlay-content">
									<p class="nexa-portfolio__category"><?php echo esc_html( $cat_name ); ?></p>
									<h3 class="nexa-portfolio__title"><?php the_title(); ?></h3>
									<a href="<?php the_permalink(); ?>" class="nexa-btn nexa-btn--sm nexa-btn--primary">
										<?php esc_html_e( 'View Project', 'nexa-agency' ); ?>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>

				<nav class="nexa-pagination" aria-label="<?php esc_attr_e( 'Portfolio pagination', 'nexa-agency' ); ?>">
					<?php
					$big = 999999999;
					echo paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						array(
							'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $portfolio_query->max_num_pages,
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'class'     => 'nexa-pagination',
						)
					);
					?>
				</nav>

			<?php else : ?>
				<p class="nexa-text-center" style="color:var(--gray);padding:3rem 0;">
					<?php esc_html_e( 'No portfolio projects found.', 'nexa-agency' ); ?>
				</p>
			<?php endif; ?>

		</div>
	</div>

</main>
<?php
get_footer();
