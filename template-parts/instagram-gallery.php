<?php
/**
 * Instagram style gallery section.
 *
 * @package FlamebubblesAtelier
 */

$gallery_query = new WP_Query(
	flamebubbles_build_product_query_args(
		array(
			'posts_per_page' => 6,
		)
	)
);
?>

<section class="section section--gallery">
	<div class="container">
		<?php
		flamebubbles_render_section_heading(
			flamebubbles_get_theme_option( 'gallery_eyebrow' ),
			flamebubbles_get_theme_option( 'gallery_title' ),
			flamebubbles_get_theme_option( 'gallery_description' ),
			array(
				'url'   => flamebubbles_get_shop_url(),
				'label' => flamebubbles_get_theme_option( 'gallery_button_label' ),
			)
		);
		?>

		<?php if ( flamebubbles_is_woocommerce_active() && $gallery_query->have_posts() ) : ?>
			<div class="gallery-grid">
				<?php while ( $gallery_query->have_posts() ) : ?>
					<?php $gallery_query->the_post(); ?>
					<a class="gallery-grid__item" href="<?php the_permalink(); ?>">
						<?php echo wp_kses_post( flamebubbles_get_product_image_markup( get_the_ID(), 'flamebubbles-gallery-tall', 'gallery-grid__image' ) ); ?>
						<span class="gallery-grid__caption"><?php the_title(); ?></span>
					</a>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<?php flamebubbles_render_empty_state( flamebubbles_get_theme_option( 'gallery_empty_title' ), flamebubbles_get_theme_option( 'gallery_empty_text' ) ); ?>
		<?php endif; ?>
	</div>
</section>
