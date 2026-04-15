<?php
/**
 * Custom product archive template.
 *
 * @package FlamebubblesAtelier
 */

defined( 'ABSPATH' ) || exit;

global $wp_query;

$shop_title       = woocommerce_page_title( false );
$archive_desc     = wp_strip_all_tags( get_the_archive_description() );
$archive_text     = $archive_desc ? $archive_desc : __( 'Browse premium collections with a custom-coded archive layout that keeps product discovery clean, fast, and highly visual.', 'flamebubbles-atelier' );
$product_total    = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
$published_counts = wp_count_posts( 'product' );

get_header();
?>

<main id="primary" class="site-main shop-main">
	<section class="shop-hero">
		<div class="container shop-hero__inner">
			<div>
				<p class="shop-hero__eyebrow"><?php esc_html_e( 'Shop', 'flamebubbles-atelier' ); ?></p>
				<h1 class="shop-hero__title"><?php echo esc_html( $shop_title ); ?></h1>
				<p class="shop-hero__text"><?php echo esc_html( $archive_text ); ?></p>
			</div>

			<div class="shop-hero__metrics">
				<div class="shop-hero__metric">
					<strong><?php echo esc_html( number_format_i18n( $product_total ) ); ?></strong>
					<span><?php esc_html_e( 'Products in view', 'flamebubbles-atelier' ); ?></span>
				</div>
				<div class="shop-hero__metric">
					<strong><?php echo esc_html( number_format_i18n( isset( $published_counts->publish ) ? (int) $published_counts->publish : 0 ) ); ?></strong>
					<span><?php esc_html_e( 'Published items', 'flamebubbles-atelier' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<div class="container woo-shell">
		<?php woocommerce_output_all_notices(); ?>

		<?php if ( woocommerce_product_loop() ) : ?>
			<div class="shop-toolbar">
				<div class="shop-toolbar__count"><?php woocommerce_result_count(); ?></div>
				<div class="shop-toolbar__ordering"><?php woocommerce_catalog_ordering(); ?></div>
			</div>

			<?php woocommerce_product_loop_start(); ?>

			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>
		<?php else : ?>
			<?php do_action( 'woocommerce_no_products_found' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
