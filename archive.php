<?php
/**
 * Archive template.
 *
 * @package FlamebubblesAtelier
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="archive-hero">
		<div class="container">
			<p class="archive-hero__eyebrow"><?php esc_html_e( 'Browse', 'flamebubbles-atelier' ); ?></p>
			<h1 class="archive-hero__title"><?php the_archive_title(); ?></h1>
			<div class="archive-hero__text"><?php the_archive_description(); ?></div>
		</div>
	</section>

	<div class="container archive-grid">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'story-card' ); ?>>
					<a class="story-card__media" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
						<?php endif; ?>
					</a>

					<div class="story-card__body">
						<p class="story-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h2 class="story-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="story-card__excerpt"><?php the_excerpt(); ?></div>
					</div>
				</article>
			<?php endwhile; ?>

			<div class="pagination-shell">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<?php flamebubbles_render_empty_state( __( 'Nothing found', 'flamebubbles-atelier' ), __( 'There are no entries in this archive yet.', 'flamebubbles-atelier' ) ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
