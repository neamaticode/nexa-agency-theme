<?php
/**
 * Theme helper functions.
 *
 * @package NexaAgency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme mod with a fallback default.
 *
 * @param string $key     Theme mod key.
 * @param mixed  $default Default value if not set.
 * @return mixed
 */
function nexa_get_customizer( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * Output or return social links HTML built from customizer values.
 *
 * @param bool $echo Whether to echo (true) or return (false).
 * @return string|void HTML string when $echo is false.
 */
function nexa_social_links( $echo = true ) {
	$networks = array(
		'social_facebook'  => array( esc_html__( 'Facebook', 'nexa-agency' ), 'f' ),
		'social_twitter'   => array( esc_html__( 'Twitter', 'nexa-agency' ), '𝕏' ),
		'social_instagram' => array( esc_html__( 'Instagram', 'nexa-agency' ), '📷' ),
		'social_linkedin'  => array( esc_html__( 'LinkedIn', 'nexa-agency' ), 'in' ),
		'social_youtube'   => array( esc_html__( 'YouTube', 'nexa-agency' ), '▶' ),
	);

	$html = '';
	foreach ( $networks as $key => [ $label, $icon ] ) {
		$url = nexa_get_customizer( $key, '' );
		if ( $url ) {
			$html .= sprintf(
				'<a href="%s" class="nexa-footer__social-link nexa-contact__social-link" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a>',
				esc_url( $url ),
				esc_attr( $label ),
				esc_html( $icon )
			);
		}
	}

	if ( ! $html ) {
		return $echo ? null : '';
	}

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped above
	} else {
		return $html;
	}
}

/**
 * Output breadcrumb navigation.
 *
 * @return void
 */
function nexa_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$separator = '<span class="sep" aria-hidden="true"> / </span>';
	$crumbs    = array();

	$crumbs[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'nexa-agency' ) . '</a>';

	if ( is_single() ) {
		$categories = get_the_category();
		if ( $categories ) {
			$crumbs[] = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
		}
		$crumbs[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_page() ) {
		$ancestors = get_post_ancestors( get_the_ID() );
		if ( $ancestors ) {
			foreach ( array_reverse( $ancestors ) as $ancestor_id ) {
				$crumbs[] = '<a href="' . esc_url( get_permalink( $ancestor_id ) ) . '">' . esc_html( get_the_title( $ancestor_id ) ) . '</a>';
			}
		}
		$crumbs[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_category() ) {
		$crumbs[] = '<span>' . esc_html( single_cat_title( '', false ) ) . '</span>';
	} elseif ( is_tag() ) {
		$crumbs[] = '<span>' . esc_html( single_tag_title( '', false ) ) . '</span>';
	} elseif ( is_author() ) {
		$crumbs[] = '<span>' . esc_html( get_the_author() ) . '</span>';
	} elseif ( is_archive() ) {
		$crumbs[] = '<span>' . esc_html( get_the_archive_title() ) . '</span>';
	} elseif ( is_search() ) {
		$crumbs[] = '<span>' . esc_html__( 'Search Results', 'nexa-agency' ) . '</span>';
	} elseif ( is_404() ) {
		$crumbs[] = '<span>' . esc_html__( '404 Not Found', 'nexa-agency' ) . '</span>';
	}

	echo '<nav class="nexa-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'nexa-agency' ) . '">';
	echo implode( $separator, $crumbs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- all parts already escaped
	echo '</nav>';
}

/**
 * Output formatted post meta (date, author, categories, comments).
 *
 * @return void
 */
function nexa_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: Post date */
		esc_html_x( 'Posted on %s', 'post date', 'nexa-agency' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Output formatted post author link.
 *
 * @return void
 */
function nexa_posted_by() {
	$byline = sprintf(
		/* translators: %s: Post author link */
		esc_html_x( 'by %s', 'post author', 'nexa-agency' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline">' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display the post thumbnail safely with a link.
 *
 * @param string $size Image size slug.
 * @return void
 */
function nexa_post_thumbnail( $size = 'nexa-card' ) {
	if ( ! has_post_thumbnail() || is_attachment() || ! is_singular() ) {
		return;
	}
	echo '<div class="nexa-post-thumbnail">';
	the_post_thumbnail( $size, array( 'alt' => get_the_title() ) );
	echo '</div>';
}

/**
 * Check if the current page uses the Home Page template.
 *
 * @return bool
 */
function nexa_is_home_template() {
	return is_page_template( 'page-templates/page-home.php' )
		|| ( is_front_page() && is_page() );
}
