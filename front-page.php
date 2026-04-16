<?php
/**
 * Front page template.
 *
 * @package FlamebubblesAtelier
 */

get_header();
?>

<main id="primary" class="site-main site-main--home">
	<?php get_template_part( 'template-parts/hero' ); ?>
	<?php get_template_part( 'template-parts/featured-slider' ); ?>
	<?php get_template_part( 'template-parts/category-grid' ); ?>
	<?php get_template_part( 'template-parts/latest-products' ); ?>
	<?php get_template_part( 'template-parts/featured-collection' ); ?>

	<?php
	get_template_part(
		'template-parts/product-collection',
		null,
		array(
			'config_key'    => 'men',
			'section_id'    => 'mens-edit',
			'section_class' => 'section--ink',
			'variant'       => 'reverse',
		)
	);
	?>

	<?php
	get_template_part(
		'template-parts/product-collection',
		null,
		array(
			'config_key'    => 'women',
			'section_id'    => 'womens-edit',
			'section_class' => 'section--sand',
			'variant'       => 'default',
		)
	);
	?>

	<?php get_template_part( 'template-parts/why-choose-us' ); ?>
	<?php get_template_part( 'template-parts/testimonials' ); ?>
	<?php get_template_part( 'template-parts/instagram-gallery' ); ?>
</main>

<?php
get_footer();
