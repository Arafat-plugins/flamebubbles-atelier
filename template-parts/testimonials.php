<?php
/**
 * Testimonials section.
 *
 * @package FlamebubblesAtelier
 */

$testimonials = array(
	array(
		'quote'  => flamebubbles_get_theme_option( 'testimonial_1_quote' ),
		'name'   => flamebubbles_get_theme_option( 'testimonial_1_name' ),
		'role'   => flamebubbles_get_theme_option( 'testimonial_1_role' ),
	),
	array(
		'quote'  => flamebubbles_get_theme_option( 'testimonial_2_quote' ),
		'name'   => flamebubbles_get_theme_option( 'testimonial_2_name' ),
		'role'   => flamebubbles_get_theme_option( 'testimonial_2_role' ),
	),
	array(
		'quote'  => flamebubbles_get_theme_option( 'testimonial_3_quote' ),
		'name'   => flamebubbles_get_theme_option( 'testimonial_3_name' ),
		'role'   => flamebubbles_get_theme_option( 'testimonial_3_role' ),
	),
);
?>

<section class="section">
	<div class="container">
		<?php
		flamebubbles_render_section_heading(
			flamebubbles_get_theme_option( 'testimonials_eyebrow' ),
			flamebubbles_get_theme_option( 'testimonials_title' ),
			flamebubbles_get_theme_option( 'testimonials_description' )
		);
		?>

		<div class="testimonial-grid">
			<?php foreach ( $testimonials as $testimonial ) : ?>
				<blockquote class="testimonial-card">
					<p class="testimonial-card__quote">&ldquo;<?php echo esc_html( $testimonial['quote'] ); ?>&rdquo;</p>
					<footer class="testimonial-card__footer">
						<strong><?php echo esc_html( $testimonial['name'] ); ?></strong>
						<span><?php echo esc_html( $testimonial['role'] ); ?></span>
					</footer>
				</blockquote>
			<?php endforeach; ?>
		</div>
	</div>
</section>
