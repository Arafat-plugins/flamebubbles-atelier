<?php
/**
 * Utility helpers shared across templates.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detect whether WooCommerce is available.
 *
 * @return bool
 */
function flamebubbles_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

/**
 * Return the shop URL with a sensible fallback.
 *
 * @return string
 */
function flamebubbles_get_shop_url() {
	if ( flamebubbles_is_woocommerce_active() ) {
		return wc_get_page_permalink( 'shop' );
	}

	return home_url( '/shop/' );
}

/**
 * Return the cart URL with a sensible fallback.
 *
 * @return string
 */
function flamebubbles_get_cart_url() {
	if ( flamebubbles_is_woocommerce_active() ) {
		return wc_get_cart_url();
	}

	return home_url( '/cart/' );
}

/**
 * Return the My Account URL with a sensible fallback.
 *
 * @return string
 */
function flamebubbles_get_account_url() {
	if ( flamebubbles_is_woocommerce_active() ) {
		return wc_get_page_permalink( 'myaccount' );
	}

	return wp_login_url();
}

/**
 * Theme option defaults used by the Customizer.
 *
 * @return array<string, mixed>
 */
function flamebubbles_get_theme_defaults() {
	return array(
		'home_show_primary_nav'         => true,
		'home_action_one_label'         => __( 'Collections', 'flamebubbles-atelier' ),
		'home_action_one_url'           => home_url( '/#collections' ),
		'home_action_two_label'         => __( 'Bag', 'flamebubbles-atelier' ),
		'home_action_two_url'           => flamebubbles_get_cart_url(),
		'hero_eyebrow'                  => __( 'Create your own edit', 'flamebubbles-atelier' ),
		'hero_title_line_one'           => get_bloginfo( 'name' ),
		'hero_title_line_two'           => __( 'Premium fashion card experience', 'flamebubbles-atelier' ),
		'hero_description'              => __( "Women's clothing, men's panjabi, and hand stitch collections presented through a clean custom-coded storefront that feels premium, modern, and editorial from the first fold.", 'flamebubbles-atelier' ),
		'hero_primary_label'            => __( 'Buy Now', 'flamebubbles-atelier' ),
		'hero_primary_url'              => flamebubbles_get_shop_url(),
		'hero_secondary_label'          => __( 'Discover', 'flamebubbles-atelier' ),
		'hero_secondary_url'            => '',
		'hero_partner_1'                => __( 'Women', 'flamebubbles-atelier' ),
		'hero_partner_2'                => __( 'Panjabi', 'flamebubbles-atelier' ),
		'hero_partner_3'                => __( 'Hand Stitch', 'flamebubbles-atelier' ),
		'hero_partner_4'                => __( 'Premium Edit', 'flamebubbles-atelier' ),
		'hero_proof_1_title'            => __( 'Hand stitch drop', 'flamebubbles-atelier' ),
		'hero_proof_1_text'             => __( 'Fresh arrivals live', 'flamebubbles-atelier' ),
		'hero_proof_2_title'            => __( 'Women edit', 'flamebubbles-atelier' ),
		'hero_proof_2_text'             => __( 'Festive layers curated', 'flamebubbles-atelier' ),
		'hero_proof_3_title'            => __( 'Panjabi restock', 'flamebubbles-atelier' ),
		'hero_proof_3_text'             => __( 'Modern tailoring ready', 'flamebubbles-atelier' ),
		'hero_watermark'                => __( 'FLAME', 'flamebubbles-atelier' ),
		'hero_empty_title'              => __( 'Add WooCommerce products', 'flamebubbles-atelier' ),
		'hero_empty_text'               => __( 'The stacked hero cards will appear automatically from your newest arrivals.', 'flamebubbles-atelier' ),
		'category_board_brand'          => get_bloginfo( 'name' ),
		'category_board_action_1_label' => __( 'Shop', 'flamebubbles-atelier' ),
		'category_board_action_1_url'   => flamebubbles_get_shop_url(),
		'category_board_action_2_label' => __( 'Bag', 'flamebubbles-atelier' ),
		'category_board_action_2_url'   => flamebubbles_get_cart_url(),
		'category_empty_title'          => __( 'Add WooCommerce products', 'flamebubbles-atelier' ),
		'category_empty_text'           => __( 'This black editorial mosaic will fill automatically from your latest product imagery.', 'flamebubbles-atelier' ),
		'fs_eyebrow'                    => __( 'New Arrivals', 'flamebubbles-atelier' ),
		'fs_title'                      => __( 'Shop the Edit', 'flamebubbles-atelier' ),
		'fs_label'                      => __( 'View all', 'flamebubbles-atelier' ),
		'latest_eyebrow'                => __( 'Latest Products', 'flamebubbles-atelier' ),
		'latest_title'                  => __( 'Latest Arrivals', 'flamebubbles-atelier' ),
		'latest_description'            => __( 'Fresh styles added regularly — discover the newest pieces from our collections.', 'flamebubbles-atelier' ),
		'latest_button_label'           => __( 'View Shop', 'flamebubbles-atelier' ),
		'latest_empty_title'            => __( 'Latest products will appear here', 'flamebubbles-atelier' ),
		'latest_empty_text'             => __( 'Publish WooCommerce products and the theme will automatically populate this section.', 'flamebubbles-atelier' ),
		'hand_stitch_eyebrow'           => __( 'Hand Stitch', 'flamebubbles-atelier' ),
		'hand_stitch_title'             => __( 'Featured Hand Stitch Collection', 'flamebubbles-atelier' ),
		'hand_stitch_description'       => __( 'Premium hand-finished pieces crafted for depth, detail, and timeless statement dressing.', 'flamebubbles-atelier' ),
		'hand_stitch_link_label'        => __( 'Explore Hand Stitch', 'flamebubbles-atelier' ),
		'hand_stitch_intro'             => __( 'Handcrafted with care — each piece in this collection is individually hand-finished for lasting quality and timeless style.', 'flamebubbles-atelier' ),
		'hand_stitch_panel_title'       => __( 'About this collection', 'flamebubbles-atelier' ),
		'hand_stitch_panel_1'           => __( 'Each piece is individually hand-finished for a quality that sets it apart.', 'flamebubbles-atelier' ),
		'hand_stitch_panel_2'           => __( 'Traditional techniques meet contemporary design in every item.', 'flamebubbles-atelier' ),
		'hand_stitch_panel_3'           => __( 'Premium materials selected for comfort, durability, and lasting wear.', 'flamebubbles-atelier' ),
		'hand_stitch_empty_title'       => __( 'Feature the hand stitch edit', 'flamebubbles-atelier' ),
		'hand_stitch_empty_text'        => __( 'Mark products as featured or add products to your hand stitch categories to fill this section.', 'flamebubbles-atelier' ),
		'women_eyebrow'                 => __( 'Women', 'flamebubbles-atelier' ),
		'women_title'                   => __( "Women's Collection", 'flamebubbles-atelier' ),
		'women_description'             => __( 'Fluid tailoring, festive layers, and elevated everyday silhouettes curated for modern wardrobes.', 'flamebubbles-atelier' ),
		'women_link_label'              => __( 'Shop Women', 'flamebubbles-atelier' ),
		'women_story_text'              => __( 'From festive layers to everyday essentials — our women\'s collection is curated for the modern wardrobe.', 'flamebubbles-atelier' ),
		'women_story_item_1'            => __( 'Seasonal styles added regularly', 'flamebubbles-atelier' ),
		'women_story_item_2'            => __( 'Available in multiple sizes and colours', 'flamebubbles-atelier' ),
		'women_story_item_3'            => __( 'Easy returns and secure checkout', 'flamebubbles-atelier' ),
		'men_eyebrow'                   => __( 'Men', 'flamebubbles-atelier' ),
		'men_title'                     => __( "Men's Panjabi Edit", 'flamebubbles-atelier' ),
		'men_description'               => __( 'Polished panjabi, layered sets, and occasion-ready essentials with clean tailoring and soft structure.', 'flamebubbles-atelier' ),
		'men_link_label'                => __( 'Shop Men', 'flamebubbles-atelier' ),
		'men_story_text'                => __( 'From polished panjabi sets to everyday tailoring — our men\'s collection is made for confident dressing.', 'flamebubbles-atelier' ),
		'men_story_item_1'              => __( 'New styles added each season', 'flamebubbles-atelier' ),
		'men_story_item_2'              => __( 'Available in a range of sizes', 'flamebubbles-atelier' ),
		'men_story_item_3'              => __( 'Easy returns and secure checkout', 'flamebubbles-atelier' ),
		'why_eyebrow'                   => __( 'Why Choose Us', 'flamebubbles-atelier' ),
		'why_title'                     => __( 'Why Shop With Us', 'flamebubbles-atelier' ),
		'why_description'               => __( 'We blend premium presentation with trusted checkout so shopping feels as good as wearing what you find.', 'flamebubbles-atelier' ),
		'why_card_1_title'              => __( 'Premium Quality', 'flamebubbles-atelier' ),
		'why_card_1_text'               => __( 'Every product is selected for quality, craftsmanship, and lasting style — nothing generic, nothing rushed.', 'flamebubbles-atelier' ),
		'why_card_2_title'              => __( 'Secure Checkout', 'flamebubbles-atelier' ),
		'why_card_2_text'               => __( 'Shop with confidence — secure payment, order tracking, and straightforward returns on every order.', 'flamebubbles-atelier' ),
		'why_card_3_title'              => __( 'Fast Delivery', 'flamebubbles-atelier' ),
		'why_card_3_text'               => __( 'Quick dispatch and reliable delivery so your order arrives when you expect it.', 'flamebubbles-atelier' ),
		'why_card_4_title'              => __( 'Easy on Any Device', 'flamebubbles-atelier' ),
		'why_card_4_text'               => __( 'Browse and buy comfortably on your phone, tablet, or desktop — the experience is smooth everywhere.', 'flamebubbles-atelier' ),
		'testimonials_eyebrow'          => __( 'Testimonials', 'flamebubbles-atelier' ),
		'testimonials_title'            => __( 'What Our Customers Say', 'flamebubbles-atelier' ),
		'testimonials_description'      => __( 'Real words from real shoppers who found their perfect piece.', 'flamebubbles-atelier' ),
		'testimonial_1_quote'           => __( 'The storefront finally feels like our brand: calm, premium, and easy to shop on mobile.', 'flamebubbles-atelier' ),
		'testimonial_1_name'            => __( 'Afsana Rahman', 'flamebubbles-atelier' ),
		'testimonial_1_role'            => __( 'Fashion Retail Founder', 'flamebubbles-atelier' ),
		'testimonial_2_quote'           => __( 'The product cards and collection layouts make even new arrivals look thoughtfully curated.', 'flamebubbles-atelier' ),
		'testimonial_2_name'            => __( 'Nayeem Hasan', 'flamebubbles-atelier' ),
		'testimonial_2_role'            => __( 'Merchandising Lead', 'flamebubbles-atelier' ),
		'testimonial_3_quote'           => __( 'We wanted custom coded, fast, and premium. This structure gives us that without a builder dependency.', 'flamebubbles-atelier' ),
		'testimonial_3_name'            => __( 'Sadia Karim', 'flamebubbles-atelier' ),
		'testimonial_3_role'            => __( 'Creative Director', 'flamebubbles-atelier' ),
		'gallery_eyebrow'               => __( 'Gallery', 'flamebubbles-atelier' ),
		'gallery_title'                 => __( 'Shop the Look', 'flamebubbles-atelier' ),
		'gallery_description'           => __( 'Explore our latest styles and click any image to shop the piece directly.', 'flamebubbles-atelier' ),
		'gallery_button_label'          => __( 'Shop the Feed', 'flamebubbles-atelier' ),
		'gallery_empty_title'           => __( 'Gallery will appear here', 'flamebubbles-atelier' ),
		'gallery_empty_text'            => __( 'Once products with images are published, the visual gallery will populate automatically.', 'flamebubbles-atelier' ),
		'footer_eyebrow'                => __( 'Flamebubbles Atelier', 'flamebubbles-atelier' ),
		'footer_text'                   => __( 'A premium custom WooCommerce storefront for modern fashion edits, hand stitch collections, and polished festive dressing.', 'flamebubbles-atelier' ),
		'footer_primary_label'          => __( 'Shop All Products', 'flamebubbles-atelier' ),
		'footer_primary_url'            => flamebubbles_get_shop_url(),
		'footer_secondary_label'        => __( 'My Account', 'flamebubbles-atelier' ),
		'footer_secondary_url'          => flamebubbles_get_account_url(),
		'footer_nav_heading'            => __( 'Navigate', 'flamebubbles-atelier' ),
		'footer_collections_heading'    => __( 'Collections', 'flamebubbles-atelier' ),
		'footer_notes_heading'          => __( 'Store Notes', 'flamebubbles-atelier' ),
		'footer_widget_fallback'        => __( 'Free delivery on orders over ৳2,000. For help, contact us anytime — we\'re happy to assist.', 'flamebubbles-atelier' ),
		'footer_bottom_text'            => __( 'All rights reserved.', 'flamebubbles-atelier' ),
	);
}

