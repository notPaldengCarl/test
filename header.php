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
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="site-logo__image" src="<?php echo esc_url( VOID_URI . '/void-roasters.png' ); ?>" alt="<?php esc_attr_e( 'VØID ROASTERS', 'void-roasters' ); ?>">
					<span class="site-logo__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				</a>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<div class="site-header__actions">
		<nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'void-roasters' ); ?>">
				<ul class="primary-menu">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'void-roasters' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'void-roasters' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'Products', 'void-roasters' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'void-roasters' ); ?></a></li>
				</ul>
			</nav><!-- .primary-navigation -->
			<button type="button" class="cart-toggle" data-cart-toggle aria-controls="cart-drawer" aria-expanded="false">
				<span class="cart-toggle__label"><?php esc_html_e( 'Cart', 'void-roasters' ); ?></span>
				<span class="cart-badge" data-cart-count>0</span>
			</button>
		</div>

	</div><!-- .container -->
</header><!-- .site-header -->

<div class="cart-overlay" data-cart-overlay></div>

<aside id="cart-drawer" class="cart-drawer" data-cart-drawer aria-hidden="true" aria-label="<?php esc_attr_e( 'Shopping cart', 'void-roasters' ); ?>">
	<div class="cart-drawer__header">
		<h2 class="cart-drawer__title"><?php esc_html_e( 'Your Cart', 'void-roasters' ); ?></h2>
		<button type="button" class="cart-drawer__close" data-cart-close aria-label="<?php esc_attr_e( 'Close cart', 'void-roasters' ); ?>">
			&times;
		</button>
	</div>
	<div class="cart-drawer__body">
		<p class="cart-empty" data-cart-empty><?php esc_html_e( 'Your cart is empty.', 'void-roasters' ); ?></p>
		<ul class="cart-list" data-cart-list></ul>
	</div>
	<div class="cart-drawer__footer">
		<div class="cart-total">
			<span><?php esc_html_e( 'Subtotal', 'void-roasters' ); ?></span>
			<strong data-cart-total>$0.00</strong>
		</div>
		<button type="button" class="btn btn--primary btn--block cart-checkout" disabled><?php esc_html_e( 'Checkout', 'void-roasters' ); ?></button>
	</div>
</aside>

<main id="primary" class="site-main" role="main">
