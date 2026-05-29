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

<?php
/**
 * Hero Section — Full-viewport brutalist impact.
 */
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
				// Link to About page if it exists, otherwise fall back to first page.
				$about_page = get_page_by_title( 'About' );
				$cta_url    = $about_page ? get_permalink( $about_page->ID ) : home_url( '/' );
				?>
				<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--inverse">
					<?php esc_html_e( 'Our Story', 'void-roasters' ); ?>
				</a>
			</div>
		</div><!-- .hero__content -->

	</div><!-- .site-container .grid-12 -->
</section><!-- .hero -->

<hr class="section-divider" aria-hidden="true">

<?php
/**
 * Roasts Section — 3 most recent posts via custom WP_Query.
 */
?>
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
		<div class="roasts-section__grid">
				<?php
				while ( $void_roasts_query->have_posts() ) :
					$void_roasts_query->the_post();
					get_template_part( 'template-parts/content', 'roast' );
				endwhile;
				?>
			</div><!-- .roasts-section__grid -->
			<?php
			wp_reset_postdata();
		else :
			?>
			<div class="roasts-section__empty">
				<p><?php esc_html_e( 'No roasts available yet. Check back soon.', 'void-roasters' ); ?></p>
			</div>
		<?php endif; ?>

	</div><!-- .site-container -->
</section><!-- .roasts-section -->

<?php
/**
 * CTA Banner — Visit the roastery.
 */
?>
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
</section><!-- .cta-banner -->

<?php
get_footer();