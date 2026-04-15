<?php
/**
 * Single post template.
 *
 * @package FlamebubblesAtelier
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-article' ); ?>>
				<header class="entry-article__hero">
					<div class="container entry-article__hero-inner">
						<p class="entry-article__eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
						<h1 class="entry-article__title"><?php the_title(); ?></h1>
						<p class="entry-article__meta"><?php echo esc_html( get_the_author() ); ?></p>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="container entry-article__media">
						<?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="container entry-article__content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			</article>

			<div class="container post-navigation-shell">
				<?php the_post_navigation(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php
get_footer();
