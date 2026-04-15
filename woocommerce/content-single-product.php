<?php
/**
 * Custom single product content layout.
 *
 * @package FlamebubblesAtelier
 */

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

$product_id          = $product->get_id();
$product_terms = get_the_terms( $product->get_id(), 'product_cat' );
$primary_term  = ( ! empty( $product_terms ) && ! is_wp_error( $product_terms ) ) ? reset( $product_terms ) : null;

$category_list       = wc_get_product_category_list( $product->get_id(), ' / ' );
$tag_list            = wc_get_product_tag_list( $product->get_id(), ', ' );
$gallery_count       = count( $product->get_gallery_image_ids() ) + ( $product->get_image_id() ? 1 : 0 );
$review_count        = (int) $product->get_review_count();
$reviews_enabled     = comments_open();
$short_description   = $product->get_short_description();
$description_content = $product->get_description();
$description_html    = $description_content ? apply_filters( 'the_content', $description_content ) : apply_filters( 'woocommerce_short_description', $short_description );
$tabs_namespace      = 'product-' . $product_id;
$description_intro   = '';
$reviews_tab_label   = $review_count > 0 ? sprintf( _n( 'Review (%d)', 'Reviews (%d)', $review_count, 'flamebubbles-atelier' ), $review_count ) : __( 'Reviews', 'flamebubbles-atelier' );

$details_table = '';

if ( function_exists( 'wc_display_product_attributes' ) ) {
	ob_start();
	wc_display_product_attributes( $product );
	$details_table = trim( (string) ob_get_clean() );
}

$details_tab_label = $details_table ? __( 'Product details', 'flamebubbles-atelier' ) : __( 'Product info', 'flamebubbles-atelier' );

if ( $description_content && $short_description ) {
	$short_description_text = trim( wp_strip_all_tags( $short_description ) );
	$description_text       = trim( wp_strip_all_tags( $description_content ) );

	if ( $short_description_text && $short_description_text !== $description_text ) {
		$description_intro = apply_filters( 'woocommerce_short_description', $short_description );
	}
}
?>

