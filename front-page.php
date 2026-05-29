<?php
/**
 * Front page template — Swiss-minimalist editorial layout.
 *
 * @package VØID_ROASTERS
 * @since   3.0.0
 */

get_header();
?>

<?php
$about_page    = get_page_by_title( 'About' );
$products_page = get_page_by_title( 'Products' );
$contact_page  = get_page_by_title( 'Contact' );
$cta_url       = $about_page ? get_permalink( $about_page->ID ) : home_url( '/' );
$shop_url      = $products_page ? get_permalink( $products_page->ID ) : home_url( '/products/' );
$contact_url   = $contact_page ? get_permalink( $contact_page->ID ) : home_url( '/contact/' );
?>

<!-- Hero -->
<section class="hero hero--brutal" aria-label="<?php esc_attr_e( 'Welcome', 'void-roasters' ); ?>">
	<div class="container hero__grid">
		<div class="hero__content reveal">
			<span class="section-label section-label--accent"><?php esc_html_e( '01 VØID ROASTERS', 'void-roasters' ); ?></span>
			<h1 class="hero__title"><?php esc_html_e( 'Empowering through craft coffee.', 'void-roasters' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'A brutalist micro-roastery and ceremonial matcha bar built for precision, clarity, and relentless flavor.', 'void-roasters' ); ?></p>
			<div class="hero__cta">
				<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Learn More', 'void-roasters' ); ?>
				</a>
				<a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn--outline">
					<?php esc_html_e( 'Shop Roasts', 'void-roasters' ); ?>
				</a>
			</div>
			<div class="hero__meta">
				<div class="hero__meta-item">
					<span class="hero__meta-label"><?php esc_html_e( 'Roasts', 'void-roasters' ); ?></span>
					<span class="hero__meta-value"><?php esc_html_e( 'Small-batch weekly', 'void-roasters' ); ?></span>
				</div>
				<div class="hero__meta-item">
					<span class="hero__meta-label"><?php esc_html_e( 'Matcha', 'void-roasters' ); ?></span>
					<span class="hero__meta-value"><?php esc_html_e( 'Uji ceremonial grade', 'void-roasters' ); ?></span>
				</div>
			</div>
		</div>
		<div class="hero__panel reveal">
			<div class="hero__mark">
				<img src="<?php echo esc_url( VOID_URI . '/void-roasters.png' ); ?>" alt="<?php esc_attr_e( 'VØID ROASTERS', 'void-roasters' ); ?>">
				<p class="hero__mark-text"><?php esc_html_e( 'Brutalist coffee + matcha bar. Zero frameworks. Pure craft.', 'void-roasters' ); ?></p>
			</div>
			<div class="hero__panel-grid">
				<div class="hero__panel-card">
					<span class="hero__panel-label"><?php esc_html_e( 'Wholesale', 'void-roasters' ); ?></span>
					<p><?php esc_html_e( 'Custom roast profiles and training for partner cafes.', 'void-roasters' ); ?></p>
				</div>
				<div class="hero__panel-card">
					<span class="hero__panel-label"><?php esc_html_e( 'Studio', 'void-roasters' ); ?></span>
					<p><?php esc_html_e( 'By-appointment cuppings and design-led collaborations.', 'void-roasters' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- Split Features -->
<section class="section--alt" aria-label="<?php esc_attr_e( 'Features', 'void-roasters' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-label"><?php esc_html_e( '02 SIGNALS', 'void-roasters' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Wholesale and custom roasting built to scale.', 'void-roasters' ); ?></h2>
		</div>
		<div class="features-grid">
			<div class="feature-block reveal">
				<span class="feature-block__index">01</span>
				<h3 class="feature-block__title"><?php esc_html_e( 'Wholesale for SMEs', 'void-roasters' ); ?></h3>
				<p class="feature-block__text"><?php esc_html_e( 'Partner with us to bring specialty coffee to your cafe, restaurant, or office. Custom roast profiles, flexible minimums, and dedicated support.', 'void-roasters' ); ?></p>
			</div>
			<div class="feature-block reveal">
				<span class="feature-block__index">02</span>
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
		<div class="section-header">
			<span class="section-label"><?php esc_html_e( '03 SERVICES', 'void-roasters' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Three core services.', 'void-roasters' ); ?></h2>
		</div>
		<ul class="border-list">
			<li class="reveal">
				<span class="border-list__title"><?php esc_html_e( 'Sourcing', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Direct relationships with farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Every lot is cupped, scored, and selected for its unique terroir.', 'void-roasters' ); ?></span>
			</li>
			<li class="reveal">
				<span class="border-list__title"><?php esc_html_e( 'Roasting', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Micro-batch roasting to precise profiles developed in-house. We roast to highlight origin character, not to mask it.', 'void-roasters' ); ?></span>
			</li>
			<li class="reveal">
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
		<div class="section-header section-header--row">
			<div>
				<span class="section-label"><?php esc_html_e( '04 OUR ROASTS', 'void-roasters' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'Shop Coffee', 'void-roasters' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn--outline btn--sm">
				<?php esc_html_e( 'View All', 'void-roasters' ); ?>
			</a>
		</div>

		<?php
		$products_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_status'    => 'publish',
			)
		);

		if ( $products_query->have_posts() ) :
			?>
			<div class="product-grid">
				<?php
				while ( $products_query->have_posts() ) :
					$products_query->the_post();
					$price = void_get_product_price( get_the_ID() );
					?>
					<article class="product-card reveal">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="product-card__img">
								<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'product-card__thumbnail' ) ); ?>
							</div>
						<?php else : ?>
							<div class="product-card__img">
								<span class="product-card__img-label"><?php echo esc_html( substr( get_the_title(), 0, 1 ) ); ?></span>
							</div>
						<?php endif; ?>
						<div class="product-card__body">
							<h3 class="product-card__name"><?php echo esc_html( get_the_title() ); ?></h3>
							<p class="product-card__price"><?php echo esc_html( void_format_price( $price ) ); ?></p>
						</div>
						<div class="product-card__footer">
							<button
								type="button"
								class="btn btn--primary btn--sm btn--block"
								data-add-to-cart
								data-product-id="<?php echo esc_attr( get_the_ID() ); ?>"
								data-product-name="<?php echo esc_attr( get_the_title() ); ?>"
								data-product-price="<?php echo esc_attr( number_format( $price, 2, '.', '' ) ); ?>"
								data-product-url="<?php echo esc_url( get_permalink() ); ?>"
							>
								<?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?>
							</button>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<?php
			$fallback_products = array(
				array(
					'name'  => 'Eclipse Dark Roast',
					'price' => '18.00',
					'key'   => 'fallback-eclipse',
				),
				array(
					'name'  => 'Ceremonial Mizu Matcha',
					'price' => '24.00',
					'key'   => 'fallback-matcha',
				),
				array(
					'name'  => 'Highland Pour-Over',
					'price' => '21.00',
					'key'   => 'fallback-highland',
				),
			);
			?>
			<div class="product-grid">
				<?php foreach ( $fallback_products as $product ) : ?>
					<article class="product-card reveal">
						<div class="product-card__img"><span class="product-card__img-label"><?php echo esc_html( substr( $product['name'], 0, 1 ) ); ?></span></div>
						<div class="product-card__body">
							<h3 class="product-card__name"><?php echo esc_html( $product['name'] ); ?></h3>
							<p class="product-card__price"><?php echo esc_html( void_format_price( $product['price'] ) ); ?></p>
						</div>
						<div class="product-card__footer">
							<button
								type="button"
								class="btn btn--primary btn--sm btn--block"
								data-add-to-cart
								data-product-id="<?php echo esc_attr( $product['key'] ); ?>"
								data-product-name="<?php echo esc_attr( $product['name'] ); ?>"
								data-product-price="<?php echo esc_attr( $product['price'] ); ?>"
								data-product-url="<?php echo esc_url( $shop_url ); ?>"
							>
								<?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?>
							</button>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<hr class="section-divider">

<!-- Pre-Footer CTA -->
<section class="section--dark" aria-label="<?php esc_attr_e( 'Contact', 'void-roasters' ); ?>">
	<div class="cta-container">
		<div class="cta-container__text">
			<span class="section-label section-label--accent"><?php esc_html_e( '05 CONTACT', 'void-roasters' ); ?></span>
			<h2 class="cta-banner__title"><?php esc_html_e( 'Let us build your next system.', 'void-roasters' ); ?></h2>
			<p class="cta-banner__text"><?php esc_html_e( 'Whether you need a wholesale partner, a custom blend, or a complete coffee program, we are ready.', 'void-roasters' ); ?></p>
		</div>
		<div class="cta-container__action">
			<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Get in Touch', 'void-roasters' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>