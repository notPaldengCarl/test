<?php
/**
 * The front page template.
 *
 * A fully hardcoded, premium brutalist layout.
 * No database dependency — guaranteed visual output.
 *
 * @package VØID_ROASTERS
 * @since   2.0.0
 */

get_header();
?>

<div class="site-wrapper">

	<?php
	/**
	 * Hero Section — 2-column asymmetric grid.
	 * Left: massive typographic headline + CTA.
	 * Right: image placeholder for balance.
	 */
	?>
	<section class="hero" aria-label="<?php esc_attr_e( 'Welcome', 'void-roasters' ); ?>">
		<div class="hero-grid">
			<div class="hero-text">
				<h1 class="hero__title">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</h1>
				<p class="hero__tagline">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</p>
				<div class="hero__cta">
					<?php
					$about_page = get_page_by_title( 'About' );
					$cta_url    = $about_page ? get_permalink( $about_page->ID ) : home_url( '/' );
					?>
					<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--inverse">
						<?php esc_html_e( 'Our Story', 'void-roasters' ); ?>
					</a>
				</div>
			</div><!-- .hero-text -->
			<div class="hero-image-placeholder" aria-hidden="true">
				<span class="hero-image-placeholder__label">VØID</span>
			</div><!-- .hero-image-placeholder -->
		</div><!-- .hero-grid -->
	</section><!-- .hero -->

	<?php
	/**
	 * Curated Origins — Hardcoded product grid.
	 * 3 product cards with image, name, price, and CTA.
	 */
	?>
	<section class="curated-origins" aria-label="<?php esc_attr_e( 'Curated Origins', 'void-roasters' ); ?>">
		<header class="section-header">
			<h2 class="section-title"><?php esc_html_e( 'Curated Origins', 'void-roasters' ); ?></h2>
		</header>

		<div class="product-grid">

			<article class="product-card">
				<div class="card-img" aria-hidden="true">
					<span class="card-img__label">001</span>
				</div>
				<div class="card-body">
					<h3 class="card-name"><?php esc_html_e( 'Eclipse Blend', 'void-roasters' ); ?></h3>
					<p class="card-description"><?php esc_html_e( 'Bitter chocolate, charred oak, and molasses. Dark roast from Sumatra.', 'void-roasters' ); ?></p>
					<div class="card-footer">
						<span class="card-price">$18.00</span>
						<button type="button" class="btn btn--primary btn--sm"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</div>
			</article>

			<article class="product-card">
				<div class="card-img" aria-hidden="true">
					<span class="card-img__label">002</span>
				</div>
				<div class="card-body">
					<h3 class="card-name"><?php esc_html_e( 'Mizu Matcha', 'void-roasters' ); ?></h3>
					<p class="card-description"><?php esc_html_e( 'Ceremonial grade from Uji, Kyoto. Umami-rich, vivid jade, sweet grass.', 'void-roasters' ); ?></p>
					<div class="card-footer">
						<span class="card-price">$24.00</span>
						<button type="button" class="btn btn--primary btn--sm"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</div>
			</article>

			<article class="product-card">
				<div class="card-img" aria-hidden="true">
					<span class="card-img__label">003</span>
				</div>
				<div class="card-body">
					<h3 class="card-name"><?php esc_html_e( 'Highland', 'void-roasters' ); ?></h3>
					<p class="card-description"><?php esc_html_e( 'Citrus acidity, jasmine florals, honeyed finish. Natural process Ethiopian.', 'void-roasters' ); ?></p>
					<div class="card-footer">
						<span class="card-price">$21.00</span>
						<button type="button" class="btn btn--primary btn--sm"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</div>
			</article>

		</div><!-- .product-grid -->
	</section><!-- .curated-origins -->

	<?php
	/**
	 * CTA Banner — Visit the roastery.
	 */
	?>
	<section class="cta-banner" aria-label="<?php esc_attr_e( 'Get in Touch', 'void-roasters' ); ?>">
		<h2 class="cta-banner__title">
			<?php esc_html_e( 'Visit the Roastery', 'void-roasters' ); ?>
		</h2>
		<p class="cta-banner__text">
			<?php esc_html_e( 'Small-batch roasts, ceremonial matcha, and brutalist vibes. Open by appointment.', 'void-roasters' ); ?>
		</p>
		<?php
		$contact_page = get_page_by_title( 'Contact' );
		$cta_contact  = $contact_page ? get_permalink( $contact_page->ID ) : home_url( '/contact/' );
		?>
		<a href="<?php echo esc_url( $cta_contact ); ?>" class="btn btn--inverse">
			<?php esc_html_e( 'Book a Visit', 'void-roasters' ); ?>
		</a>
	</section><!-- .cta-banner -->

</div><!-- .site-wrapper -->

<?php
get_footer();