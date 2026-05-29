<?php
/**
 * The footer template for VØID ROASTERS theme.
 *
 * Contains the closing of the site-main div and the site footer.
 *
 * @package VØID_ROASTERS
 * @since   1.0.0
 */
?>
</main><!-- #primary .site-main -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-container">

		<div class="site-footer__brand">
			<span class="logo-void">VØID</span><span class="logo-roasters">ROASTERS</span>
			<p class="site-footer__tagline"><?php esc_html_e( 'Brutalist Coffee & Matcha Bar', 'void-roasters' ); ?></p>
		</div>

		<div class="site-footer__copyright">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'void-roasters' ); ?>
		</div><!-- .site-footer__copyright -->

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'void-roasters' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav><!-- .footer-navigation -->
		<?php endif; ?>

	</div><!-- .site-container -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>