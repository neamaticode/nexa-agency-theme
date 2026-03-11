<?php
/**
 * Single post template.
 *
 * @package NexaAgency
 */

get_header();
?>
<main id="main" class="nexa-main nexa-page">
	<div class="nexa-container">
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexa-single-post' ); ?>>

				<header class="nexa-single-post__header">
					<?php nexa_breadcrumbs(); ?>

					<div class="nexa-single-post__meta">
						<?php the_category( ', ' ); ?>
						<span><?php echo esc_html( get_the_date() ); ?></span>
						<span>
							<?php
							printf(
								/* translators: %s: Author name */
								esc_html__( 'By %s', 'nexa-agency' ),
								'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
							);
							?>
						</span>
						<span>
							<?php
							$comments_count = get_comments_number();
							$comments_text  = sprintf(
								/* translators: %s: Comment count */
								esc_html( _n( '%s Comment', '%s Comments', $comments_count, 'nexa-agency' ) ),
								esc_html( number_format_i18n( $comments_count ) )
							);
							?>
							<a href="<?php comments_link(); ?>"><?php echo esc_html( $comments_text ); ?></a>
						</span>
					</div>

					<h1 class="nexa-single-post__title"><?php the_title(); ?></h1>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="nexa-single-post__thumbnail">
							<?php the_post_thumbnail( 'nexa-hero', array( 'alt' => get_the_title() ) ); ?>
						</div>
					<?php endif; ?>
				</header>

				<div class="nexa-entry-content nexa-single-post__content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="nexa-page-links">' . esc_html__( 'Pages:', 'nexa-agency' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<footer class="nexa-single-post__footer">
					<?php
					the_tags(
						'<div class="nexa-post-tags">',
						', ',
						'</div>'
					);
					?>
				</footer>

			</article>

			<!-- Author Box -->
			<?php
			$author_bio = get_the_author_meta( 'description' );
			if ( $author_bio ) :
				?>
			<div class="nexa-author-box">
				<div class="nexa-author-box__avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', get_the_author(), array( 'class' => '' ) ); ?>
				</div>
				<div class="nexa-author-box__content">
					<p class="nexa-author-box__name">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php the_author(); ?>
						</a>
					</p>
					<p class="nexa-author-box__bio"><?php echo wp_kses_post( $author_bio ); ?></p>
				</div>
			</div>
			<?php endif; ?>

			<!-- Post Navigation -->
			<nav class="nexa-post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'nexa-agency' ); ?>">
				<?php $prev_post = get_previous_post(); ?>
				<?php if ( $prev_post ) : ?>
					<div class="nexa-post-navigation__item nexa-post-navigation__item--prev">
						<p class="nexa-post-navigation__label">&#8592; <?php esc_html_e( 'Previous Post', 'nexa-agency' ); ?></p>
						<p class="nexa-post-navigation__title">
							<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
								<?php echo esc_html( get_the_title( $prev_post ) ); ?>
							</a>
						</p>
					</div>
				<?php else : ?>
					<div></div>
				<?php endif; ?>

				<?php $next_post = get_next_post(); ?>
				<?php if ( $next_post ) : ?>
					<div class="nexa-post-navigation__item nexa-post-navigation__item--next">
						<p class="nexa-post-navigation__label"><?php esc_html_e( 'Next Post', 'nexa-agency' ); ?> &#8594;</p>
						<p class="nexa-post-navigation__title">
							<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
								<?php echo esc_html( get_the_title( $next_post ) ); ?>
							</a>
						</p>
					</div>
				<?php endif; ?>
			</nav>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
