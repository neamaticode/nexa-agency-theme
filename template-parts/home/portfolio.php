<?php
/**
 * Portfolio section template part.
 *
 * @package NexaAgency
 */

$portfolio_items = array(
	array(
		'emoji'    => '🌐',
		'title'    => esc_html__( 'TechCorp Website Redesign', 'nexa-agency' ),
		'category' => 'web-design',
		'cat_label' => esc_html__( 'Web Design', 'nexa-agency' ),
	),
	array(
		'emoji'    => '📱',
		'title'    => esc_html__( 'HealthTrack Mobile App', 'nexa-agency' ),
		'category' => 'mobile-app',
		'cat_label' => esc_html__( 'Mobile App', 'nexa-agency' ),
	),
	array(
		'emoji'    => '✨',
		'title'    => esc_html__( 'LuxeBrand Identity System', 'nexa-agency' ),
		'category' => 'branding',
		'cat_label' => esc_html__( 'Branding', 'nexa-agency' ),
	),
	array(
		'emoji'    => '🛒',
		'title'    => esc_html__( 'ShopNow E-Commerce Platform', 'nexa-agency' ),
		'category' => 'web-design',
		'cat_label' => esc_html__( 'Web Design', 'nexa-agency' ),
	),
	array(
		'emoji'    => '🚗',
		'title'    => esc_html__( 'DriveEasy Fleet Management App', 'nexa-agency' ),
		'category' => 'mobile-app',
		'cat_label' => esc_html__( 'Mobile App', 'nexa-agency' ),
	),
	array(
		'emoji'    => '🎯',
		'title'    => esc_html__( 'StartupCo Brand Launch', 'nexa-agency' ),
		'category' => 'branding',
		'cat_label' => esc_html__( 'Branding', 'nexa-agency' ),
	),
);

// Use CPT if available.
$cpt_query = new WP_Query(
	array(
		'post_type'      => 'nexa_portfolio',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
	)
);
$use_cpt = $cpt_query->have_posts();
?>
<section id="portfolio" class="nexa-section nexa-portfolio" aria-label="<?php esc_attr_e( 'Portfolio', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'Our Work', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'Projects We', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Are Proud Of', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( 'A selection of our best work across web design, mobile development, and brand identity projects.', 'nexa-agency' ); ?>
			</p>
		</header>

		<!-- Filter Buttons -->
		<div class="nexa-portfolio__filters" role="tablist" aria-label="<?php esc_attr_e( 'Portfolio filter', 'nexa-agency' ); ?>">
			<button class="nexa-filter-btn is-active" data-filter="all" role="tab" aria-selected="true">
				<?php esc_html_e( 'All', 'nexa-agency' ); ?>
			</button>
			<button class="nexa-filter-btn" data-filter="web-design" role="tab" aria-selected="false">
				<?php esc_html_e( 'Web Design', 'nexa-agency' ); ?>
			</button>
			<button class="nexa-filter-btn" data-filter="mobile-app" role="tab" aria-selected="false">
				<?php esc_html_e( 'Mobile App', 'nexa-agency' ); ?>
			</button>
			<button class="nexa-filter-btn" data-filter="branding" role="tab" aria-selected="false">
				<?php esc_html_e( 'Branding', 'nexa-agency' ); ?>
			</button>
		</div>

		<!-- Portfolio Grid -->
		<div class="nexa-portfolio__grid">

			<?php if ( $use_cpt ) : ?>
				<?php while ( $cpt_query->have_posts() ) : $cpt_query->the_post(); ?>
					<?php
					$cat_terms = get_the_terms( get_the_ID(), 'nexa_portfolio_category' );
					$cat_slug  = ( $cat_terms && ! is_wp_error( $cat_terms ) ) ? $cat_terms[0]->slug : '';
					$cat_name  = ( $cat_terms && ! is_wp_error( $cat_terms ) ) ? $cat_terms[0]->name : '';
					?>
					<div
						class="nexa-portfolio__item"
						data-category="<?php echo esc_attr( $cat_slug ); ?>"
						data-aos="fade-up"
					>
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

			<?php else : ?>
				<?php foreach ( $portfolio_items as $index => $item ) : ?>
					<div
						class="nexa-portfolio__item"
						data-category="<?php echo esc_attr( $item['category'] ); ?>"
						data-aos="fade-up"
						data-aos-delay="<?php echo esc_attr( ( $index % 3 ) * 100 ); ?>"
					>
						<div class="nexa-portfolio__placeholder" aria-hidden="true">
							<?php echo esc_html( $item['emoji'] ); ?>
						</div>
						<div class="nexa-portfolio__overlay">
							<div class="nexa-portfolio__overlay-content">
								<p class="nexa-portfolio__category"><?php echo esc_html( $item['cat_label'] ); ?></p>
								<h3 class="nexa-portfolio__title"><?php echo esc_html( $item['title'] ); ?></h3>
								<a href="#contact" class="nexa-btn nexa-btn--sm nexa-btn--primary">
									<?php esc_html_e( 'View Project', 'nexa-agency' ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div><!-- .nexa-portfolio__grid -->

		<div class="nexa-text-center" style="margin-top:3rem;" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'nexa_portfolio' ) ? get_post_type_archive_link( 'nexa_portfolio' ) : '#' ); ?>" class="nexa-btn nexa-btn--outline nexa-btn--lg">
				<?php esc_html_e( 'View All Projects', 'nexa-agency' ); ?>
			</a>
		</div>

	</div>
</section><!-- #portfolio -->