<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-view', $product ); ?>>
	<div class="single-product-view__frame">
		<div class="single-product-view__stage">
			<div class="single-product-view__gallery-column">
				<div class="single-product-view__gallery">
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
				</div>
			</div>

			<aside class="single-product-view__summary-column">
				<div class="single-product-view__summary">
					<div class="single-product-view__intro">
						<p class="single-product-view__eyebrow">
							<span class="single-product-view__eyebrow-icon" aria-hidden="true"></span>
							<span><?php echo esc_html( $primary_term ? $primary_term->name : __( 'Signature edit', 'flamebubbles-atelier' ) ); ?></span>
						</p>

						<div class="single-product-view__chips">
							<?php if ( $product->is_on_sale() ) : ?>
								<span class="single-product-view__chip single-product-view__chip--accent"><?php esc_html_e( 'Sale', 'flamebubbles-atelier' ); ?></span>
							<?php endif; ?>

							<span class="single-product-view__chip"><?php echo esc_html( $product->is_in_stock() ? __( 'In stock', 'flamebubbles-atelier' ) : __( 'Available on order', 'flamebubbles-atelier' ) ); ?></span>
							<span class="single-product-view__chip"><?php echo esc_html( $product->is_type( 'variable' ) ? __( 'Options available', 'flamebubbles-atelier' ) : __( 'Quick purchase', 'flamebubbles-atelier' ) ); ?></span>
						</div>
					</div>

					<div class="single-product-view__summary-inner">
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
					</div>

					<div class="single-product-view__secondary">
						<div class="single-product-view__secondary-item">
							<span><?php esc_html_e( 'Gallery', 'flamebubbles-atelier' ); ?></span>
							<strong>
								<?php
								printf(
									esc_html(
										_n( '%d image', '%d images', max( 1, $gallery_count ), 'flamebubbles-atelier' )
									),
									esc_html( max( 1, $gallery_count ) )
								);
								?>
							</strong>
						</div>

						<div class="single-product-view__secondary-item">
							<span><?php esc_html_e( 'SKU', 'flamebubbles-atelier' ); ?></span>
							<strong><?php echo esc_html( $product->get_sku() ? $product->get_sku() : __( 'Generated in WooCommerce', 'flamebubbles-atelier' ) ); ?></strong>
						</div>

						<div class="single-product-view__secondary-item">
							<span><?php esc_html_e( 'Support', 'flamebubbles-atelier' ); ?></span>
							<strong><?php esc_html_e( 'Tablet and mobile ready', 'flamebubbles-atelier' ); ?></strong>
						</div>
					</div>
				</div>
			</aside>
		</div>

		<div class="single-product-view__lower">
			<div class="single-product-view__related">
				<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
			</div>

			<section class="single-product-view__tabs" data-product-tabs>
				<div class="single-product-view__tab-list" role="tablist" aria-label="<?php esc_attr_e( 'Product information', 'flamebubbles-atelier' ); ?>">
					<button
						class="single-product-view__tab is-active"
						id="<?php echo esc_attr( $tabs_namespace . '-tab-description' ); ?>"
						type="button"
						role="tab"
						aria-selected="true"
						aria-controls="<?php echo esc_attr( $tabs_namespace . '-panel-description' ); ?>"
						data-tab-target="description"
					>
						<?php esc_html_e( 'Description', 'flamebubbles-atelier' ); ?>
					</button>
					<button
						class="single-product-view__tab"
						id="<?php echo esc_attr( $tabs_namespace . '-tab-details' ); ?>"
						type="button"
						role="tab"
						aria-selected="false"
						aria-controls="<?php echo esc_attr( $tabs_namespace . '-panel-details' ); ?>"
						data-tab-target="details"
						tabindex="-1"
					>
						<?php echo esc_html( $details_tab_label ); ?>
					</button>
					<?php if ( $reviews_enabled || $review_count > 0 ) : ?>
						<button
							class="single-product-view__tab"
							id="<?php echo esc_attr( $tabs_namespace . '-tab-reviews' ); ?>"
							type="button"
							role="tab"
							aria-selected="false"
							aria-controls="<?php echo esc_attr( $tabs_namespace . '-panel-reviews' ); ?>"
							data-tab-target="reviews"
							tabindex="-1"
						>
							<?php echo esc_html( $reviews_tab_label ); ?>
						</button>
					<?php endif; ?>
				</div>

				<div class="single-product-view__tab-panels">
					<section
						class="single-product-view__tab-panel is-active"
						id="<?php echo esc_attr( $tabs_namespace . '-panel-description' ); ?>"
						role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $tabs_namespace . '-tab-description' ); ?>"
						data-tab-panel="description"
					>
						<?php if ( $description_intro ) : ?>
							<div class="single-product-view__tab-intro">
								<?php echo wp_kses_post( $description_intro ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $description_html ) : ?>
							<?php echo wp_kses_post( $description_html ); ?>
						<?php else : ?>
							<p><?php esc_html_e( 'Add a full product description from WooCommerce to show styling notes, fabric details, and care guidance here.', 'flamebubbles-atelier' ); ?></p>
						<?php endif; ?>
					</section>

					<section
						class="single-product-view__tab-panel"
						id="<?php echo esc_attr( $tabs_namespace . '-panel-details' ); ?>"
						role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $tabs_namespace . '-tab-details' ); ?>"
						data-tab-panel="details"
						hidden
					>
						<div class="single-product-view__facts">
							<?php if ( $product->get_sku() ) : ?>
								<div class="single-product-view__fact">
									<span><?php esc_html_e( 'SKU', 'flamebubbles-atelier' ); ?></span>
									<strong><?php echo esc_html( $product->get_sku() ); ?></strong>
								</div>
							<?php endif; ?>

							<div class="single-product-view__fact">
								<span><?php esc_html_e( 'Type', 'flamebubbles-atelier' ); ?></span>
								<strong><?php echo esc_html( $product->is_type( 'variable' ) ? __( 'Variable product', 'flamebubbles-atelier' ) : __( 'Simple product', 'flamebubbles-atelier' ) ); ?></strong>
							</div>

							<div class="single-product-view__fact">
								<span><?php esc_html_e( 'Availability', 'flamebubbles-atelier' ); ?></span>
								<strong><?php echo esc_html( $product->is_in_stock() ? __( 'In stock', 'flamebubbles-atelier' ) : __( 'Available on order', 'flamebubbles-atelier' ) ); ?></strong>
							</div>

							<?php if ( $category_list ) : ?>
								<div class="single-product-view__fact">
									<span><?php esc_html_e( 'Categories', 'flamebubbles-atelier' ); ?></span>
									<strong><?php echo wp_kses_post( $category_list ); ?></strong>
								</div>
							<?php endif; ?>

							<?php if ( $tag_list ) : ?>
								<div class="single-product-view__fact">
									<span><?php esc_html_e( 'Tags', 'flamebubbles-atelier' ); ?></span>
									<strong><?php echo wp_kses_post( $tag_list ); ?></strong>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( $details_table ) : ?>
							<div class="single-product-view__details-table">
								<?php echo wp_kses_post( $details_table ); ?>
							</div>
						<?php else : ?>
							<p><?php esc_html_e( 'Add product attributes in WooCommerce to show fabric, size, care, or material details in this tab.', 'flamebubbles-atelier' ); ?></p>
						<?php endif; ?>
					</section>

					<?php if ( $reviews_enabled || $review_count > 0 ) : ?>
						<section
							class="single-product-view__tab-panel"
							id="<?php echo esc_attr( $tabs_namespace . '-panel-reviews' ); ?>"
							role="tabpanel"
							aria-labelledby="<?php echo esc_attr( $tabs_namespace . '-tab-reviews' ); ?>"
							data-tab-panel="reviews"
							hidden
						>
							<?php comments_template(); ?>
						</section>
					<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</article>

<?php do_action( 'woocommerce_after_single_product' ); ?>