/**
 * Return a theme option with default fallback.
 *
 * @param string $key     Option key.
 * @param mixed  $default Optional hard fallback.
 * @return mixed
 */
function flamebubbles_get_theme_option( $key, $default = null ) {
	$defaults = flamebubbles_get_theme_defaults();

	if ( null === $default && array_key_exists( $key, $defaults ) ) {
		$default = $defaults[ $key ];
	}

	return get_theme_mod( $key, $default );
}

/**
 * Build shared category configs for homepage sections.
 *
 * @return array<string, array<string, mixed>>
 */
function flamebubbles_get_collection_configs() {
	return array(
		'women'       => array(
			'eyebrow'      => flamebubbles_get_theme_option( 'women_eyebrow' ),
			'title'        => flamebubbles_get_theme_option( 'women_title' ),
			'description'  => flamebubbles_get_theme_option( 'women_description' ),
			'category_set' => array( 'women', 'three-piece', 'two-piece', 'kurti', 'gown', 'saree', 'salwar-kameez', 'unstitched-fabric' ),
			'primary_slug' => 'women',
			'link_label'   => flamebubbles_get_theme_option( 'women_link_label' ),
			'story_text'   => flamebubbles_get_theme_option( 'women_story_text' ),
			'story_items'  => array(
				flamebubbles_get_theme_option( 'women_story_item_1' ),
				flamebubbles_get_theme_option( 'women_story_item_2' ),
				flamebubbles_get_theme_option( 'women_story_item_3' ),
			),
		),
		'men'         => array(
			'eyebrow'      => flamebubbles_get_theme_option( 'men_eyebrow' ),
			'title'        => flamebubbles_get_theme_option( 'men_title' ),
			'description'  => flamebubbles_get_theme_option( 'men_description' ),
			'category_set' => array( 'men', 'panjabi', 'punjabi-set', 'shirt', 'pajama', 'waistcoat' ),
			'primary_slug' => 'men',
			'link_label'   => flamebubbles_get_theme_option( 'men_link_label' ),
			'story_text'   => flamebubbles_get_theme_option( 'men_story_text' ),
			'story_items'  => array(
				flamebubbles_get_theme_option( 'men_story_item_1' ),
				flamebubbles_get_theme_option( 'men_story_item_2' ),
				flamebubbles_get_theme_option( 'men_story_item_3' ),
			),
		),
		'hand_stitch' => array(
			'eyebrow'      => flamebubbles_get_theme_option( 'hand_stitch_eyebrow' ),
			'title'        => flamebubbles_get_theme_option( 'hand_stitch_title' ),
			'description'  => flamebubbles_get_theme_option( 'hand_stitch_description' ),
			'category_set' => array( 'hand-stitch-collection', 'hand-stitch-women-dress', 'hand-stitch-panjabi', 'premium-handmade', 'custom-stitch' ),
			'primary_slug' => 'hand-stitch-collection',
			'link_label'   => flamebubbles_get_theme_option( 'hand_stitch_link_label' ),
		),
	);
}

