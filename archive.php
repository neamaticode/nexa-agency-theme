<?php
/**
 * Archive template.
 *
 * @package NexaAgency
 */

get_header();
?>
<main id="main" class="nexa-main">

	<!-- Archive Header -->
	<div class="nexa-archive-header">
		<div class="nexa-container">
			<?php nexa_breadcrumbs(); ?>
			<h1 class="nexa-archive-title">
				<?php
				if ( is_category() ) {
					single_cat_title();
				} elseif ( is_tag() ) {
					single_tag_title();
				} elseif ( is_author() ) {
					printf(
						/* translators: %s: Author name */
						esc_html__( 'Posts by %s', 'nexa-agency' ),
						'<span>' . esc_html( get_the_author() ) . '</span>'
					);
				} elseif ( is_year() ) {
					printf(
						/* translators: %s: Year */
						esc_html__( 'Year: %s', 'nexa-agency' ),
						'<span>' . esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'nexa-agency' ) ) ) . '</span>'
					);
				} elseif ( is_month() ) {
					printf(
						/* translators: %s: Month and year */
						esc_html__( 'Month: %s', 'nexa-agency' ),
						'<span>' . esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'nexa-agency' ) ) ) . '</span>'
					);
				} elseif ( is_day() ) {
					printf(
						/* translators: %s: Date */
						esc_html__( 'Day: %s', 'nexa-agency' ),
						'<span>' . esc_html( get_the_date( _x( 'F j, Y', 'daily archives date format', 'nexa-agency' ) ) ) . '</span>'
					);
				} elseif ( is_post_type_archive() ) {
					post_type_archive_title();
				} elseif ( is_tax() ) {
					single_term_title();
				} else {
					esc_html_e( 'Archives', 'nexa-agency' );
				}
				?>
			</h1>

			<?php
			$archive_description = get_the_archive_description();
			if ( $archive_description ) :
				?>
				<div class="nexa-archive-description">
					<?php echo wp_kses_post( $archive_description ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Archive Posts Grid -->
	<div class="nexa-section">
		<div class="nexa-container">
			<?php if ( have_posts() ) : ?>
				<div class="nexa-blog-grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
					<?php endwhile; ?>
				</div>

				<!-- Pagination -->
				<nav class="nexa-pagination" aria-label="<?php esc_attr_e( 'Posts pagination', 'nexa-agency' ); ?>">
					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => esc_html__( '&larr;', 'nexa-agency' ),
							'next_text'          => esc_html__( '&rarr;', 'nexa-agency' ),
							'screen_reader_text' => esc_html__( 'Posts navigation', 'nexa-agency' ),
							'class'              => 'nexa-pagination',
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
