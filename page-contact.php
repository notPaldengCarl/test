<?php
/**
 * Template Name: Contact Page
 *
 * Swiss-minimalist contact page with border-list info and clean form.
 *
 * @package VØID_ROASTERS
 * @since   3.0.0
 */

get_header();
?>

<!-- Contact Hero -->
<section class="hero" aria-label="<?php esc_attr_e( 'Contact', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '01 REACH OUT', 'void-roasters' ); ?></span>
		<h1><?php esc_html_e( 'Contact', 'void-roasters' ); ?></h1>
	</div>
</section>

<hr class="section-divider">

<!-- Contact Layout -->
<section aria-label="<?php esc_attr_e( 'Contact Form', 'void-roasters' ); ?>">
	<div class="container">
		<div class="contact-layout">

			<!-- Left: Contact Info -->
			<div>
				<ul class="border-list">
					<li>
						<span class="border-list__title"><?php esc_html_e( 'Email', 'void-roasters' ); ?></span>
						<span class="border-list__desc"><a href="mailto:hello@voidroasters.com">hello@voidroasters.com</a></span>
					</li>
					<li>
						<span class="border-list__title"><?php esc_html_e( 'Location', 'void-roasters' ); ?></span>
						<span class="border-list__desc"><?php esc_html_e( 'By Appointment Only', 'void-roasters' ); ?></span>
					</li>
					<li>
						<span class="border-list__title"><?php esc_html_e( 'Wholesale', 'void-roasters' ); ?></span>
						<span class="border-list__desc"><a href="mailto:wholesale@voidroasters.com">wholesale@voidroasters.com</a></span>
					</li>
					<li>
						<span class="border-list__title"><?php esc_html_e( 'Social', 'void-roasters' ); ?></span>
						<span class="border-list__desc">@voidroasters</span>
					</li>
				</ul>
			</div>

			<!-- Right: Form -->
			<div>
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
					<button type="submit" class="form-submit"><?php esc_html_e( 'Send Message', 'void-roasters' ); ?></button>
				</form>
			</div>

		</div><!-- .contact-layout -->
	</div>
</section>

<?php get_footer(); ?>