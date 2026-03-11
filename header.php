<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="nexa-preloader" aria-hidden="true">
	<div class="nexa-preloader__spinner"></div>
</div>

<!-- Site Header -->
<header id="masthead" class="nexa-header" role="banner">
	<div class="nexa-header__inner">

		<!-- Logo / Site Title -->
		<div class="nexa-header__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="nexa-header__logo-text">
						<?php
						$site_name  = get_bloginfo( 'name' );
						$name_parts = explode( ' ', $site_name, 2 );
						echo esc_html( $name_parts[0] );
						if ( isset( $name_parts[1] ) ) {
							echo '<span>' . esc_html( $name_parts[1] ) . '</span>';
						}
						?>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<!-- Primary Navigation -->
		<nav id="site-navigation" class="nexa-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'nexa-agency' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nexa-nav__menu',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<!-- Header CTA -->
		<div class="nexa-header__cta">
			<a href="#contact" class="nexa-btn nexa-btn--primary nexa-btn--sm">
				<?php esc_html_e( 'Get In Touch', 'nexa-agency' ); ?>
			</a>
		</div>

		<!-- Hamburger Button -->
		<button
			class="nexa-hamburger"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'nexa-agency' ); ?>"
			aria-expanded="false"
			aria-controls="mobile-navigation"
		>
			<span class="nexa-hamburger__line"></span>
			<span class="nexa-hamburger__line"></span>
			<span class="nexa-hamburger__line"></span>
		</button>

	</div><!-- .nexa-header__inner -->
</header><!-- #masthead -->

<!-- Mobile Navigation -->
<nav
	id="mobile-navigation"
	class="nexa-mobile-nav"
	role="navigation"
	aria-label="<?php esc_attr_e( 'Mobile Navigation', 'nexa-agency' ); ?>"
>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_id'        => 'mobile-menu',
			'menu_class'     => 'nexa-mobile-nav__menu',
			'container'      => false,
			'fallback_cb'    => false,
		)
	);
	?>
	<div class="nexa-mobile-nav__cta">
		<a href="#contact" class="nexa-btn nexa-btn--primary" style="width:100%;justify-content:center;">
			<?php esc_html_e( 'Get In Touch', 'nexa-agency' ); ?>
		</a>
	</div>
</nav><!-- #mobile-navigation -->
