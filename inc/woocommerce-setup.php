<?php
/**
 * WooCommerce support and storefront behavior.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add WooCommerce theme support.
 */
function flamebubbles_add_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 560,
			'single_image_width'    => 860,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'flamebubbles_add_woocommerce_support' );

/**
 * Use custom WooCommerce styling only.
 *
 * @return array
 */
function flamebubbles_disable_default_woocommerce_styles() {
	return array();
}
add_filter( 'woocommerce_enqueue_styles', 'flamebubbles_disable_default_woocommerce_styles' );

/**
 * Remove the default WooCommerce sidebar.
 */
function flamebubbles_remove_woocommerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}
add_action( 'wp', 'flamebubbles_remove_woocommerce_sidebar' );

/**
 * Tune the default single product hooks for the custom layout.
 */
function flamebubbles_customize_single_product_hooks() {
	if ( ! is_product() ) {
		return;
	}

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );
	add_action( 'woocommerce_single_product_summary', 'flamebubbles_single_product_feature_list', 22 );
	add_action( 'woocommerce_single_product_summary', 'flamebubbles_single_product_purchase_meta', 35 );
}
add_action( 'wp', 'flamebubbles_customize_single_product_hooks', 20 );

/**
 * Build short feature bullets for the custom single product layout.
 *
 * @param WC_Product $product Product object.
 * @return array<int, string>
 */
function flamebubbles_get_single_product_feature_items( $product ) {
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return array();
	}

	$feature_items     = array();
	$short_description = (string) $product->get_short_description();
	$clean_description = trim( wp_strip_all_tags( $short_description ) );

	if ( $short_description && preg_match_all( '/<li[^>]*>(.*?)<\/li>/is', $short_description, $matches ) ) {
		foreach ( $matches[1] as $feature_text ) {
			$feature_text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $feature_text ) ) );

			if ( $feature_text ) {
				$feature_items[] = $feature_text;
			}
		}
	}

	if ( empty( $feature_items ) && $clean_description ) {
		$segments = preg_split( '/(?:\r\n|\r|\n)+|(?<=\.)\s+|[|]+/', $clean_description );

		foreach ( (array) $segments as $segment ) {
			$segment = trim( preg_replace( '/\s+/', ' ', (string) $segment ) );

			if ( $segment ) {
				$feature_items[] = $segment;
			}
		}
	}

	return array_values( array_unique( array_filter( $feature_items ) ) );
}

/**
 * Output single product feature bullets after the price.
 *
 * @return void
 */
function flamebubbles_single_product_feature_list() {
	global $product;

	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}

	$feature_items = flamebubbles_get_single_product_feature_items( $product );

	if ( empty( $feature_items ) ) {
		return;
	}
	?>
	<ul class="single-product-view__benefits" aria-label="<?php esc_attr_e( 'Product highlights', 'flamebubbles-atelier' ); ?>">
		<?php foreach ( $feature_items as $feature_item ) : ?>
			<li><?php echo esc_html( $feature_item ); ?></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Output purchase support details below the add to cart form.
 *
 * @return void
 */
function flamebubbles_single_product_purchase_meta() {
	global $product;

	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}

	$support_email = sanitize_email( (string) get_option( 'admin_email' ) );
	$support_url   = $support_email ? 'mailto:' . antispambot( $support_email ) : flamebubbles_get_account_url();
	?>
	<div class="single-product-view__purchase-meta">
		<div class="single-product-view__payments" aria-label="<?php esc_attr_e( 'Accepted payments', 'flamebubbles-atelier' ); ?>">
			<span class="single-product-view__payment-badge single-product-view__payment-badge--ssl"><?php esc_html_e( 'SSL Secure', 'flamebubbles-atelier' ); ?></span>
			<span class="single-product-view__payment-badge">Visa</span>
			<span class="single-product-view__payment-badge single-product-view__payment-badge--mastercard"><?php esc_html_e( 'Mastercard', 'flamebubbles-atelier' ); ?></span>
		</div>

		<a class="single-product-view__question" href="<?php echo esc_url( $support_url ); ?>">
			<?php esc_html_e( 'Ask a question', 'flamebubbles-atelier' ); ?>
		</a>
	</div>
	<?php
}

/**
 * Add quantity decrement button on single product pages.
 *
 * @return void
 */
function flamebubbles_quantity_button_minus() {
	if ( ! is_product() ) {
		return;
	}
	?>
	<button class="quantity__button quantity__button--minus" type="button" aria-label="<?php esc_attr_e( 'Decrease quantity', 'flamebubbles-atelier' ); ?>">-</button>
	<?php
}
add_action( 'woocommerce_before_quantity_input_field', 'flamebubbles_quantity_button_minus' );

/**
 * Add quantity increment button on single product pages.
 *
 * @return void
 */
function flamebubbles_quantity_button_plus() {
	if ( ! is_product() ) {
		return;
	}
	?>
	<button class="quantity__button quantity__button--plus" type="button" aria-label="<?php esc_attr_e( 'Increase quantity', 'flamebubbles-atelier' ); ?>">+</button>
	<?php
}
add_action( 'woocommerce_after_quantity_input_field', 'flamebubbles_quantity_button_plus' );

/**
 * Control the number of products per row.
 *
 * @return int
 */
function flamebubbles_loop_shop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'flamebubbles_loop_shop_columns' );

/**
 * Control products shown per page.
 *
 * @return int
 */
function flamebubbles_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'flamebubbles_products_per_page' );

/**
 * Adjust related product output.
 *
 * @param array $args Existing related product arguments.
 * @return array
 */
function flamebubbles_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'flamebubbles_related_products_args' );

/**
 * Custom sale flash markup.
 *
 * @param string     $html    Existing HTML.
 * @param WP_Post    $post    Post object.
 * @param WC_Product $product Product object.
 * @return string
 */
function flamebubbles_sale_flash( $html, $post, $product ) {
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return $html;
	}

	return '<span class="product-card__badge product-card__badge--sale">' . esc_html__( 'Sale', 'flamebubbles-atelier' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'flamebubbles_sale_flash', 10, 3 );

/**
 * Refresh the header cart count via fragments.
 *
 * @param array $fragments Existing fragments.
 * @return array
 */
function flamebubbles_cart_count_fragment( $fragments ) {
	if ( ! flamebubbles_is_woocommerce_active() || ! WC()->cart ) {
		return $fragments;
	}

	ob_start();
	?>
	<span class="header-actions__count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
	<?php
	$fragments['.header-actions__count'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'flamebubbles_cart_count_fragment' );
