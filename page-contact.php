<?php
/**
 * Template Name: Contact Page
 *
 * A brutalist contact page with a 2-column layout:
 * contact info on the left, functional form on the right.
 *
 * @package VØID_ROASTERS
 * @since   1.5.0
 */

get_header();
?>

<div class="site-container">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<header class="page-header">
			<h1 class="page-title">
				<?php echo esc_html( get_the_title() ); ?>
			</h1>
		</header>

		<div class="contact-layout">

			<div class="contact-info">

				<div class="contact-info__item">
					<div class="contact-info__label"><?php esc_html_e( 'Email', 'void-roasters' ); ?></div>
					<div class="contact-info__value">
						<a href="mailto:hello@voidroasters.com">hello@voidroasters.com</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__label"><?php esc_html_e( 'Wholesale', 'void-roasters' ); ?></div>
					<div class="contact-info__value">
						<a href="mailto:wholesale@voidroasters.com">wholesale@voidroasters.com</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__label"><?php esc_html_e( 'Location', 'void-roasters' ); ?></div>
					<div class="contact-info__value">
						<?php esc_html_e( 'By Appointment Only', 'void-roasters' ); ?>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__label"><?php esc_html_e( 'Social', 'void-roasters' ); ?></div>
					<div class="contact-info__value">@voidroasters</div>
				</div>

			</div><!-- .contact-info -->

			<div class="contact-form-wrap">
				<form class="contact-form" action="#" method="post">
					<div class="form-group">
						<label class="form-label" for="contact-name"><?php esc_html_e( 'Name', 'void-roasters' ); ?></label>
						<input class="form-input" type="text" id="contact-name" name="name" placeholder="<?php esc_attr_e( 'Your name', 'void-roasters' ); ?>" required>
					</div>
					<div class="form-group">
						<label class="form-label" for="contact-email"><?php esc_html_e( 'Email', 'void-roasters' ); ?></label>
						<input class="form-input" type="email" id="contact-email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'void-roasters' ); ?>" required>
					</div>
					<div class="form-group">
						<label class="form-label" for="contact-subject"><?php esc_html_e( 'Subject', 'void-roasters' ); ?></label>
						<input class="form-input" type="text" id="contact-subject" name="subject" placeholder="<?php esc_attr_e( 'Wholesale / General / Collaboration', 'void-roasters' ); ?>">
					</div>
					<div class="form-group">
						<label class="form-label" for="contact-message"><?php esc_html_e( 'Message', 'void-roasters' ); ?></label>
						<textarea class="form-textarea" id="contact-message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Tell us what you need...', 'void-roasters' ); ?>" required></textarea>
					</div>
					<button type="submit" class="form-submit">
						<?php esc_html_e( 'Send Message', 'void-roasters' ); ?>
					</button>
				</form>
			</div><!-- .contact-form-wrap -->

		</div><!-- .contact-layout -->

	<?php endwhile; ?>

</div><!-- .site-container -->

<?php
get_footer();