<?php
/**
 * Theme setup helpers.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports and core features.
 */
function flamebubbles_setup_theme() {
	load_theme_textdomain( 'flamebubbles-atelier', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 56, 'width' => 180, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'assets/css/main.css' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'flamebubbles-atelier' ),
			'footer'  => __( 'Footer Menu', 'flamebubbles-atelier' ),
		)
	);

	add_image_size( 'flamebubbles-hero-card', 640, 840, true );
	add_image_size( 'flamebubbles-product-card', 560, 720, true );
	add_image_size( 'flamebubbles-gallery-tall', 720, 920, true );
}
add_action( 'after_setup_theme', 'flamebubbles_setup_theme' );

/**
 * Register widget areas.
 */
function flamebubbles_register_sidebars() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Column One', 'flamebubbles-atelier' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets shown in the first footer column.', 'flamebubbles-atelier' ),
			'before_widget' => '<section class="footer-widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="footer-widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column Two', 'flamebubbles-atelier' ),
			'id'            => 'footer-2',
			'description'   => __( 'Widgets shown in the second footer column.', 'flamebubbles-atelier' ),
			'before_widget' => '<section class="footer-widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="footer-widget__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'flamebubbles_register_sidebars' );

/**
 * Add helpful classes to the body element.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function flamebubbles_body_classes( $classes ) {
	if ( flamebubbles_is_woocommerce_active() ) {
		$classes[] = 'has-woo';
	}

	if ( is_front_page() ) {
		$classes[] = 'is-premium-home';
	}

	return $classes;
}
add_filter( 'body_class', 'flamebubbles_body_classes' );