/**
 * Fetch a product category by a list of candidate slugs.
 *
 * @param array $slugs Candidate slugs.
 * @return WP_Term|null
 */
function flamebubbles_get_product_category_by_candidates( $slugs ) {
	foreach ( (array) $slugs as $slug ) {
		$term = get_term_by( 'slug', sanitize_title( (string) $slug ), 'product_cat' );

		if ( $term instanceof WP_Term ) {
			return $term;
		}
	}

	return null;
}

/**
 * Get a taxonomy term link with a safe fallback.
 *
 * @param WP_Term|null $term     Term object.
 * @param string       $fallback Fallback URL.
 * @return string
 */
function flamebubbles_get_safe_term_link( $term, $fallback = '' ) {
	if ( $term instanceof WP_Term ) {
		$link = get_term_link( $term );

		if ( ! is_wp_error( $link ) ) {
			return $link;
		}
	}

	return $fallback ? $fallback : flamebubbles_get_shop_url();
}

/**
 * Build optimized WP_Query arguments for WooCommerce sections.
 *
 * @param array $args Optional overrides.
 * @return array
 */
function flamebubbles_build_product_query_args( $args = array() ) {
	$defaults = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( empty( $args['category_slugs'] ) && empty( $args['featured_only'] ) && empty( $args['on_sale_only'] ) ) {
		return $args;
	}

	$tax_query = array();

	if ( ! empty( $args['tax_query'] ) && is_array( $args['tax_query'] ) ) {
		$tax_query = $args['tax_query'];
	}

	if ( ! empty( $args['category_slugs'] ) ) {
		$category_slugs = array_filter( array_map( 'sanitize_title', (array) $args['category_slugs'] ) );

		if ( $category_slugs && taxonomy_exists( 'product_cat' ) ) {
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $category_slugs,
				'operator' => 'IN',
			);
		}
	}

	if ( ! empty( $args['featured_only'] ) && taxonomy_exists( 'product_visibility' ) ) {
		$tax_query[] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'slug',
			'terms'    => array( 'featured' ),
			'operator' => 'IN',
		);
	}

	if ( ! empty( $args['on_sale_only'] ) && function_exists( 'wc_get_product_ids_on_sale' ) ) {
		$product_ids_on_sale = wc_get_product_ids_on_sale();
		$args['post__in']    = ! empty( $product_ids_on_sale ) ? array_map( 'absint', $product_ids_on_sale ) : array( 0 );
	}

	unset( $args['category_slugs'], $args['featured_only'], $args['on_sale_only'] );

	if ( $tax_query ) {
		$args['tax_query'] = $tax_query;
	}

	return $args;
}

