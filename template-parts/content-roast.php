<?php
/**
 * Template part: Roast card.
 *
 * Displays a single roast post card used on the front page.
 *
 * @package VØID_ROASTERS
 * @since   1.1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'roast-card reveal' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="roast-card__media">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'roast-card__thumbnail' ) ); ?>
			</a>
		</div><!-- .roast-card__media -->
	<?php endif; ?>

	<div class="roast-card__content">

		<header class="roast-card__header">
			<h3 class="roast-card__title">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php echo esc_html( get_the_title() ); ?>
				</a>
			</h3>
		</header><!-- .roast-card__header -->

		<div class="roast-card__excerpt">
			<?php echo wp_kses_post( get_the_excerpt() ); ?>
		</div><!-- .roast-card__excerpt -->

		<footer class="roast-card__meta">
			<time class="roast-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</footer><!-- .roast-card__meta -->

	</div><!-- .roast-card__content -->

</article><!-- .roast-card -->