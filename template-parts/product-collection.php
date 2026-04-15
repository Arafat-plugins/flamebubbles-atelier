<?php
/**
 * Reusable product collection section.
 *
 * @package FlamebubblesAtelier
 */

$args        = wp_parse_args(
	$args,
	array(
		'config_key'    => 'women',
		'section_id'    => '',
		'section_class' => '',
		'variant'       => 'default',
	)
);
$collections = flamebubbles_get_collection_configs();
$config_key   = isset( $collections[ $args['config_key'] ] ) ? $args['config_key'] : 'women';
$config       = $collections[ $config_key ];
$term         = flamebubbles_get_product_category_by_candidates( array( $config['primary_slug'] ) );
$section_loop = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 4,
			'category_slugs' => $config['category_set'],
		)
	)
);
?>

<section<?php echo $args['section_id'] ? ' id="' . esc_attr( $args['section_id'] ) . '"' : ''; ?> class="section collection-showcase <?php echo esc_attr( $args['section_class'] ); ?> <?php echo 'reverse' === $args['variant'] ? 'collection-showcase--reverse' : ''; ?>">
	<div class="container collection-showcase__grid">
		<div class="collection-showcase__content">
			<?php
			flamebubbles_render_section_heading(
				$config['eyebrow'],
				$config['title'],
				$config['description'],
				array(
					'url'   => flamebubbles_get_safe_term_link( $term ),
					'label' => $config['link_label'],
				)
			);
			?>

			<div class="collection-showcase__story">
				<?php if ( ! empty( $config['story_text'] ) ) : ?>
					<p><?php echo esc_html( $config['story_text'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $config['story_items'] ) ) : ?>
					<ul>
						<?php foreach ( $config['story_items'] as $story_item ) : ?>
							<?php if ( $story_item ) : ?>
								<li><?php echo esc_html( $story_item ); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<div class="collection-showcase__products slider-shell" data-slider>
			<div class="slider-shell__controls">
				<button class="slider-shell__button" type="button" data-slider-prev aria-label="<?php esc_attr_e( 'Scroll previous products', 'flamebubbles-atelier' ); ?>">&larr;</button>
				<button class="slider-shell__button" type="button" data-slider-next aria-label="<?php esc_attr_e( 'Scroll next products', 'flamebubbles-atelier' ); ?>">&rarr;</button>
			</div>

			<?php if ( flamebubbles_is_woocommerce_active() && $section_loop->have_posts() ) : ?>
				<div class="product-rail product-rail--compact" data-slider-track>
					<?php while ( $section_loop->have_posts() ) : ?>
						<?php $section_loop->the_post(); ?>
						<?php flamebubbles_render_product_card( get_the_ID(), 'collection' ); ?>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php flamebubbles_render_empty_state( $config['title'], __( 'Add products to the linked category structure and this collection section will update automatically.', 'flamebubbles-atelier' ) ); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