/**
 * Implode HTML attributes safely.
 *
 * @param array $attributes Key/value pairs.
 * @return string
 */
function flamebubbles_implode_attributes( $attributes ) {
	$parts = array();

	foreach ( $attributes as $name => $value ) {
		if ( '' === $value || null === $value ) {
			continue;
		}

		$parts[] = sprintf( '%s="%s"', sanitize_key( $name ), esc_attr( $value ) );
	}

	return implode( ' ', $parts );
}

/**
 * Get a product image with a graceful fallback.
 *
 * @param int    $product_id Product ID.
 * @param string $size       Thumbnail size.
 * @param string $class_name Image class.
 * @return string
 */
function flamebubbles_get_product_image_markup( $product_id, $size = 'flamebubbles-product-card', $class_name = 'product-card__image' ) {
	if ( has_post_thumbnail( $product_id ) ) {
		return get_the_post_thumbnail(
			$product_id,
			$size,
			array(
				'class'    => $class_name,
				'loading'  => 'lazy',
				'decoding' => 'async',
			)
		);
	}

	$title = get_the_title( $product_id );

	return sprintf(
		'<div class="%1$s product-card__image--placeholder" aria-hidden="true"><span>%2$s</span></div>',
		esc_attr( $class_name ),
		esc_html( wp_html_excerpt( $title ? $title : __( 'Style', 'flamebubbles-atelier' ), 1, '' ) )
	);
}

