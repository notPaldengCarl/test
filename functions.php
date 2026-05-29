<?php
/**
 * VØID ROASTERS Theme Functions
 *
 * @package VØID_ROASTERS
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define theme constants.
 */
define( 'VOID_VERSION', '1.0.0' );
define( 'VOID_DIR', get_template_directory() );
define( 'VOID_URI', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Hooked into `after_setup_theme` action.
 *
 * @return void
 */
function void_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'void-roasters', VOID_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'void-roasters' ),
			'footer'  => esc_html__( 'Footer Navigation', 'void-roasters' ),
		)
	);
}
add_action( 'after_setup_theme', 'void_setup' );

/**
 * Enqueue front-end styles and scripts.
 *
 * Hooked into `wp_enqueue_scripts` action.
 *
 * @return void
 */
function void_enqueue_assets() {
	// Enqueue main stylesheet.
	wp_enqueue_style(
		'void-style',
		get_stylesheet_uri(),
		array(),
		VOID_VERSION
	);

	// Enqueue scroll-reveal motion engine (progressive enhancement).
	wp_enqueue_script(
		'void-motion',
		VOID_URI . '/js/motion.js',
		array(),
		VOID_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'void_enqueue_assets' );

/**
 * Auto-provision the entire business on theme activation.
 *
 * Creates pages (Home, About, Contact), posts (roasts/matcha),
 * navigation menu, static front page config, and permalinks.
 * Runs once — skips if content already exists.
 *
 * Hooked into `after_switch_theme` action.
 *
 * @return void
 */
function void_provision_business() {
	// Bail if already provisioned.
	if ( get_option( 'void_business_provisioned' ) ) {
		return;
	}

	// --- Update Site Identity ---
	update_option( 'blogname', 'VØID ROASTERS' );
	update_option( 'blogdescription', 'Brutalist Coffee & Matcha Bar' );

	// --- Create Pages ---
	$home_id = wp_insert_post(
		array(
			'post_title'   => 'Home',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '',
		)
	);

	$about_id = wp_insert_post(
		array(
			'post_title'   => 'About',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '<h2>Origin Matters. Precision Matters. Design Matters.</h2><p>VØID ROASTERS is a small-batch specialty coffee and matcha bar built on brutalist principles. We source single-origin beans directly from farms in Ethiopia, Colombia, Kenya, Sumatra, and Brazil. Our ceremonial matcha comes from a single estate in Uji, Kyoto.</p><p>Each lot is roasted in micro-batches to a precise profile developed to highlight the unique terroir of its origin. No blends by default. No compromises on quality.</p><h3>Our Philosophy</h3><ul><li>Zero frameworks — just coffee and craft</li><li>Direct trade relationships with farmers</li><li>Roasted to order, never sitting on shelves</li><li>Brutally honest about what is in the cup</li></ul>',
		)
	);

	$contact_id = wp_insert_post(
		array(
			'post_title'   => 'Contact',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '<h2>Get In Touch</h2><p>For wholesale inquiries, collaboration proposals, or just to say hello:</p><p><strong>Email:</strong> hello@voidroasters.com</p><p><strong>Location:</strong> Roastery visits by appointment only.</p><p><strong>Social:</strong> @voidroasters</p><h3>Wholesale</h3><p>We partner with cafes, restaurants, and offices who share our commitment to quality. Minimum order quantities and custom roast profiles available upon request.</p>',
		)
	);

	// --- Create Roast Posts ---
	$posts = array(
		array(
			'post_title'   => 'Eclipse Dark Roast',
			'post_excerpt'  => 'A brooding, full-bodied dark roast with notes of bitter chocolate, charred oak, and molasses. Engineered for those who drink their coffee black and their mornings uncompromised.',
			'post_content' => '<p>ECLIPSE DARK ROAST is sourced from the volcanic highlands of Sumatra and roasted to a deep, mahogany finish. The extended roast time develops a smoky, low-acid profile with a viscous, syrupy body.</p><p><strong>Tasting Notes:</strong> Bitter Chocolate, Charred Oak, Molasses, Black Cherry</p><p><strong>Roast Profile:</strong> Dark</p><p><strong>Origin:</strong> Sumatra, Indonesia</p><p><strong>Altitude:</strong> 1,500 - 1,700 masl</p>',
		),
		array(
			'post_title'   => 'Ceremonial Grade Matcha',
			'post_excerpt'  => 'Stone-ground Uji matcha with an umami-rich body, vivid jade color, and a lingering sweetness. Whisked to order using traditional chasen technique.',
			'post_content' => '<p>Our CEREMONIAL GRADE MATCHA is sourced from a single estate in Uji, Kyoto. First-harvest leaves are shade-grown for 21 days, hand-picked, de-stemmed, and stone-ground to a 5-micron powder.</p><p><strong>Tasting Notes:</strong> Sweet Umami, Fresh Grass, Marine Mineral, Cream</p><p><strong>Grade:</strong> Ceremonial (First Harvest)</p><p><strong>Origin:</strong> Uji, Kyoto, Japan</p><p><strong>Preparation:</strong> 2g whisked at 80C with chasen</p>',
		),
		array(
			'post_title'   => 'Nebula Blend',
			'post_excerpt'  => 'A cosmic collision of Brazilian nuttiness and Kenyan berry intensity. Medium-roasted for a balanced, approachable cup that is greater than the sum of its origins.',
			'post_content' => '<p>NEBULA BLEND is a proprietary 60/40 combination of Brazilian Cerrado and Kenyan Nyeri lots. The Brazilian base provides a creamy, nutty foundation while the Kenyan component adds a bright, berry-forward top note.</p><p><strong>Tasting Notes:</strong> Hazelnut, Dark Berry, Brown Sugar, Toffee</p><p><strong>Roast Profile:</strong> Medium</p><p><strong>Origin:</strong> Brazil (Cerrado) + Kenya (Nyeri)</p><p><strong>Altitude:</strong> 1,200 - 1,800 masl</p>',
		),
	);

	foreach ( $posts as $post_data ) {
		$post_data['post_type']   = 'post';
		$post_data['post_status'] = 'publish';
		wp_insert_post( $post_data );
	}

	// --- Configure Static Front Page ---
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	// --- Set Permalinks ---
	update_option( 'permalink_structure', '/%postname%/' );
	flush_rewrite_rules();

	// --- Create Navigation Menu ---
	$menu_id = wp_create_nav_menu( 'Primary Menu' );
	if ( $menu_id && ! is_wp_error( $menu_id ) ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Home',
				'menu-item-object-id' => $home_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'About',
				'menu-item-object-id' => $about_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Contact',
				'menu-item-object-id' => $contact_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);

		// Assign menu to primary location.
		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary' => $menu_id,
				'footer'  => 0,
			)
		);
	}

	// Assign custom page templates.
	if ( $about_id && ! is_wp_error( $about_id ) ) {
		update_post_meta( $about_id, '_wp_page_template', 'page-about.php' );
	}
	if ( $contact_id && ! is_wp_error( $contact_id ) ) {
		update_post_meta( $contact_id, '_wp_page_template', 'page-contact.php' );
	}

	// Mark as provisioned so it only runs once.
	update_option( 'void_business_provisioned', true );
}
add_action( 'after_switch_theme', 'void_provision_business' );

/**
 * Fallback navigation when no menu is assigned.
 *
 * Outputs a list of published pages as a simple nav.
 *
 * @return void
 */
function void_fallback_nav() {
	$pages = get_pages(
		array(
			'sort_column' => 'menu_order',
			'sort_order'  => 'ASC',
			'number'      => 5,
		)
	);

	if ( empty( $pages ) ) {
		return;
	}

	echo '<ul id="primary-menu" class="menu">';
	foreach ( $pages as $page ) {
		$class = ( is_page( $page ) ) ? ' class="current-menu-item"' : '';
		echo '<li' . $class . '>';
		echo '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( $page->post_title ) . '</a>';
		echo '</li>';
	}
	echo '</ul>';
}
