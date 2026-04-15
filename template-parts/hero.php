<?php
/**
 * Homepage hero section.
 *
 * @package FlamebubblesAtelier
 */

$collections = flamebubbles_get_collection_configs();
$hand_term    = flamebubbles_get_product_category_by_candidates( array( $collections['hand_stitch']['primary_slug'] ) );
$hero_query   = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 4,
		)
	)
);
$hero_products = $hero_query->posts;
$hero_secondary_url = flamebubbles_get_theme_option( 'hero_secondary_url' );
$hero_secondary_url = $hero_secondary_url ? $hero_secondary_url : flamebubbles_get_safe_term_link( $hand_term );
$brand_name = get_bloginfo( 'name' );
$partner_labels = array(
	flamebubbles_get_theme_option( 'hero_partner_1' ),
	flamebubbles_get_theme_option( 'hero_partner_2' ),
	flamebubbles_get_theme_option( 'hero_partner_3' ),
	flamebubbles_get_theme_option( 'hero_partner_4' ),
);
$proofs = array_filter(
	array(
		array(
			'title' => flamebubbles_get_theme_option( 'hero_proof_1_title' ),
			'text'  => flamebubbles_get_theme_option( 'hero_proof_1_text' ),
			'class' => 'hero-section__proof--accent',
		),
		array(
			'title' => flamebubbles_get_theme_option( 'hero_proof_2_title' ),
			'text'  => flamebubbles_get_theme_option( 'hero_proof_2_text' ),
			'class' => 'hero-section__proof--blush',
		),
		array(
			'title' => flamebubbles_get_theme_option( 'hero_proof_3_title' ),
			'text'  => flamebubbles_get_theme_option( 'hero_proof_3_text' ),
			'class' => 'hero-section__proof--sage',
		),
	),
	static function ( $proof ) {
		return ! empty( $proof['title'] ) || ! empty( $proof['text'] );
	}
);
?>

<section class="hero-section">
	<div class="container">
		<div class="hero-panel" data-watermark="<?php echo esc_attr( flamebubbles_get_theme_option( 'hero_watermark' ) ); ?>">
			<div class="hero-section__grid">
				<div class="hero-section__content">
					<div class="hero-section__signal" aria-hidden="true">
						<span class="hero-section__spark">*</span>
						<span class="hero-section__arrow">&darr;</span>
					</div>
					<p class="hero-section__eyebrow"><?php echo esc_html( flamebubbles_get_theme_option( 'hero_eyebrow' ) ); ?></p>
					<h1 class="hero-section__title">
						<?php echo esc_html( flamebubbles_get_theme_option( 'hero_title_line_one' ) ); ?>
						<span><?php echo esc_html( flamebubbles_get_theme_option( 'hero_title_line_two' ) ); ?></span>
					</h1>
					<p class="hero-section__text">
						<?php echo esc_html( flamebubbles_get_theme_option( 'hero_description' ) ); ?>
					</p>

					<div class="hero-section__actions">
						<a class="button button--primary" href="<?php echo esc_url( flamebubbles_get_theme_option( 'hero_primary_url', flamebubbles_get_shop_url() ) ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'hero_primary_label' ) ); ?></a>
						<a class="button button--ghost" href="<?php echo esc_url( $hero_secondary_url ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'hero_secondary_label' ) ); ?></a>
					</div>

					<div class="hero-section__partners" aria-label="<?php esc_attr_e( 'Collections', 'flamebubbles-atelier' ); ?>">
						<?php foreach ( $partner_labels as $partner_label ) : ?>
							<span><?php echo esc_html( $partner_label ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="hero-section__visual">
					<?php if ( flamebubbles_is_woocommerce_active() && ! empty( $hero_products ) ) : ?>
						<div class="hero-stack" aria-label="<?php esc_attr_e( 'Featured hero products', 'flamebubbles-atelier' ); ?>">
							<?php foreach ( $hero_products as $index => $hero_post ) : ?>
								<?php
								$product_id    = $hero_post->ID;
								$image_url     = flamebubbles_get_product_image_url( $product_id, 'flamebubbles-hero-card' );
								$category_name = flamebubbles_get_product_primary_category_name( $product_id );
								?>
								<a class="hero-stack__card hero-stack__card--<?php echo esc_attr( $index + 1 ); ?>" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $product_id ) ); ?>">
									<span class="hero-stack__media" <?php echo $image_url ? 'style="background-image:url(' . esc_url( $image_url ) . ');"' : ''; ?>></span>
									<span class="hero-stack__badge"><?php echo esc_html( $category_name ? $category_name : __( 'Featured edit', 'flamebubbles-atelier' ) ); ?></span>
									<span class="hero-stack__signature">
										<span class="hero-stack__mark" aria-hidden="true">*</span>
										<span class="hero-stack__brand"><?php echo esc_html( $brand_name ); ?></span>
									</span>
								</a>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<?php flamebubbles_render_empty_state( flamebubbles_get_theme_option( 'hero_empty_title' ), flamebubbles_get_theme_option( 'hero_empty_text' ), 'empty-state--hero' ); ?>
					<?php endif; ?>

					<?php if ( ! empty( $proofs ) ) : ?>
						<div class="hero-section__proofs" aria-label="<?php esc_attr_e( 'Store highlights', 'flamebubbles-atelier' ); ?>">
							<?php foreach ( $proofs as $proof ) : ?>
								<div class="hero-section__proof <?php echo esc_attr( $proof['class'] ); ?>">
									<span class="hero-section__proof-title"><?php echo esc_html( $proof['title'] ); ?></span>
									<span class="hero-section__proof-text"><?php echo esc_html( $proof['text'] ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