/**
 * Return a product image URL with a graceful fallback.
 *
 * @param int    $product_id Product ID.
 * @param string $size       Image size.
 * @return string
 */
function flamebubbles_get_product_image_url( $product_id, $size = 'large' ) {
	$thumbnail_id = get_post_thumbnail_id( $product_id );

	if ( $thumbnail_id ) {
		$image_url = wp_get_attachment_image_url( $thumbnail_id, $size );

		if ( $image_url ) {
			return $image_url;
		}
	}

	if ( function_exists( 'wc_placeholder_img_src' ) ) {
		return wc_placeholder_img_src( $size );
	}

	return '';
}

/**
 * Get the primary product category term.
 *
 * @param int $product_id Product ID.
 * @return WP_Term|null
 */
function flamebubbles_get_product_primary_category( $product_id ) {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return null;
	}

	$terms = get_the_terms( $product_id, 'product_cat' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return null;
	}

	usort(
		$terms,
		static function ( $left, $right ) {
			return (int) $left->parent <=> (int) $right->parent;
		}
	);

	return $terms[0] instanceof WP_Term ? $terms[0] : null;
}

/**
 * Get the primary product category name.
 *
 * @param int    $product_id Product ID.
 * @param string $fallback   Fallback label.
 * @return string
 */
function flamebubbles_get_product_primary_category_name( $product_id, $fallback = '' ) {
	$term = flamebubbles_get_product_primary_category( $product_id );

	if ( $term instanceof WP_Term ) {
		return $term->name;
	}

	return $fallback ? $fallback : __( 'New Arrival', 'flamebubbles-atelier' );
}

