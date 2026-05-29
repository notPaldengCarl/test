<?php
/**
 * The front page template.
 *
 * Displays a brutalist hero section followed by a curated
 * selection of the 3 most recent single-origin roasts.
 *
 * @package VØID_ROASTERS
 * @since   1.1.0
 */

get_header();
?>

<?php
/**
 * Hero Section — Massive typographic impact.
 * Uses the 12-column grid for asymmetric positioning.
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
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn--inverse">
					<?php esc_html_e( 'Explore Roasts', 'void-roasters' ); ?>
				</a>
			</div>
		</div><!-- .hero__content -->

	</div><!-- .site-container .grid-12 -->
</section><!-- .hero -->

<?php
/**
 * Roasts Section — 3 most recent posts via custom WP_Query.
 * Each rendered through the content-roast template part.
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
get_footer();