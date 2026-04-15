<?php
/**
 * Latest products section.
 *
 * @package FlamebubblesAtelier
 */

$latest_products = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 8,
		)
	)
);
?>

<section class="section">
	<div class="container">
		<?php
		flamebubbles_render_section_heading(
			flamebubbles_get_theme_option( 'latest_eyebrow' ),
			flamebubbles_get_theme_option( 'latest_title' ),
			flamebubbles_get_theme_option( 'latest_description' ),
			array(
				'url'   => flamebubbles_get_shop_url(),
				'label' => flamebubbles_get_theme_option( 'latest_button_label' ),
			)
		);
		?>

		<?php if ( flamebubbles_is_woocommerce_active() && $latest_products->have_posts() ) : ?>
			<div class="slider-shell" data-slider>
				<div class="slider-shell__controls">
					<button class="slider-shell__button" type="button" data-slider-prev aria-label="<?php esc_attr_e( 'Scroll previous products', 'flamebubbles-atelier' ); ?>">&larr;</button>
					<button class="slider-shell__button" type="button" data-slider-next aria-label="<?php esc_attr_e( 'Scroll next products', 'flamebubbles-atelier' ); ?>">&rarr;</button>
				</div>

				<div class="product-rail" data-slider-track>
					<?php while ( $latest_products->have_posts() ) : ?>
						<?php $latest_products->the_post(); ?>
						<?php flamebubbles_render_product_card( get_the_ID(), 'default' ); ?>
					<?php endwhile; ?>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<?php flamebubbles_render_empty_state( flamebubbles_get_theme_option( 'latest_empty_title' ), flamebubbles_get_theme_option( 'latest_empty_text' ) ); ?>
		<?php endif; ?>
	</div>
</section>
