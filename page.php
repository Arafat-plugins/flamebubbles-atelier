<?php
/**
 * Page template.
 *
 * @package FlamebubblesAtelier
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article id="page-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
				<header class="page-article__hero">
					<div class="container">
						<p class="page-article__eyebrow"><?php esc_html_e( 'Page', 'flamebubbles-atelier' ); ?></p>
						<h1 class="page-article__title"><?php the_title(); ?></h1>
					</div>
				</header>

				<div class="container page-article__content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php
get_footer();
