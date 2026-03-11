<?php
/**
 * Blog preview section template part.
 *
 * @package NexaAgency
 */

$blog_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'no_found_rows'  => true,
	)
);
?>
<section id="blog" class="nexa-section nexa-blog-preview" aria-label="<?php esc_attr_e( 'Latest Blog Posts', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'Our Blog', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'Latest', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Insights & News', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( 'Stay ahead with our latest thoughts on design, development, and digital strategy.', 'nexa-agency' ); ?>
			</p>
		</header>

		<?php if ( $blog_query->have_posts() ) : ?>
			<div class="nexa-blog-preview__grid">
				<?php
				$delay = 0;
				while ( $blog_query->have_posts() ) :
					$blog_query->the_post();
					?>
					<article
						id="post-<?php the_ID(); ?>"
						<?php post_class( 'nexa-post-card' ); ?>
						data-aos="fade-up"
						data-aos-delay="<?php echo esc_attr( $delay ); ?>"
					>
						<div class="nexa-post-card__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
									<?php the_post_thumbnail( 'nexa-card', array( 'alt' => '' ) ); ?>
								</a>
							<?php else : ?>
								<div class="nexa-post-card__image-placeholder" aria-hidden="true">📰</div>
							<?php endif; ?>
						</div>
						<div class="nexa-post-card__body">
							<div class="nexa-post-card__meta">
								<span class="nexa-post-card__category"><?php the_category( ', ' ); ?></span>
								<span class="nexa-post-card__date"><?php echo esc_html( get_the_date() ); ?></span>
							</div>
							<h3 class="nexa-post-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="nexa-post-card__excerpt">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="nexa-btn nexa-btn--outline nexa-btn--sm">
								<?php esc_html_e( 'Read More', 'nexa-agency' ); ?>
							</a>
						</div>
					</article>
					<?php
					$delay += 100;
				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<div class="nexa-blog-preview__cta" data-aos="fade-up">
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>" class="nexa-btn nexa-btn--outline nexa-btn--lg">
					<?php esc_html_e( 'View All Posts', 'nexa-agency' ); ?>
					<span aria-hidden="true">&#8594;</span>
				</a>
			</div>

		<?php else : ?>
			<p class="nexa-text-center" style="color:var(--gray);">
				<?php esc_html_e( 'Blog posts coming soon. Stay tuned!', 'nexa-agency' ); ?>
			</p>
		<?php endif; ?>

	</div>
</section><!-- #blog -->
