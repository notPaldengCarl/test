<?php
/**
 * Template Name: About Page
 *
 * Swiss-minimalist editorial about page.
 *
 * @package VØID_ROASTERS
 * @since   3.0.0
 */

get_header();
?>

<!-- About Hero -->
<section class="hero" aria-label="<?php esc_attr_e( 'About', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '01 ABOUT', 'void-roasters' ); ?></span>
		<p class="about-hero__text"><?php esc_html_e( 'A dedicated team helping you grow through exceptional coffee.', 'void-roasters' ); ?></p>
	</div>
</section>

<hr class="section-divider">

<!-- Vision & Mission -->
<section class="section--alt" aria-label="<?php esc_attr_e( 'Vision and Mission', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '02 DIRECTION', 'void-roasters' ); ?></span>
		<div class="cards-2col">
			<div class="minimal-card">
				<span class="minimal-card__label"><?php esc_html_e( 'Vision', 'void-roasters' ); ?></span>
				<h3 class="minimal-card__title"><?php esc_html_e( 'A World That Drinks Better', 'void-roasters' ); ?></h3>
				<p class="minimal-card__text"><?php esc_html_e( 'We envision a future where every cup of coffee is traceable, sustainable, and roasted to highlight the unique terroir of its origin. No shortcuts, no compromise.', 'void-roasters' ); ?></p>
			</div>
			<div class="minimal-card">
				<span class="minimal-card__label"><?php esc_html_e( 'Mission', 'void-roasters' ); ?></span>
				<h3 class="minimal-card__title"><?php esc_html_e( 'Precision at Every Step', 'void-roasters' ); ?></h3>
				<p class="minimal-card__text"><?php esc_html_e( 'From direct trade sourcing to micro-batch roasting, we control every variable in the supply chain. Our mission is to deliver consistency and quality at scale.', 'void-roasters' ); ?></p>
			</div>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- The Story -->
<section aria-label="<?php esc_attr_e( 'Our Story', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '03 THE STORY', 'void-roasters' ); ?></span>
		<div class="wide-text">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</section>

<hr class="section-divider">

<!-- The Team -->
<section class="section--alt" aria-label="<?php esc_attr_e( 'The Team', 'void-roasters' ); ?>">
	<div class="container">
		<span class="section-label"><?php esc_html_e( '05 FOUNDING TEAM', 'void-roasters' ); ?></span>
		<h2 style="margin-bottom:var(--space-2xl);"><?php esc_html_e( 'The people behind the roast.', 'void-roasters' ); ?></h2>
		<ul class="border-list">
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Head Roaster', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Former Q-grader with 12 years of experience across three continents. Oversees all roast profiles and quality control.', 'void-roasters' ); ?></span>
			</li>
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Director of Ops', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'Logistics and supply chain specialist. Manages direct trade relationships and ensures every lot meets our sourcing standards.', 'void-roasters' ); ?></span>
			</li>
			<li>
				<span class="border-list__title"><?php esc_html_e( 'Lead Barista', 'void-roasters' ); ?></span>
				<span class="border-list__desc"><?php esc_html_e( 'National latte art champion. Leads our training programs and develops brewing protocols for wholesale partners.', 'void-roasters' ); ?></span>
			</li>
		</ul>
	</div>
</section>

<?php get_footer(); ?>