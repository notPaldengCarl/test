<?php
/**
 * The footer template for VØID ROASTERS theme.
 *
 * A massive, architectural brutalist footer with:
 * - 4-column grid (newsletter, nav, socials, address)
 * - Full-width "VØID" massive text
 * - Copyright bar
 *
 * @package VØID_ROASTERS
 * @since   2.0.0
 */
?>
</main><!-- #primary .site-main -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<!-- Top Footer: 4-Column Grid -->
	<div class="container">
		<div class="footer-grid">

			<!-- Column 1: Newsletter -->
			<div class="footer-col">
				<h3 class="footer-col__title"><?php esc_html_e( 'Newsletter', 'void-roasters' ); ?></h3>
				<p class="footer-col__desc"><?php esc_html_e( 'New roasts, matcha drops, and dispatches from the roastery.', 'void-roasters' ); ?></p>
				<form class="newsletter-form" action="#" method="post">
					<input type="email" class="newsletter-input" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'void-roasters' ); ?>" required>
					<button type="submit" class="newsletter-btn"><?php esc_html_e( 'Subscribe', 'void-roasters' ); ?></button>
				</form>
			</div>

			<!-- Column 2: Footer Navigation -->
			<div class="footer-col">
				<h3 class="footer-col__title"><?php esc_html_e( 'Navigate', 'void-roasters' ); ?></h3>
			<?php if ( has_nav_menu( 'footer-nav' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-nav',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			<?php else : ?>
				<ul class="footer-menu">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'void-roasters' ); ?></a></li>
					<?php
					$about_page = get_page_by_title( 'About' );
					if ( $about_page ) {
						echo '<li><a href="' . esc_url( get_permalink( $about_page->ID ) ) . '">' . esc_html__( 'About', 'void-roasters' ) . '</a></li>';
					}
					$products_page = get_page_by_title( 'Products' );
					if ( $products_page ) {
						echo '<li><a href="' . esc_url( get_permalink( $products_page->ID ) ) . '">' . esc_html__( 'Shop', 'void-roasters' ) . '</a></li>';
					}
					?>
					<li><a href="#"><?php esc_html_e( 'Wholesale', 'void-roasters' ); ?></a></li>
				</ul>
			<?php endif; ?>
			</div>

			<!-- Column 3: Social Links -->
			<div class="footer-col">
				<h3 class="footer-col__title"><?php esc_html_e( 'Socials', 'void-roasters' ); ?></h3>
				<?php if ( has_nav_menu( 'footer-social' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-social',
							'container'      => false,
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<ul class="footer-menu">
						<li><a href="#">Instagram</a></li>
						<li><a href="#">Twitter / X</a></li>
						<li><a href="#">TikTok</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 4: Contact Info -->
			<div class="footer-col">
				<h3 class="footer-col__title"><?php esc_html_e( 'Contact', 'void-roasters' ); ?></h3>
				<address class="footer-address">
					<p><?php esc_html_e( 'By Appointment Only', 'void-roasters' ); ?></p>
					<p><a href="mailto:hello@voidroasters.com">hello@voidroasters.com</a></p>
				</address>
			</div>

		</div><!-- .footer-grid -->
	</div>

	<!-- Middle Footer: Massive VØID Text -->
	<div class="footer-massive-text" aria-hidden="true">
		<h2 class="footer-void-text">VØID</h2>
	</div>

	<!-- Bottom Footer: Copyright -->
	<div class="container">
		<div class="footer-copyright">
			<div class="footer-copyright__left">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'void-roasters' ); ?>
			</div>
			<div class="footer-copyright__right">
				<a href="#"><?php esc_html_e( 'Terms', 'void-roasters' ); ?></a>
				<span aria-hidden="true">&middot;</span>
				<a href="#"><?php esc_html_e( 'Privacy', 'void-roasters' ); ?></a>
			</div>
		</div><!-- .footer-copyright -->
	</div>

</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>