/**
 * Render a shared empty state card.
 *
 * @param string $title   Title text.
 * @param string $message Message text.
 * @param string $class   Optional extra class.
 * @return void
 */
function flamebubbles_render_empty_state( $title, $message, $class = '' ) {
	?>
	<div class="empty-state <?php echo esc_attr( $class ); ?>">
		<p class="empty-state__eyebrow"><?php esc_html_e( 'Coming Soon', 'flamebubbles-atelier' ); ?></p>
		<h3 class="empty-state__title"><?php echo esc_html( $title ); ?></h3>
		<p class="empty-state__text"><?php echo esc_html( $message ); ?></p>
	</div>
	<?php
}

/**
 * Render a premium product card.
 *
 * @param int    $product_id Product ID.
 * @param string $variant    Visual variant.
 * @return void
 */
function flamebubbles_render_product_card( $product_id, $variant = 'default' ) {
	if ( ! flamebubbles_is_woocommerce_active() ) {
		return;
	}

	$product = wc_get_product( $product_id );

	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}

	$title             = $product->get_name();
	$permalink         = get_permalink( $product_id );
	$short_description = $product->get_short_description() ? wp_trim_words( wp_strip_all_tags( $product->get_short_description() ), 20 ) : wp_trim_words( wp_strip_all_tags( get_the_excerpt( $product_id ) ), 16 );
	$terms             = wc_get_product_terms( $product_id, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
	$category_label    = ! empty( $terms ) && ! is_wp_error( $terms ) ? $terms[0]->name : __( 'New Arrival', 'flamebubbles-atelier' );
	$is_new            = ( strtotime( get_post_field( 'post_date_gmt', $product_id ) ) > strtotime( '-30 days' ) );
	$button_url        = $permalink;
	$button_label      = $product->add_to_cart_text();
	$button_class      = 'button product-card__action button--ghost';
	$button_attributes = array();

	if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
		$button_url        = $product->add_to_cart_url();
		$button_label      = $product->add_to_cart_text();
		$button_class      = 'button product-card__action add_to_cart_button ajax_add_to_cart';
		$button_attributes = array(
			'data-product_id'  => $product->get_id(),
			'data-product_sku' => $product->get_sku(),
			'data-quantity'    => '1',
			'aria-label'       => wp_strip_all_tags( $product->add_to_cart_description() ),
			'rel'              => 'nofollow',
		);
	} elseif ( ! $product->is_in_stock() ) {
		$button_label = __( 'View Details', 'flamebubbles-atelier' );
	}
	?>
	<article <?php post_class( 'product-card product-card--' . sanitize_html_class( $variant ), $product_id ); ?>>
		<a class="product-card__media" href="<?php echo esc_url( $permalink ); ?>">
			<?php if ( $product->is_on_sale() ) : ?>
				<span class="product-card__badge product-card__badge--sale"><?php esc_html_e( 'Sale', 'flamebubbles-atelier' ); ?></span>
			<?php elseif ( $is_new ) : ?>
				<span class="product-card__badge product-card__badge--new"><?php esc_html_e( 'New', 'flamebubbles-atelier' ); ?></span>
			<?php endif; ?>
			<?php echo wp_kses_post( flamebubbles_get_product_image_markup( $product_id, 'hero' === $variant ? 'flamebubbles-hero-card' : 'flamebubbles-product-card' ) ); ?>
		</a>

		<div class="product-card__body">
			<div class="product-card__meta">
				<span class="product-card__eyebrow"><?php echo esc_html( $category_label ); ?></span>
				<?php if ( $product->is_type( 'variable' ) ) : ?>
					<span class="product-card__chip"><?php esc_html_e( 'Variable', 'flamebubbles-atelier' ); ?></span>
				<?php endif; ?>
			</div>

			<h3 class="product-card__title">
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
			</h3>

			<?php if ( $short_description ) : ?>
				<p class="product-card__text"><?php echo esc_html( $short_description ); ?></p>
			<?php endif; ?>

			<div class="product-card__footer">
				<div class="product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
				<a class="<?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $button_url ); ?>" <?php echo flamebubbles_implode_attributes( $button_attributes ); ?>>
					<?php echo esc_html( $button_label ); ?>
				</a>
			</div>
		</div>
	</article>
	<?php
}

/**
 * Render a reusable section heading.
 *
 * @param string $eyebrow     Eyebrow text.
 * @param string $title       Heading text.
 * @param string $description Supporting copy.
 * @param array  $link        Optional link config.
 * @return void
 */
function flamebubbles_render_section_heading( $eyebrow, $title, $description = '', $link = array() ) {
	$link = wp_parse_args(
		$link,
		array(
			'url'   => '',
			'label' => '',
		)
	);
	?>
	<div class="section-heading">
		<div>
			<?php if ( $eyebrow ) : ?>
				<p class="section-heading__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<?php endif; ?>
			<h2 class="section-heading__title"><?php echo esc_html( $title ); ?></h2>
			<?php if ( $description ) : ?>
				<p class="section-heading__text"><?php echo esc_html( $description ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $link['url'] && $link['label'] ) : ?>
			<a class="section-heading__link" href="<?php echo esc_url( $link['url'] ); ?>">
				<?php echo esc_html( $link['label'] ); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php
}
