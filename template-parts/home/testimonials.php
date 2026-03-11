<?php
/**
 * Testimonials section template part.
 *
 * @package NexaAgency
 */

$testimonials = array(
	array(
		'stars'   => 5,
		'quote'   => esc_html__( "Working with NexaAgency was an absolute game-changer. They didn't just build us a website — they built us a growth engine. Our conversions increased by 340% within the first three months.", 'nexa-agency' ),
		'name'    => esc_html__( 'James Mitchell', 'nexa-agency' ),
		'role'    => esc_html__( 'CEO, TechVentures Inc.', 'nexa-agency' ),
		'avatar'  => '👨‍💼',
	),
	array(
		'stars'   => 5,
		'quote'   => esc_html__( "The team at NexaAgency understood our vision from day one. Their attention to detail, creative thinking, and technical expertise are unmatched. I've worked with many agencies, but none compare.", 'nexa-agency' ),
		'name'    => esc_html__( 'Priya Sharma', 'nexa-agency' ),
		'role'    => esc_html__( 'Founder, StyleHub', 'nexa-agency' ),
		'avatar'  => '👩‍💼',
	),
	array(
		'stars'   => 5,
		'quote'   => esc_html__( "Our mobile app launched on time, on budget, and exceeded every expectation. The post-launch support has been incredible. NexaAgency is our long-term technology partner.", 'nexa-agency' ),
		'name'    => esc_html__( 'Carlos Reyes', 'nexa-agency' ),
		'role'    => esc_html__( 'CTO, HealthFlow', 'nexa-agency' ),
		'avatar'  => '👨‍💻',
	),
);

// Use CPT if available.
$testimonial_query = new WP_Query(
	array(
		'post_type'      => 'nexa_testimonial',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);
$use_cpt = $testimonial_query->have_posts();
?>
<section id="testimonials" class="nexa-section nexa-testimonials" aria-label="<?php esc_attr_e( 'Testimonials', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'Client Stories', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'What Our', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Clients Say', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( "Don't take our word for it. Here's what our clients have to say about working with NexaAgency.", 'nexa-agency' ); ?>
			</p>
		</header>

		<div class="nexa-testimonials__grid">

			<?php if ( $use_cpt ) : ?>
				<?php while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post(); ?>
					<?php
					$rating  = (int) get_post_meta( get_the_ID(), '_nexa_testimonial_rating', true );
					$rating  = $rating ?: 5;
					$role    = get_post_meta( get_the_ID(), '_nexa_testimonial_role', true );
					$company = get_post_meta( get_the_ID(), '_nexa_testimonial_company', true );
					$role_company = trim( $role . ( $company ? ', ' . $company : '' ) );
					?>
					<div class="nexa-testimonial-card" data-aos="fade-up">
						<div class="nexa-testimonial-card__stars" aria-label="<?php echo esc_attr( sprintf( _n( '%d star rating', '%d star rating', $rating, 'nexa-agency' ), $rating ) ); ?>">
							<?php for ( $i = 0; $i < 5; $i++ ) : ?>
								<span><?php echo $i < $rating ? '★' : '☆'; ?></span>
							<?php endfor; ?>
						</div>
						<p class="nexa-testimonial-card__quote">"<?php echo wp_kses_post( get_the_content() ); ?>"</p>
						<div class="nexa-testimonial-card__author">
							<div class="nexa-testimonial-card__avatar" aria-hidden="true">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) ); ?>
								<?php else : ?>
									👤
								<?php endif; ?>
							</div>
							<div>
								<p class="nexa-testimonial-card__name"><?php the_title(); ?></p>
								<?php if ( $role_company ) : ?>
									<p class="nexa-testimonial-card__role"><?php echo esc_html( $role_company ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( $testimonials as $index => $item ) : ?>
					<div
						class="nexa-testimonial-card"
						data-aos="fade-up"
						data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
					>
						<div class="nexa-testimonial-card__stars" aria-label="<?php echo esc_attr( sprintf( _n( '%d star rating', '%d star rating', $item['stars'], 'nexa-agency' ), $item['stars'] ) ); ?>">
							<?php for ( $i = 0; $i < $item['stars']; $i++ ) : ?>
								<span>★</span>
							<?php endfor; ?>
						</div>
						<p class="nexa-testimonial-card__quote">"<?php echo esc_html( $item['quote'] ); ?>"</p>
						<div class="nexa-testimonial-card__author">
							<div class="nexa-testimonial-card__avatar" aria-hidden="true">
								<?php echo esc_html( $item['avatar'] ); ?>
							</div>
							<div>
								<p class="nexa-testimonial-card__name"><?php echo esc_html( $item['name'] ); ?></p>
								<p class="nexa-testimonial-card__role"><?php echo esc_html( $item['role'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div><!-- .nexa-testimonials__grid -->
	</div>
</section><!-- #testimonials -->
