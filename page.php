<?php
/**
 * The template for displaying all static pages.
 *
 * Used for static pages like About, Contact, etc.
 * Minimalist layout with ultra-bold page title.
 *
 * @package VØID_ROASTERS
 * @since   1.2.0
 */

get_header();
?>

<div class="site-container">

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>

			<header class="page-header">
				<h1 class="page-title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<?php the_content(); ?>
			</div><!-- .page-content -->

			<?php
			// If comments are open or there are comments, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		</article><!-- .page -->
	<?php endwhile; ?>

</div><!-- .site-container -->

<?php
get_footer();