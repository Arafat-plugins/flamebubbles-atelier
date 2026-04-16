<?php
/**
 * Featured products slider — horizontal carousel directly after the hero.
 *
 * @package FlamebubblesAtelier
 */

if ( ! flamebubbles_is_woocommerce_active() ) {
	return;
}

// Try featured products first; fall back to latest if none are marked featured.
$fs_query = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 8,
			'featured_only'  => true,
		)
	)
);

if ( ! $fs_query->have_posts() ) {
	$fs_query = new WP_Query(
		flamebubbles_build_product_query_args(
			array(
				'posts_per_page' => 8,
			)
		)
	);
}

if ( ! $fs_query->have_posts() ) {
	return;
}

$fs_eyebrow = flamebubbles_get_theme_option( 'fs_eyebrow' );
$fs_title   = flamebubbles_get_theme_option( 'fs_title' );
$fs_url     = flamebubbles_get_theme_option( 'fs_url' ) ?: flamebubbles_get_shop_url();
$fs_label   = flamebubbles_get_theme_option( 'fs_label' );
?>

<section class="section featured-slider-section">
	<div class="container">
		<div class="featured-slider" data-slider data-slider-always>

			<div class="featured-slider__header">
				<div class="featured-slider__meta">
					<p class="featured-slider__eyebrow"><?php echo esc_html( $fs_eyebrow ); ?></p>
					<h2 class="featured-slider__title"><?php echo esc_html( $fs_title ); ?></h2>
				</div>

				<div class="featured-slider__actions">
					<?php if ( $fs_url && $fs_label ) : ?>
						<a class="featured-slider__view-all" href="<?php echo esc_url( $fs_url ); ?>">
							<?php echo esc_html( $fs_label ); ?>
						</a>
					<?php endif; ?>

					<div
						class="featured-slider__nav"
						role="group"
						aria-label="<?php esc_attr_e( 'Slider navigation', 'flamebubbles-atelier' ); ?>"
					>
						<button
							class="featured-slider__btn"
							type="button"
							data-slider-prev
							aria-label="<?php esc_attr_e( 'Previous products', 'flamebubbles-atelier' ); ?>"
						>
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" focusable="false">
								<path d="M11 13.5L6.5 9L11 4.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<button
							class="featured-slider__btn"
							type="button"
							data-slider-next
							aria-label="<?php esc_attr_e( 'Next products', 'flamebubbles-atelier' ); ?>"
						>
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" focusable="false">
								<path d="M7 4.5L11.5 9L7 13.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
				</div>
			</div>

			<div class="featured-slider__track" data-slider-track>
				<?php while ( $fs_query->have_posts() ) : ?>
					<?php $fs_query->the_post(); ?>
					<?php flamebubbles_render_product_card( get_the_ID(), 'default' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>

		</div>
	</div>
</section>
