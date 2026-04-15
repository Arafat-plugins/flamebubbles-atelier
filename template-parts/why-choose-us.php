<?php
/**
 * Why choose us section.
 *
 * @package FlamebubblesAtelier
 */

$pillars = array(
	array(
		'label' => flamebubbles_get_theme_option( 'why_card_1_title' ),
		'text'  => flamebubbles_get_theme_option( 'why_card_1_text' ),
	),
	array(
		'label' => flamebubbles_get_theme_option( 'why_card_2_title' ),
		'text'  => flamebubbles_get_theme_option( 'why_card_2_text' ),
	),
	array(
		'label' => flamebubbles_get_theme_option( 'why_card_3_title' ),
		'text'  => flamebubbles_get_theme_option( 'why_card_3_text' ),
	),
	array(
		'label' => flamebubbles_get_theme_option( 'why_card_4_title' ),
		'text'  => flamebubbles_get_theme_option( 'why_card_4_text' ),
	),
);
?>

<section class="section section--contrast">
	<div class="container">
		<?php
		flamebubbles_render_section_heading(
			flamebubbles_get_theme_option( 'why_eyebrow' ),
			flamebubbles_get_theme_option( 'why_title' ),
			flamebubbles_get_theme_option( 'why_description' )
		);
		?>

		<div class="value-grid">
			<?php foreach ( $pillars as $index => $pillar ) : ?>
				<article class="value-card">
					<span class="value-card__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
					<h3 class="value-card__title"><?php echo esc_html( $pillar['label'] ); ?></h3>
					<p class="value-card__text"><?php echo esc_html( $pillar['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
