<?php
/**
 * Custom single product template.
 *
 * @package FlamebubblesAtelier
 */

defined( 'ABSPATH' ) || exit;

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
