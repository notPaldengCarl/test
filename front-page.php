<?php
/**
 * Front page template — Swiss-minimalist editorial layout.
 *
 * @package VØID_ROASTERS
 * @since   3.0.0
 */

get_header();
?>

<!-- Hero -->
<section class="hero" aria-label="<?php esc_attr_e( 'Welcome', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( 'VØID ROASTERS', 'void-roasters' ); ?></span>
		<h1 class="hero__title"><?php esc_html_e( 'Empowering through craft coffee.', 'void-roasters' ); ?></h1>
		<div class="hero__cta">
			<?php
			$about_page = get_page_by_title( 'About' );
			$cta_url    = $about_page ? get_permalink( $about_page->ID ) : home_url( '/' );
			?>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Learn More', 'void-roasters' ); ?>
			</a>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- Split Features -->
<section class="section--alt" aria-label="<?php esc_attr_e( 'Features', 'void-roasters' ); ?>">
	<div class="container">
		<div class="features-grid">
			<div class="feature-block">
				<span class="section-label"><?php esc_html_e( '01 Wholesale', 'void-roasters' ); ?></span>
				<h3 class="feature-block__title"><?php esc_html_e( 'Wholesale for SMEs', 'void-roasters' ); ?></h3>
				<p class="feature-block__text"><?php esc_html_e( 'Partner with us to bring specialty coffee to your cafe, restaurant, or office. Custom roast profiles, flexible minimums, and dedicated support.', 'void-roasters' ); ?></p>
			</div>
			<div class="feature-block">
				<span class="section-label"><?php esc_html_e( '02 Custom', 'void-roasters' ); ?></span>
				<h3 class="feature-block__title"><?php esc_html_e( 'Custom Roasting', 'void-roasters' ); ?></h3>
				<p class="feature-block__text"><?php esc_html_e( 'Work directly with our head roaster to develop a signature blend or single-origin profile tailored to your brand and taste preferences.', 'void-roasters' ); ?></p>
			</div>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- Services List -->
<section aria-label="<?php esc_attr_e( 'Services', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '03 Services', 'void-roasters' ); ?></span>
		<h2><?php esc_html_e( 'Three core services.', 'void-roasters' ); ?></h2>
		<ul class="border-list">
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Sourcing', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Direct relationships with farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Every lot is cupped, scored, and selected for its unique terroir.', 'void-roasters' ); ?></span>
			</li>
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Roasting', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Micro-batch roasting to precise profiles developed in-house. We roast to highlight origin character, not to mask it.', 'void-roasters' ); ?></span>
			</li>
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Training', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Barista training, brewing workshops, and equipment consultation for wholesale partners and home enthusiasts alike.', 'void-roasters' ); ?></span>
			</li>
		</ul>
	</div>
</section>

<hr class="section-divider">

<!-- Products Preview -->
<section aria-label="<?php esc_attr_e( 'Our Roasts', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '04 OUR ROASTS', 'void-roasters' ); ?></span>
		<h2 style="margin-bottom:var(--space-2xl);"><?php esc_html_e( 'Shop Coffee', 'void-roasters' ); ?></h2>
		<div class="product-grid">
			<article class="product-card">
				<div class="product-card__img"><span class="product-card__img-label">E</span></div>
				<div class="product-card__body">
					<h3 class="product-card__name"><?php esc_html_e( 'Eclipse Blend', 'void-roasters' ); ?></h3>
					<p class="product-card__price">$18.00</p>
				</div>
				<div class="product-card__footer">
					<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
				</div>
			</article>
			<article class="product-card">
				<div class="product-card__img"><span class="product-card__img-label">M</span></div>
				<div class="product-card__body">
					<h3 class="product-card__name"><?php esc_html_e( 'Mizu Matcha', 'void-roasters' ); ?></h3>
					<p class="product-card__price">$24.00</p>
				</div>
				<div class="product-card__footer">
					<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
				</div>
			</article>
			<article class="product-card">
				<div class="product-card__img"><span class="product-card__img-label">H</span></div>
				<div class="product-card__body">
					<h3 class="product-card__name"><?php esc_html_e( 'Highland', 'void-roasters' ); ?></h3>
					<p class="product-card__price">$21.00</p>
				</div>
				<div class="product-card__footer">
					<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
				</div>
			</article>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- Pre-Footer CTA -->
<section class="section--dark" aria-label="<?php esc_attr_e( 'Contact', 'void-roasters' ); ?>">
	<div class="container">
		<div class="features-grid">
			<div>
				<h2 class="cta-banner__title"><?php esc_html_e( "Let's build your next system.", 'void-roasters' ); ?></h2>
				<p class="cta-banner__text"><?php esc_html_e( 'Whether you need a wholesale partner, a custom blend, or a complete coffee program, we are ready.', 'void-roasters' ); ?></p>
			</div>
			<div style="display:flex;align-items:center;justify-content:flex-end;">
				<?php
				$contact_page = get_page_by_title( 'Contact' );
				$contact_url  = $contact_page ? get_permalink( $contact_page->ID ) : home_url( '/contact/' );
				?>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Get in Touch', 'void-roasters' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>