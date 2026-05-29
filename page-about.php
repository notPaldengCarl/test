<?php
/**
 * Template Name: About Page
 *
 * A brutalist about page with CSS-only infinite scrolling marquee
 * and asymmetric split-screen layout.
 *
 * @package VØID_ROASTERS
 * @since   1.5.0
 */

get_header();
?>

<div class="marquee" aria-hidden="true">
	<span>ORIGIN MATTERS. PRECISION MATTERS. DESIGN MATTERS. ORIGIN MATTERS. PRECISION MATTERS. DESIGN MATTERS.&nbsp;</span>
	<span>ORIGIN MATTERS. PRECISION MATTERS. DESIGN MATTERS. ORIGIN MATTERS. PRECISION MATTERS. DESIGN MATTERS.&nbsp;</span>
</div>

<div class="site-container">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<div class="about-layout">

			<aside class="about-sidebar">
				<h2><?php esc_html_e( 'ABOUT', 'void-roasters' ); ?></h2>
			</aside>

			<div class="about-content">
				<?php the_content(); ?>
			</div><!-- .about-content -->

		</div><!-- .about-layout -->

	<?php endwhile; ?>

</div><!-- .site-container -->

<?php
get_footer();