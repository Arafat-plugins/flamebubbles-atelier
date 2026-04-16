<?php
/**
 * Single product content – clean editorial layout.
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
$product_terms       = get_the_terms( $product->get_id(), 'product_cat' );
$primary_term        = ( ! empty( $product_terms ) && ! is_wp_error( $product_terms ) ) ? reset( $product_terms ) : null;
$category_list       = wc_get_product_category_list( $product->get_id(), ' / ' );
$tag_list            = wc_get_product_tag_list( $product->get_id(), ', ' );
$review_count        = (int) $product->get_review_count();
$reviews_enabled     = comments_open();
$short_description   = $product->get_short_description();
$description_content = $product->get_description();
$description_html    = $description_content
	? apply_filters( 'the_content', $description_content )
	: apply_filters( 'woocommerce_short_description', $short_description );
$tabs_namespace      = 'product-' . $product_id;
$description_intro   = '';
$reviews_tab_label   = $review_count > 0
	? sprintf( _n( 'Reviews (%d)', 'Reviews (%d)', $review_count, 'flamebubbles-atelier' ), $review_count )
	: __( 'Reviews', 'flamebubbles-atelier' );

$details_table = '';
if ( function_exists( 'wc_display_product_attributes' ) ) {
	ob_start();
	wc_display_product_attributes( $product );
	$details_table = trim( (string) ob_get_clean() );
}
$details_tab_label = $details_table
	? __( 'Details', 'flamebubbles-atelier' )
	: __( 'Product Info', 'flamebubbles-atelier' );

if ( $description_content && $short_description ) {
	$short_text = trim( wp_strip_all_tags( $short_description ) );
	$desc_text  = trim( wp_strip_all_tags( $description_content ) );
	if ( $short_text && $short_text !== $desc_text ) {
		$description_intro = apply_filters( 'woocommerce_short_description', $short_description );
	}
}
?>

<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-view', $product ); ?>>

	<!-- ── Stage: gallery + summary (2-col) ──────────────── -->
	<div class="single-product-view__stage">

		<!-- Gallery -->
		<div class="single-product-view__gallery-column">
			<div class="single-product-view__gallery">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
		</div>

		<!-- Summary -->
		<aside class="single-product-view__summary-column">
			<div class="single-product-view__summary">

				<!-- Category + status chips -->
				<div class="single-product-view__intro">
					<div class="single-product-view__chips">
						<span class="single-product-view__chip single-product-view__chip--cat">
							<?php echo esc_html( $primary_term ? $primary_term->name : __( 'Collection', 'flamebubbles-atelier' ) ); ?>
						</span>
						<?php if ( $product->is_on_sale() ) : ?>
							<span class="single-product-view__chip single-product-view__chip--sale">
								<?php esc_html_e( 'Sale', 'flamebubbles-atelier' ); ?>
							</span>
						<?php endif; ?>
						<?php if ( ! $product->is_in_stock() ) : ?>
							<span class="single-product-view__chip single-product-view__chip--oos">
								<?php esc_html_e( 'Sold out', 'flamebubbles-atelier' ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<!-- WC summary hooks: title, rating, price, features, cart, purchase meta -->
				<div class="single-product-view__summary-inner">
					<?php do_action( 'woocommerce_single_product_summary' ); ?>
				</div>

			</div><!-- /.single-product-view__summary -->
		</aside>

	</div><!-- /.single-product-view__stage -->

	<!-- ── Tabs (full width) ─────────────────────────────── -->
	<section class="single-product-view__tabs" data-product-tabs>

		<div
			class="single-product-view__tab-list"
			role="tablist"
			aria-label="<?php esc_attr_e( 'Product information', 'flamebubbles-atelier' ); ?>"
		>
			<button
				class="single-product-view__tab is-active"
				id="<?php echo esc_attr( $tabs_namespace . '-tab-description' ); ?>"
				type="button"
				role="tab"
				aria-selected="true"
				aria-controls="<?php echo esc_attr( $tabs_namespace . '-panel-description' ); ?>"
				data-tab-target="description"
			><?php esc_html_e( 'Description', 'flamebubbles-atelier' ); ?></button>

			<button
				class="single-product-view__tab"
				id="<?php echo esc_attr( $tabs_namespace . '-tab-details' ); ?>"
				type="button"
				role="tab"
				aria-selected="false"
				aria-controls="<?php echo esc_attr( $tabs_namespace . '-panel-details' ); ?>"
				data-tab-target="details"
				tabindex="-1"
			><?php echo esc_html( $details_tab_label ); ?></button>

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
				><?php echo esc_html( $reviews_tab_label ); ?></button>
			<?php endif; ?>
		</div>

		<div class="single-product-view__tab-panels">

			<!-- Description panel -->
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
					<p class="spv-empty-tab"><?php esc_html_e( 'No description added yet.', 'flamebubbles-atelier' ); ?></p>
				<?php endif; ?>
			</section>

			<!-- Details panel -->
			<section
				class="single-product-view__tab-panel"
				id="<?php echo esc_attr( $tabs_namespace . '-panel-details' ); ?>"
				role="tabpanel"
				aria-labelledby="<?php echo esc_attr( $tabs_namespace . '-tab-details' ); ?>"
				data-tab-panel="details"
				hidden
			>
				<?php if ( $product->get_sku() || $category_list || $tag_list || $details_table ) : ?>

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
							<span><?php esc_html_e( 'Stock', 'flamebubbles-atelier' ); ?></span>
							<strong><?php echo esc_html( $product->is_in_stock() ? __( 'In stock', 'flamebubbles-atelier' ) : __( 'Out of stock', 'flamebubbles-atelier' ) ); ?></strong>
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
					<?php endif; ?>

				<?php else : ?>
					<p class="spv-empty-tab"><?php esc_html_e( 'Add product attributes in WooCommerce to display details here.', 'flamebubbles-atelier' ); ?></p>
				<?php endif; ?>
			</section>

			<!-- Reviews panel -->
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

		</div><!-- /.single-product-view__tab-panels -->
	</section><!-- /.single-product-view__tabs -->

	<!-- ── Related products (full width) ─────────────────── -->
	<div class="single-product-view__related">
		<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	</div>

</article>

<?php do_action( 'woocommerce_after_single_product' ); ?>
