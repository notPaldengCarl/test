<?php
/**
 * The front page template.
 *
 * Displays a brutalist hero section, curated roasts grid,
 * a CTA banner, and navigation to other pages.
 *
 * @package VØID_ROASTERS
 * @since   1.1.0
 */

get_header();
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Welcome', 'void-roasters' ); ?>">
	<div class="site-container grid-12">
		<div class="hero__content col-span-8 col-start-1">
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
		</div>
	</div>
</section>

<hr class="section-divider" aria-hidden="true">

<section class="roasts-section" aria-label="<?php esc_attr_e( 'Curated Single-Origin Roasts', 'void-roasters' ); ?>">
	<div class="site-container">
		<h2 class="roasts-section__title">
			<?php esc_html_e( 'Curated Origins', 'void-roasters' ); ?>
		</h2>

		<?php
		$void_roasts_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_status'    => 'publish',
			)
		);

		if ( $void_roasts_query->have_posts() ) :
			?>
			<div class="product-grid">
				<?php
				while ( $void_roasts_query->have_posts() ) :
					$void_roasts_query->the_post();
					get_template_part( 'template-parts/content', 'roast' );
				endwhile;
				?>
			</div>
			<?php
			wp_reset_postdata();
		else :
			?>
			<div class="product-grid">
				<article class="product-card">
					<div class="card-image" aria-hidden="true">
						<span class="card-image__label">001</span>
					</div>
					<div class="card-body">
						<div class="card-meta">SINGLE ESTATE &sol;&sol; SUMATRA</div>
						<h3 class="card-title">Eclipse Dark Roast</h3>
						<p class="card-desc">Bitter chocolate, charred oak, and molasses. Roasted deep for those who take it black.</p>
					</div>
				</article>
				<article class="product-card">
					<div class="card-image" aria-hidden="true">
						<span class="card-image__label">002</span>
					</div>
					<div class="card-body">
						<div class="card-meta">FIRST HARVEST &sol;&sol; UJI, KYOTO</div>
						<h3 class="card-title">Ceremonial Mizu Matcha</h3>
						<p class="card-desc">Umami-rich body, vivid jade color, sweet grass and marine mineral. Stone-ground to order.</p>
					</div>
				</article>
				<article class="product-card">
					<div class="card-image" aria-hidden="true">
						<span class="card-image__label">003</span>
					</div>
					<div class="card-body">
						<div class="card-meta">NATURAL PROCESS &sol;&sol; YIRGACHEFFE</div>
						<h3 class="card-title">Highland Pour-Over</h3>
						<p class="card-desc">Citrus acidity, jasmine florals, and a honeyed finish. Brewed low and slow for clarity.</p>
					</div>
				</article>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="cta-banner" aria-label="<?php esc_attr_e( 'Get in Touch', 'void-roasters' ); ?>">
	<div class="site-container">
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
	</div>
</section>

<?php
get_footer();