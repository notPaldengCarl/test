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
			'primary' => esc_html__( 'Primary Navigation', 'void-roasters' ),
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
}
add_action( 'wp_enqueue_scripts', 'void_enqueue_assets' );