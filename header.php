<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
		<div class="off-canvas-wrapper">
			<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
			<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="title-bar" data-responsive-toggle="site-navigation">
			<button class="menu-icon" type="button" data-toggle="mobile-menu"></button>
			<?php if ( is_front_page() || is_home() ) : ?>
				<h1 class="title-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Soy empresario <span class="show-for-sr">ECO</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-eco-topbar.svg" alt="ECO" /></a>
				</h1>
			<?php else : ?>
				<div class="title-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Soy empresario <span class="show-for-sr">ECO</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-eco-topbar.svg" alt="ECO" /></a>
				</div>
		<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<ul class="menu">
					<li class="home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Soy empresario <span class="show-for-sr">ECO</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-eco-topbar.svg" alt="ECO" /></a></li>
				</ul>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
	</header><!-- .site-header -->

	<div id="content" class="site-content">
		<?php do_action( 'foundationpress_after_header' );
