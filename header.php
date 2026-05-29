<?php
/**
 * The header template for VØID ROASTERS theme.
 *
 * Displays the <head> section and site header.
 *
 * @package VØID_ROASTERS
 * @since   1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
	<?php esc_html_e( 'Skip to content', 'void-roasters' ); ?>
</a>

<header id="masthead" class="site-header" role="banner">
	<div class="container">

		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'void-roasters' ); ?>">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'void-roasters' ); ?></a></li>
				<?php $about_page = get_page_by_title( 'About' ); ?>
				<?php if ( $about_page ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $about_page->ID ) ); ?>"><?php esc_html_e( 'About', 'void-roasters' ); ?></a></li>
				<?php endif; ?>
				<?php $products_page = get_page_by_title( 'Products' ); ?>
				<?php if ( $products_page ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $products_page->ID ) ); ?>"><?php esc_html_e( 'Products', 'void-roasters' ); ?></a></li>
				<?php endif; ?>
				<?php $contact_page = get_page_by_title( 'Contact' ); ?>
				<?php if ( $contact_page ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $contact_page->ID ) ); ?>"><?php esc_html_e( 'Contact', 'void-roasters' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</nav><!-- .primary-navigation -->

	</div><!-- .container -->
</header><!-- .site-header -->

<main id="primary" class="site-main" role="main">
