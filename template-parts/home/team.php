<?php
/**
 * Team section template part.
 *
 * @package NexaAgency
 */

$team_members = array(
	array(
		'emoji'    => '👨‍💼',
		'name'     => esc_html__( 'Alex Morgan', 'nexa-agency' ),
		'role'     => esc_html__( 'CEO & Founder', 'nexa-agency' ),
		'bio'      => esc_html__( 'Visionary leader with 12+ years building digital products for Fortune 500 companies.', 'nexa-agency' ),
		'linkedin' => '#',
		'twitter'  => '#',
		'github'   => '',
	),
	array(
		'emoji'    => '👩‍🎨',
		'name'     => esc_html__( 'Sarah Chen', 'nexa-agency' ),
		'role'     => esc_html__( 'Creative Director', 'nexa-agency' ),
		'bio'      => esc_html__( 'Award-winning designer who crafts brand identities and digital experiences that resonate.', 'nexa-agency' ),
		'linkedin' => '#',
		'twitter'  => '#',
		'github'   => '',
	),
	array(
		'emoji'    => '👨‍💻',
		'name'     => esc_html__( 'Marcus Rivera', 'nexa-agency' ),
		'role'     => esc_html__( 'Lead Developer', 'nexa-agency' ),
		'bio'      => esc_html__( 'Full-stack engineer passionate about clean code, performance, and cutting-edge technologies.', 'nexa-agency' ),
		'linkedin' => '#',
		'twitter'  => '',
		'github'   => '#',
	),
	array(
		'emoji'    => '👩‍📊',
		'name'     => esc_html__( 'Emma Johnson', 'nexa-agency' ),
		'role'     => esc_html__( 'Marketing Strategist', 'nexa-agency' ),
		'bio'      => esc_html__( 'Growth hacker who has scaled startups from zero to millions in revenue through strategic marketing.', 'nexa-agency' ),
		'linkedin' => '#',
		'twitter'  => '#',
		'github'   => '',
	),
);

// Use CPT if available.
$team_query = new WP_Query(
	array(
		'post_type'      => 'nexa_team',
		'posts_per_page' => 4,
		'post_status'    => 'publish',
	)
);
$use_cpt = $team_query->have_posts();
?>
<section id="team" class="nexa-section nexa-team" aria-label="<?php esc_attr_e( 'Our Team', 'nexa-agency' ); ?>">
	<div class="nexa-container">

		<header class="nexa-section-header" data-aos="fade-up">
			<span class="nexa-eyebrow"><?php esc_html_e( 'The People', 'nexa-agency' ); ?></span>
			<h2 class="nexa-section-title">
				<?php esc_html_e( 'Meet The', 'nexa-agency' ); ?>
				<span class="nexa-gradient-text"><?php esc_html_e( 'Dream Team', 'nexa-agency' ); ?></span>
			</h2>
			<p class="nexa-section-subtitle">
				<?php esc_html_e( 'A talented group of designers, developers, and strategists dedicated to making your project a success.', 'nexa-agency' ); ?>
			</p>
		</header>

		<div class="nexa-team__grid">

			<?php if ( $use_cpt ) : ?>
				<?php while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
					<?php
					$role     = get_post_meta( get_the_ID(), '_nexa_team_role', true );
					$linkedin = get_post_meta( get_the_ID(), '_nexa_team_linkedin', true );
					$twitter  = get_post_meta( get_the_ID(), '_nexa_team_twitter', true );
					$github   = get_post_meta( get_the_ID(), '_nexa_team_github', true );
					?>
					<div class="nexa-team-card" data-aos="fade-up">
						<div class="nexa-team-card__photo">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'nexa-portrait', array( 'alt' => get_the_title() ) ); ?>
							<?php else : ?>
								<div class="nexa-team-card__placeholder" aria-hidden="true">👤</div>
							<?php endif; ?>
							<div class="nexa-team-card__social" aria-label="<?php esc_attr_e( 'Social links', 'nexa-agency' ); ?>">
								<?php if ( $linkedin ) : ?>
									<a href="<?php echo esc_url( $linkedin ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'nexa-agency' ); ?>">in</a>
								<?php endif; ?>
								<?php if ( $twitter ) : ?>
									<a href="<?php echo esc_url( $twitter ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Twitter', 'nexa-agency' ); ?>">𝕏</a>
								<?php endif; ?>
								<?php if ( $github ) : ?>
									<a href="<?php echo esc_url( $github ); ?>" class="nexa-team-card__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'GitHub', 'nexa-agency' ); ?>">⌥</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="nexa-team-card__body">
							<h3 class="nexa-team-card__name"><?php the_title(); ?></h3>
							<?php if ( $role ) : ?>
								<p class="nexa-team-card__role"><?php echo esc_html( $role ); ?></p>
							<?php endif; ?>
							<p class="nexa-team-card__bio"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( $team_members as $index => $member ) : ?>
					<div
						class="nexa-team-card"
						data-aos="fade-up"
						data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
					>
						<div class="nexa-team-card__photo">
							<div class="nexa-team-card__placeholder" aria-hidden="true">
								<?php echo esc_html( $member['emoji'] ); ?>
							</div>
							<div class="nexa-team-card__social" aria-label="<?php esc_attr_e( 'Social links', 'nexa-agency' ); ?>">
								<?php if ( $member['linkedin'] ) : ?>
									<a href="<?php echo esc_url( $member['linkedin'] ); ?>" class="nexa-team-card__social-link" aria-label="<?php esc_attr_e( 'LinkedIn', 'nexa-agency' ); ?>">in</a>
								<?php endif; ?>
								<?php if ( $member['twitter'] ) : ?>
									<a href="<?php echo esc_url( $member['twitter'] ); ?>" class="nexa-team-card__social-link" aria-label="<?php esc_attr_e( 'Twitter', 'nexa-agency' ); ?>">𝕏</a>
								<?php endif; ?>
								<?php if ( $member['github'] ) : ?>
									<a href="<?php echo esc_url( $member['github'] ); ?>" class="nexa-team-card__social-link" aria-label="<?php esc_attr_e( 'GitHub', 'nexa-agency' ); ?>">⌥</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="nexa-team-card__body">
							<h3 class="nexa-team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
							<p class="nexa-team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
							<p class="nexa-team-card__bio"><?php echo esc_html( $member['bio'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div><!-- .nexa-team__grid -->
	</div>
</section><!-- #team -->
