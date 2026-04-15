<?php
/**
 * Asset loading.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a stable version for a theme asset.
 *
 * @param string $relative_path Relative path inside the theme.
 * @return string
 */
function flamebubbles_asset_version( $relative_path ) {
	$path = get_theme_file_path( $relative_path );

	if ( file_exists( $path ) ) {
		return (string) filemtime( $path );
	}

	return FLAMEBUBBLES_ATELIER_VERSION;
}

/**
 * Enqueue front-end assets.
 */
function flamebubbles_enqueue_assets() {
	wp_enqueue_style( 'flamebubbles-style', get_stylesheet_uri(), array(), flamebubbles_asset_version( 'style.css' ) );
	wp_enqueue_style( 'flamebubbles-main', get_theme_file_uri( 'assets/css/main.css' ), array( 'flamebubbles-style' ), flamebubbles_asset_version( 'assets/css/main.css' ) );
	wp_enqueue_style( 'flamebubbles-responsive', get_theme_file_uri( 'assets/css/responsive.css' ), array( 'flamebubbles-main' ), flamebubbles_asset_version( 'assets/css/responsive.css' ) );
	wp_enqueue_style( 'flamebubbles-woocommerce', get_theme_file_uri( 'assets/css/woocommerce.css' ), array( 'flamebubbles-main' ), flamebubbles_asset_version( 'assets/css/woocommerce.css' ) );

	wp_enqueue_script( 'flamebubbles-main', get_theme_file_uri( 'assets/js/main.js' ), array(), flamebubbles_asset_version( 'assets/js/main.js' ), true );
	wp_enqueue_script( 'flamebubbles-slider', get_theme_file_uri( 'assets/js/slider.js' ), array(), flamebubbles_asset_version( 'assets/js/slider.js' ), true );

	wp_localize_script(
		'flamebubbles-main',
		'flamebubblesTheme',
		array(
			'mobileBreakpoint' => 767,
			'homeUrl'          => esc_url_raw( home_url( '/' ) ),
			'cartUrl'          => esc_url_raw( flamebubbles_get_cart_url() ),
			'shopUrl'          => esc_url_raw( flamebubbles_get_shop_url() ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'flamebubbles_enqueue_assets' );

/**
 * Add a pingback URL when needed.
 */
function flamebubbles_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'flamebubbles_pingback_header' );
