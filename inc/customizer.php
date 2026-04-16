<?php
/**
 * Theme Customizer registration.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize checkbox values.
 *
 * @param mixed $checked Value to sanitize.
 * @return bool
 */
function flamebubbles_sanitize_checkbox( $checked ) {
	return (bool) $checked;
}

/**
 * Register Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function flamebubbles_customize_register( $wp_customize ) {
	$defaults = flamebubbles_get_theme_defaults();

	$wp_customize->add_panel(
		'flamebubbles_theme_options',
		array(
			'title'       => __( 'Theme Options', 'flamebubbles-atelier' ),
			'description' => __( 'Edit the static landing-page content and storefront support copy from one place.', 'flamebubbles-atelier' ),
			'priority'    => 35,
		)
	);

	$sections = array(
		'flamebubbles_header'          => __( 'Home Header', 'flamebubbles-atelier' ),
		'flamebubbles_hero'            => __( 'Hero Section', 'flamebubbles-atelier' ),
		'flamebubbles_featured_slider' => __( 'Featured Slider', 'flamebubbles-atelier' ),
		'flamebubbles_category_grid'   => __( 'Category Mosaic', 'flamebubbles-atelier' ),
		'flamebubbles_latest'          => __( 'Latest Products', 'flamebubbles-atelier' ),
		'flamebubbles_collections'   => __( 'Collection Sections', 'flamebubbles-atelier' ),
		'flamebubbles_why'           => __( 'Why Choose Us', 'flamebubbles-atelier' ),
		'flamebubbles_testimonials'  => __( 'Testimonials', 'flamebubbles-atelier' ),
		'flamebubbles_gallery'       => __( 'Gallery', 'flamebubbles-atelier' ),
		'flamebubbles_footer'        => __( 'Footer', 'flamebubbles-atelier' ),
	);

	foreach ( $sections as $section_id => $title ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title' => $title,
				'panel' => 'flamebubbles_theme_options',
			)
		);
	}

	$fields = array(
		array(
			'section'  => 'flamebubbles_header',
			'settings' => array(
				array(
					'id'       => 'home_show_primary_nav',
					'label'    => __( 'Show Primary Menu On Home Header', 'flamebubbles-atelier' ),
					'type'     => 'checkbox',
					'default'  => $defaults['home_show_primary_nav'],
					'sanitize' => 'flamebubbles_sanitize_checkbox',
				),
				array(
					'id'       => 'home_action_one_label',
					'label'    => __( 'Header Button One Label', 'flamebubbles-atelier' ),
					'type'     => 'text',
					'default'  => $defaults['home_action_one_label'],
					'sanitize' => 'sanitize_text_field',
				),
				array(
					'id'       => 'home_action_one_url',
					'label'    => __( 'Header Button One URL', 'flamebubbles-atelier' ),
					'type'     => 'url',
					'default'  => $defaults['home_action_one_url'],
					'sanitize' => 'esc_url_raw',
				),
				array(
					'id'       => 'home_action_two_label',
					'label'    => __( 'Header Button Two Label', 'flamebubbles-atelier' ),
					'type'     => 'text',
					'default'  => $defaults['home_action_two_label'],
					'sanitize' => 'sanitize_text_field',
				),
				array(
					'id'       => 'home_action_two_url',
					'label'    => __( 'Header Button Two URL', 'flamebubbles-atelier' ),
					'type'     => 'url',
					'default'  => $defaults['home_action_two_url'],
					'sanitize' => 'esc_url_raw',
				),
			),
		),
		array(
			'section'  => 'flamebubbles_hero',
			'settings' => array(
				array( 'id' => 'hero_eyebrow', 'label' => __( 'Hero Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_title_line_one', 'label' => __( 'Hero Title Line One', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_title_line_one'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_title_line_two', 'label' => __( 'Hero Title Line Two', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_title_line_two'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_description', 'label' => __( 'Hero Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['hero_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'hero_primary_label', 'label' => __( 'Primary Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_primary_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_primary_url', 'label' => __( 'Primary Button URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['hero_primary_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'hero_secondary_label', 'label' => __( 'Secondary Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_secondary_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_secondary_url', 'label' => __( 'Secondary Button URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['hero_secondary_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'hero_partner_1', 'label' => __( 'Partner Label 1', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_partner_1'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_partner_2', 'label' => __( 'Partner Label 2', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_partner_2'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_partner_3', 'label' => __( 'Partner Label 3', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_partner_3'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_partner_4', 'label' => __( 'Partner Label 4', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_partner_4'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_1_title', 'label' => __( 'Proof Chip 1 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_1_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_1_text', 'label' => __( 'Proof Chip 1 Text', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_1_text'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_2_title', 'label' => __( 'Proof Chip 2 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_2_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_2_text', 'label' => __( 'Proof Chip 2 Text', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_2_text'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_3_title', 'label' => __( 'Proof Chip 3 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_3_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_proof_3_text', 'label' => __( 'Proof Chip 3 Text', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_proof_3_text'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_watermark', 'label' => __( 'Hero Watermark Text', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_watermark'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_empty_title', 'label' => __( 'Hero Empty-State Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hero_empty_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hero_empty_text', 'label' => __( 'Hero Empty-State Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['hero_empty_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_featured_slider',
			'settings' => array(
				array( 'id' => 'fs_eyebrow', 'label' => __( 'Section Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['fs_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'fs_title', 'label' => __( 'Section Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['fs_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'fs_label', 'label' => __( 'View All Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['fs_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'fs_url', 'label' => __( 'View All Button URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => '', 'sanitize' => 'esc_url_raw' ),
			),
		),
		array(
			'section'  => 'flamebubbles_category_grid',
			'settings' => array(
				array( 'id' => 'category_board_brand', 'label' => __( 'Board Brand Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['category_board_brand'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'category_board_action_1_label', 'label' => __( 'Board Button One Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['category_board_action_1_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'category_board_action_1_url', 'label' => __( 'Board Button One URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['category_board_action_1_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'category_board_action_2_label', 'label' => __( 'Board Button Two Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['category_board_action_2_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'category_board_action_2_url', 'label' => __( 'Board Button Two URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['category_board_action_2_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'category_empty_title', 'label' => __( 'Grid Empty-State Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['category_empty_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'category_empty_text', 'label' => __( 'Grid Empty-State Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['category_empty_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_latest',
			'settings' => array(
				array( 'id' => 'latest_eyebrow', 'label' => __( 'Section Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['latest_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'latest_title', 'label' => __( 'Section Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['latest_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'latest_description', 'label' => __( 'Section Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['latest_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'latest_button_label', 'label' => __( 'Section Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['latest_button_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'latest_empty_title', 'label' => __( 'Empty-State Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['latest_empty_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'latest_empty_text', 'label' => __( 'Empty-State Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['latest_empty_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_collections',
			'settings' => array(
				array( 'id' => 'hand_stitch_eyebrow', 'label' => __( 'Hand Stitch Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_title', 'label' => __( 'Hand Stitch Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_description', 'label' => __( 'Hand Stitch Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['hand_stitch_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'hand_stitch_link_label', 'label' => __( 'Hand Stitch Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_link_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_intro', 'label' => __( 'Hand Stitch Intro Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['hand_stitch_intro'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'hand_stitch_panel_title', 'label' => __( 'Hand Stitch Panel Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_panel_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_panel_1', 'label' => __( 'Hand Stitch Panel Item 1', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_panel_1'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_panel_2', 'label' => __( 'Hand Stitch Panel Item 2', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_panel_2'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_panel_3', 'label' => __( 'Hand Stitch Panel Item 3', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_panel_3'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_eyebrow', 'label' => __( 'Women Collection Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_title', 'label' => __( 'Women Collection Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_description', 'label' => __( 'Women Collection Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['women_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'women_link_label', 'label' => __( 'Women Collection Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_link_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_story_text', 'label' => __( 'Women Story Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['women_story_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'women_story_item_1', 'label' => __( 'Women Story Item 1', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_story_item_1'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_story_item_2', 'label' => __( 'Women Story Item 2', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_story_item_2'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'women_story_item_3', 'label' => __( 'Women Story Item 3', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['women_story_item_3'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_eyebrow', 'label' => __( 'Men Collection Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_title', 'label' => __( 'Men Collection Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_description', 'label' => __( 'Men Collection Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['men_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'men_link_label', 'label' => __( 'Men Collection Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_link_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_story_text', 'label' => __( 'Men Story Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['men_story_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'men_story_item_1', 'label' => __( 'Men Story Item 1', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_story_item_1'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_story_item_2', 'label' => __( 'Men Story Item 2', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_story_item_2'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'men_story_item_3', 'label' => __( 'Men Story Item 3', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['men_story_item_3'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_empty_title', 'label' => __( 'Hand Stitch Empty-State Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['hand_stitch_empty_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'hand_stitch_empty_text', 'label' => __( 'Hand Stitch Empty-State Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['hand_stitch_empty_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_why',
			'settings' => array(
				array( 'id' => 'why_eyebrow', 'label' => __( 'Section Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_title', 'label' => __( 'Section Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_description', 'label' => __( 'Section Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['why_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'why_card_1_title', 'label' => __( 'Card 1 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_card_1_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_card_1_text', 'label' => __( 'Card 1 Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['why_card_1_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'why_card_2_title', 'label' => __( 'Card 2 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_card_2_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_card_2_text', 'label' => __( 'Card 2 Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['why_card_2_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'why_card_3_title', 'label' => __( 'Card 3 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_card_3_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_card_3_text', 'label' => __( 'Card 3 Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['why_card_3_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'why_card_4_title', 'label' => __( 'Card 4 Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['why_card_4_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'why_card_4_text', 'label' => __( 'Card 4 Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['why_card_4_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_testimonials',
			'settings' => array(
				array( 'id' => 'testimonials_eyebrow', 'label' => __( 'Section Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonials_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonials_title', 'label' => __( 'Section Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonials_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonials_description', 'label' => __( 'Section Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['testimonials_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'testimonial_1_quote', 'label' => __( 'Testimonial 1 Quote', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['testimonial_1_quote'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'testimonial_1_name', 'label' => __( 'Testimonial 1 Name', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_1_name'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonial_1_role', 'label' => __( 'Testimonial 1 Role', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_1_role'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonial_2_quote', 'label' => __( 'Testimonial 2 Quote', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['testimonial_2_quote'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'testimonial_2_name', 'label' => __( 'Testimonial 2 Name', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_2_name'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonial_2_role', 'label' => __( 'Testimonial 2 Role', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_2_role'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonial_3_quote', 'label' => __( 'Testimonial 3 Quote', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['testimonial_3_quote'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'testimonial_3_name', 'label' => __( 'Testimonial 3 Name', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_3_name'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'testimonial_3_role', 'label' => __( 'Testimonial 3 Role', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['testimonial_3_role'], 'sanitize' => 'sanitize_text_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_gallery',
			'settings' => array(
				array( 'id' => 'gallery_eyebrow', 'label' => __( 'Section Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['gallery_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'gallery_title', 'label' => __( 'Section Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['gallery_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'gallery_description', 'label' => __( 'Section Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['gallery_description'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'gallery_button_label', 'label' => __( 'Section Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['gallery_button_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'gallery_empty_title', 'label' => __( 'Empty-State Title', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['gallery_empty_title'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'gallery_empty_text', 'label' => __( 'Empty-State Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['gallery_empty_text'], 'sanitize' => 'sanitize_textarea_field' ),
			),
		),
		array(
			'section'  => 'flamebubbles_footer',
			'settings' => array(
				array( 'id' => 'footer_eyebrow', 'label' => __( 'Footer Eyebrow', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_eyebrow'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_text', 'label' => __( 'Footer Description', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['footer_text'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'footer_primary_label', 'label' => __( 'Footer Primary Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_primary_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_primary_url', 'label' => __( 'Footer Primary Button URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['footer_primary_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'footer_secondary_label', 'label' => __( 'Footer Secondary Button Label', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_secondary_label'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_secondary_url', 'label' => __( 'Footer Secondary Button URL', 'flamebubbles-atelier' ), 'type' => 'url', 'default' => $defaults['footer_secondary_url'], 'sanitize' => 'esc_url_raw' ),
				array( 'id' => 'footer_nav_heading', 'label' => __( 'Footer Navigation Heading', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_nav_heading'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_collections_heading', 'label' => __( 'Footer Collections Heading', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_collections_heading'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_notes_heading', 'label' => __( 'Footer Notes Heading', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_notes_heading'], 'sanitize' => 'sanitize_text_field' ),
				array( 'id' => 'footer_widget_fallback', 'label' => __( 'Footer Notes Fallback Text', 'flamebubbles-atelier' ), 'type' => 'textarea', 'default' => $defaults['footer_widget_fallback'], 'sanitize' => 'sanitize_textarea_field' ),
				array( 'id' => 'footer_bottom_text', 'label' => __( 'Footer Bottom Text', 'flamebubbles-atelier' ), 'type' => 'text', 'default' => $defaults['footer_bottom_text'], 'sanitize' => 'sanitize_text_field' ),
			),
		),
	);

	foreach ( $fields as $group ) {
		foreach ( $group['settings'] as $field ) {
			$wp_customize->add_setting(
				$field['id'],
				array(
					'default'           => $field['default'],
					'sanitize_callback' => $field['sanitize'],
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				$field['id'],
				array(
					'label'   => $field['label'],
					'section' => $group['section'],
					'type'    => $field['type'],
				)
			);
		}
	}
}
add_action( 'customize_register', 'flamebubbles_customize_register' );
