<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme.
 * It is used to display the blog posts page when nothing more
 * specific is found.
 *
 * @package VØID_ROASTERS
 * @since   1.0.0
 */

get_header();
?>

<div class="site-container">

	<?php if ( have_posts() ) : ?>

		<div class="post-archive">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
			<?php endwhile; ?>
		</div><!-- .post-archive -->

		<?php the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( '&laquo; Previous', 'void-roasters' ),
				'next_text' => esc_html__( 'Next &raquo;', 'void-roasters' ),
			)
		); ?>

	<?php else : ?>

		<div class="no-results">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'void-roasters' ); ?></h1>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps a search would help.', 'void-roasters' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div><!-- .no-results -->

	<?php endif; ?>

</div><!-- .site-container -->

<?php
get_footer();