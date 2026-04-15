<?php
/**
 * Featured collection section.
 *
 * @package FlamebubblesAtelier
 */

$collections   = flamebubbles_get_collection_configs();
$config        = $collections['hand_stitch'];
$primary_term  = flamebubbles_get_product_category_by_candidates( array( $config['primary_slug'] ) );
$featured_args = flamebubbles_build_product_query_args(
	array(
		'posts_per_page' => 4,
		'category_slugs' => $config['category_set'],
		'featured_only'  => true,
	)
);
$featured_loop = new WP_Query( $featured_args );

if ( ! $featured_loop->have_posts() ) {
	$featured_loop = new WP_Query(
		flamebubbles_build_product_query_args(
			array(
				'posts_per_page' => 4,
				'category_slugs' => $config['category_set'],
			)
		)
	);
}
?>

<section class="section section--sand">
	<div class="container feature-collection">
		<div class="feature-collection__intro">
			<?php
			flamebubbles_render_section_heading(
				$config['eyebrow'],
				$config['title'],
				flamebubbles_get_theme_option( 'hand_stitch_intro' ),
				array(
					'url'   => flamebubbles_get_safe_term_link( $primary_term ),
					'label' => $config['link_label'],
				)
			);
			?>

			<div class="feature-collection__panel">
				<h3><?php echo esc_html( flamebubbles_get_theme_option( 'hand_stitch_panel_title' ) ); ?></h3>
				<ul>
					<li><?php echo esc_html( flamebubbles_get_theme_option( 'hand_stitch_panel_1' ) ); ?></li>
					<li><?php echo esc_html( flamebubbles_get_theme_option( 'hand_stitch_panel_2' ) ); ?></li>
					<li><?php echo esc_html( flamebubbles_get_theme_option( 'hand_stitch_panel_3' ) ); ?></li>
				</ul>
			</div>
		</div>

		<div class="feature-collection__products slider-shell" data-slider>
			<div class="slider-shell__controls">
				<button class="slider-shell__button" type="button" data-slider-prev aria-label="<?php esc_attr_e( 'Scroll previous featured products', 'flamebubbles-atelier' ); ?>">&larr;</button>
				<button class="slider-shell__button" type="button" data-slider-next aria-label="<?php esc_attr_e( 'Scroll next featured products', 'flamebubbles-atelier' ); ?>">&rarr;</button>
			</div>

			<?php if ( flamebubbles_is_woocommerce_active() && $featured_loop->have_posts() ) : ?>
				<div class="product-rail product-rail--compact" data-slider-track>
					<?php while ( $featured_loop->have_posts() ) : ?>
						<?php $featured_loop->the_post(); ?>
						<?php flamebubbles_render_product_card( get_the_ID(), 'feature' ); ?>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php flamebubbles_render_empty_state( flamebubbles_get_theme_option( 'hand_stitch_empty_title' ), flamebubbles_get_theme_option( 'hand_stitch_empty_text' ) ); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
