<?php
/**
 * Template part: Default post content.
 *
 * Displays a post card in archive/listing views.
 *
 * @package VØID_ROASTERS
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-card__media">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'post-card__thumbnail' ) ); ?>
			</a>
		</div><!-- .post-card__media -->
	<?php endif; ?>

	<div class="post-card__content">

		<header class="post-card__header">
			<h2 class="post-card__title">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php echo esc_html( get_the_title() ); ?>
				</a>
			</h2>
		</header><!-- .post-card__header -->

		<div class="post-card__excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .post-card__excerpt -->

		<footer class="post-card__meta">
			<time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<span class="post-card__separator" aria-hidden="true">&middot;</span>
			<span class="post-card__reading-time">
				<?php
				$content     = get_the_content();
				$word_count  = str_word_count( wp_strip_all_tags( $content ) );
				$read_time   = max( 1, (int) ceil( $word_count / 250 ) );
				printf(
					/* translators: %d: estimated reading time in minutes */
					esc_html( _n( '%d min read', '%d min read', $read_time, 'void-roasters' ) ),
					(int) $read_time
				);
				?>
			</span>
		</footer><!-- .post-card__meta -->

	</div><!-- .post-card__content -->

</article><!-- .post-card -->