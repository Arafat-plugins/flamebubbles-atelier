<?php
/**
 * Premium category grid section.
 *
 * @package FlamebubblesAtelier
 */

$collections = flamebubbles_get_collection_configs();
$all_slugs    = array();

foreach ( $collections as $config ) {
	$all_slugs = array_merge( $all_slugs, $config['category_set'] );
}

$grid_query = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 6,
			'category_slugs' => array_unique( $all_slugs ),
		)
	)
);
$grid_products = $grid_query->posts;
?>

<section id="collections" class="section section--dark category-grid-section">
	<div class="container">
		<div class="category-grid-board">
			<div class="category-grid-board__header">
				<div class="category-grid-board__brand">
					<span class="category-grid-board__mark" aria-hidden="true">*</span>
					<span class="category-grid-board__brand-text"><?php echo esc_html( flamebubbles_get_theme_option( 'category_board_brand', get_bloginfo( 'name' ) ) ); ?></span>
				</div>
				<div class="category-grid-board__actions">
					<a class="category-grid-board__pill category-grid-board__pill--soft" href="<?php echo esc_url( flamebubbles_get_theme_option( 'category_board_action_1_url', flamebubbles_get_shop_url() ) ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'category_board_action_1_label' ) ); ?></a>
					<a class="category-grid-board__pill category-grid-board__pill--dark" href="<?php echo esc_url( flamebubbles_get_theme_option( 'category_board_action_2_url', flamebubbles_get_cart_url() ) ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'category_board_action_2_label' ) ); ?></a>
				</div>
			</div>

			<div class="slider-shell" data-slider>
				<div class="slider-shell__controls">
					<button class="slider-shell__button" type="button" data-slider-prev aria-label="<?php esc_attr_e( 'Scroll previous categories', 'flamebubbles-atelier' ); ?>">&larr;</button>
					<button class="slider-shell__button" type="button" data-slider-next aria-label="<?php esc_attr_e( 'Scroll next categories', 'flamebubbles-atelier' ); ?>">&rarr;</button>
				</div>

				<div class="category-grid" data-slider-track>
					<?php if ( flamebubbles_is_woocommerce_active() && ! empty( $grid_products ) ) : ?>
						<?php foreach ( $grid_products as $index => $grid_post ) : ?>
							<?php
							$product_id      = $grid_post->ID;
							$grid_product    = wc_get_product( $product_id );
							$image_url       = flamebubbles_get_product_image_url( $product_id, 'flamebubbles-hero-card' );
							$category_name   = flamebubbles_get_product_primary_category_name( $product_id );
							$short_text      = $grid_product && $grid_product->get_short_description() ? wp_trim_words( wp_strip_all_tags( $grid_product->get_short_description() ), 8 ) : wp_trim_words( get_the_title( $product_id ), 6 );
							$tile_class_name = 'category-grid__tile category-grid__tile--' . ( $index + 1 );
							?>
							<article class="<?php echo esc_attr( $tile_class_name ); ?>">
								<a class="category-grid__link" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
									<div class="category-grid__media" <?php echo $image_url ? 'style="background-image:url(' . esc_url( $image_url ) . ');"' : ''; ?>></div>
									<div class="category-grid__overlay"></div>
									<div class="category-grid__content">
										<p class="category-grid__eyebrow">
											<span><?php echo esc_html( $category_name ); ?></span>
											<?php if ( $grid_product ) : ?>
												<span><?php echo wp_kses_post( $grid_product->get_price_html() ); ?></span>
											<?php endif; ?>
										</p>
										<h3 class="category-grid__title"><?php echo esc_html( get_the_title( $product_id ) ); ?></h3>
										<p class="category-grid__text"><?php echo esc_html( $short_text ); ?></p>
									</div>
								</a>
							</article>
						<?php endforeach; ?>
					<?php else : ?>
						<?php flamebubbles_render_empty_state( flamebubbles_get_theme_option( 'category_empty_title' ), flamebubbles_get_theme_option( 'category_empty_text' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
