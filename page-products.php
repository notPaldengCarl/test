<?php
/**
 * Template Name: Products Page
 *
 * Swiss-minimalist products grid with WP_Query or hardcoded fallback.
 *
 * @package VØID_ROASTERS
 * @since   3.0.0
 */

get_header();
?>

<!-- Products Hero -->
<section class="hero" aria-label="<?php esc_attr_e( 'Products', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '01 OUR ROASTS', 'void-roasters' ); ?></span>
		<h1><?php esc_html_e( 'Shop Coffee', 'void-roasters' ); ?></h1>
	</div>
</section>

<hr class="section-divider">

<!-- Product Grid -->
<section aria-label="<?php esc_attr_e( 'Product Listing', 'void-roasters' ); ?>">
	<div class="container">

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
					?>
					<article class="product-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="product-card__img">
								<?php the_post_thumbnail( 'post-thumbnail', array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
							</div>
						<?php else : ?>
							<div class="product-card__img">
								<span class="product-card__img-label"><?php echo esc_html( substr( get_the_title(), 0, 1 ) ); ?></span>
							</div>
						<?php endif; ?>
						<div class="product-card__body">
							<h3 class="product-card__name"><?php echo esc_html( get_the_title() ); ?></h3>
							<p class="product-card__price">$18.00</p>
						</div>
						<div class="product-card__footer">
							<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<!-- Hardcoded Fallback -->
			<div class="product-grid">
				<article class="product-card">
					<div class="product-card__img"><span class="product-card__img-label">E</span></div>
					<div class="product-card__body">
						<h3 class="product-card__name"><?php esc_html_e( 'Eclipse Dark Roast', 'void-roasters' ); ?></h3>
						<p class="product-card__price">$18.00</p>
					</div>
					<div class="product-card__footer">
						<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</article>
				<article class="product-card">
					<div class="product-card__img"><span class="product-card__img-label">M</span></div>
					<div class="product-card__body">
						<h3 class="product-card__name"><?php esc_html_e( 'Ceremonial Mizu Matcha', 'void-roasters' ); ?></h3>
						<p class="product-card__price">$24.00</p>
					</div>
					<div class="product-card__footer">
						<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</article>
				<article class="product-card">
					<div class="product-card__img"><span class="product-card__img-label">H</span></div>
					<div class="product-card__body">
						<h3 class="product-card__name"><?php esc_html_e( 'Highland Pour-Over', 'void-roasters' ); ?></h3>
						<p class="product-card__price">$21.00</p>
					</div>
					<div class="product-card__footer">
						<button type="button" class="btn btn--primary btn--sm" style="width:100%;"><?php esc_html_e( 'Add to Cart', 'void-roasters' ); ?></button>
					</div>
				</article>
			</div>
		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>