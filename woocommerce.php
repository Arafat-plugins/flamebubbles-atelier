<?php
/**
 * Fallback WooCommerce template.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_product() ) {
	get_header();
	?>
	<main id="primary" class="site-main shop-main single-product-main">
		<div class="container single-product-shell">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php endwhile; ?>
		</div>
	</main>
	<?php
	get_footer();
	return;
}

$page_title = function_exists( 'woocommerce_page_title' ) ? woocommerce_page_title( false ) : get_the_title();

if ( is_cart() ) {
	$page_description = __( 'A clean, conversion-focused cart with custom styling that matches the rest of the premium storefront.', 'flamebubbles-atelier' );
} elseif ( is_checkout() ) {
	$page_description = __( 'A polished checkout layout designed to keep the purchase flow calm, clear, and trustworthy.', 'flamebubbles-atelier' );
} elseif ( is_account_page() ) {
	$page_description = __( 'Manage orders, addresses, and account details from the same premium commerce environment.', 'flamebubbles-atelier' );
} else {
	$page_description = __( 'A custom WooCommerce experience built without builders, shaped for premium fashion commerce.', 'flamebubbles-atelier' );
}

get_header();
?>

<main id="primary" class="site-main shop-main">
	<section class="shop-hero shop-hero--utility">
		<div class="container shop-hero__inner">
			<div>
				<p class="shop-hero__eyebrow"><?php esc_html_e( 'Storefront', 'flamebubbles-atelier' ); ?></p>
				<h1 class="shop-hero__title"><?php echo esc_html( $page_title ); ?></h1>
				<p class="shop-hero__text"><?php echo esc_html( $page_description ); ?></p>
			</div>
			<div class="shop-hero__aside">
				<p><?php esc_html_e( 'Fully custom coded', 'flamebubbles-atelier' ); ?></p>
				<p><?php esc_html_e( 'WooCommerce native support', 'flamebubbles-atelier' ); ?></p>
			</div>
		</div>
	</section>

	<div class="container woo-shell">
		<?php woocommerce_content(); ?>
	</div>
</main>

<?php
get_footer();
