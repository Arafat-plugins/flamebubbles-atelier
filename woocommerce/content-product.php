<?php
/**
 * Custom product loop card.
 *
 * @package FlamebubblesAtelier
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php wc_product_class( 'shop-card-entry', $product ); ?>>
	<?php flamebubbles_render_product_card( $product->get_id(), 'shop' ); ?>
</li>
