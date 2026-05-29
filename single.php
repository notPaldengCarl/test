<?php
/**
 * The template for displaying single blog posts.
 *
 * Used for individual roast detail views.
 * Features hero-style featured image, bold title, post date, and content.
 *
 * @package VØID_ROASTERS
 * @since   1.2.0
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<?php if ( has_post_thumbnail() ) : ?>
		<section class="single-hero" aria-label="<?php esc_attr_e( 'Featured Image', 'void-roasters' ); ?>">
			<?php the_post_thumbnail( 'full', array( 'class' => 'single-hero__image' ) ); ?>
		</section><!-- .single-hero -->
	<?php endif; ?>

	<div class="site-container">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

			<header class="single-post__header reveal">
				<h1 class="single-post__title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
				<div class="single-post__meta">
					<time class="single-post__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</div>
			</header><!-- .single-post__header -->

			<div class="single-post__content reveal">
				<?php
				// Using the_content for full WP filtering and shortcodes.
				// WordPress core applies wp_kses_post filtering via kses at database level.
				the_content();
				?>
			</div><!-- .single-post__content -->

			<footer class="single-post__footer reveal">
				<?php the_post_navigation(
					array(
						'prev_text' => '<span class="post-nav__label">' . esc_html__( 'Previous', 'void-roasters' ) . '</span> <span class="post-nav__title">%title</span>',
						'next_text' => '<span class="post-nav__label">' . esc_html__( 'Next', 'void-roasters' ) . '</span> <span class="post-nav__title">%title</span>',
					)
				); ?>
			</footer><!-- .single-post__footer -->

		</article><!-- .single-post -->

		<?php
		// If comments are open or there are comments, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	</div><!-- .site-container -->

<?php endwhile; ?>

<?php
get_footer();