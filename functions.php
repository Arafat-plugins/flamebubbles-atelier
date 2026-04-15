<?php
/**
 * Theme bootstrap.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'FLAMEBUBBLES_ATELIER_VERSION' ) ) {
	$theme = wp_get_theme();
	define( 'FLAMEBUBBLES_ATELIER_VERSION', $theme->get( 'Version' ) ? $theme->get( 'Version' ) : '1.0.0' );
}

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/woocommerce-setup.php';
require get_template_directory() . '/inc/customizer.php';
