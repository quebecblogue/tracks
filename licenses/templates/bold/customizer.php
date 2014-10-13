<?php

/*
 * Updates customizer content for Bold template
 * called conditionally from ct_tracks_customizer_check()
 */
function ct_tracks_bold_update_customizer_content( $wp_customize ) {

	// remove all default and custom sections
	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'ct_tracks_tagline_display' );
	$wp_customize->remove_section( 'ct-upload' );
	$wp_customize->remove_section( 'ct_tracks_social_icons' );
	$wp_customize->remove_section( 'ct_tracks_search_input' );
	$wp_customize->remove_section( 'ct_tracks_post_meta_display' );
	$wp_customize->remove_section( 'ct_tracks_comments_display' );
	$wp_customize->remove_section( 'ct-footer-text' );
	$wp_customize->remove_section( 'ct-custom-css' );
	$wp_customize->remove_section( 'ct_tracks_premium_layouts' );
	$wp_customize->remove_section( 'ct_tracks_additional_options' );
	$wp_customize->remove_section( 'ct_tracks_background_image' );
	$wp_customize->remove_section( 'ct_tracks_background_texture' );
	$wp_customize->remove_section( 'ct_tracks_header_color' );
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'widgets' );
	$wp_customize->remove_panel( 'widgets' );

	/*
	 * Add Bold Template sections & controls
	 * settings in ct_tracks_bold_customizer_settings()
	 */

	/* Heading */

	// section - heading
	$wp_customize->add_section( 'ct_tracks_bold_heading', array(
		'title'      => __( 'Heading', 'tracks' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_heading_color_control', array(
			'label'           => __( 'Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_heading',
			'settings'        => 'ct_tracks_bold_heading_color_setting'
		)
	) );
	// control - font size
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_heading_size_setting', array(
			'label'           => __( 'Font Size', 'tracks' ),
			'section'         => 'ct_tracks_bold_heading',
			'settings'        => 'ct_tracks_bold_heading_size_setting',
			'type'            => 'number'
		)
	) );

	/* Sub-heading */

	// section - sub-heading
	$wp_customize->add_section( 'ct_tracks_bold_sub_heading', array(
		'title'      => __( 'Sub-heading', 'tracks' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_sub_heading_color_control', array(
			'label'           => __( 'Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_sub_heading',
			'settings'        => 'ct_tracks_bold_sub_heading_color_setting'
		)
	) );
	// control - font size
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_sub_heading_size_setting', array(
			'label'           => __( 'Font Size', 'tracks' ),
			'section'         => 'ct_tracks_bold_sub_heading',
			'settings'        => 'ct_tracks_bold_sub_heading_size_setting',
			'type'            => 'number'
		)
	) );

	/* Description */

	// section - description
	$wp_customize->add_section( 'ct_tracks_bold_description', array(
		'title'      => __( 'Description', 'tracks' ),
		'priority'   => 30,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_description_color_control', array(
			'label'           => __( 'Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_description',
			'settings'        => 'ct_tracks_bold_description_color_setting'
		)
	) );
	// control - font size
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_description_size_setting', array(
			'label'           => __( 'Font Size', 'tracks' ),
			'section'         => 'ct_tracks_bold_description',
			'settings'        => 'ct_tracks_bold_description_size_setting',
			'type'            => 'number'
		)
	) );

	/* Button 1 */

	// section - button 1
	$wp_customize->add_section( 'ct_tracks_bold_button_one', array(
		'title'      => __( 'Button 1', 'tracks' ),
		'priority'   => 40,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_one_color_control', array(
			'label'           => __( 'Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_color_setting'
		)
	) );
	// control - font size
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_one_size_setting', array(
			'label'           => __( 'Font Size', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_size_setting',
			'type'            => 'number'
		)
	) );
	// control - background color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_one_background_color_control', array(
			'label'           => __( 'Background Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_background_color_setting'
		)
	) );
	// control - background opacity
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_one_background_opacity_control', array(
			'label'           => __( 'Background Opacity', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_background_opacity_setting'
		)
	) );
	// control - border color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_one_border_color_control', array(
			'label'           => __( 'Border Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_border_color_setting'
		)
	) );
	// control - border width
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_one_border_width_control', array(
			'label'           => __( 'Border Width', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_border_width_setting'
		)
	) );
	// control - border style
	$wp_customize->add_control( new ct_tracks_Dropdown_Control(
		$wp_customize, 'ct_tracks_bold_button_one_border_style_control', array(
			'label'           => __( 'Border Style', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_one',
			'settings'        => 'ct_tracks_bold_button_one_border_style_setting',
			'choices'         => array(
				'solid' => __('Solid', 'tracks'),
				'dashed' => __('Dashed', 'tracks'),
				'dotted' => __('Dotted', 'tracks'),
				'double' => __('Double', 'tracks'),
				'groove' => __('Groove', 'tracks'),
				'ridge' => __('Ridge', 'tracks'),
				'inset' => __('Inset', 'tracks'),
				'outset' => __('Outset', 'tracks')
			)
		)
	) );

	/* Button 2 */

	// section - button 2
	$wp_customize->add_section( 'ct_tracks_bold_button_two', array(
		'title'      => __( 'Button 2', 'tracks' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_two_color_control', array(
			'label'           => __( 'Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_color_setting'
		)
	) );
	// control - font size
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_two_size_setting', array(
			'label'           => __( 'Font Size', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_size_setting',
			'type'            => 'number'
		)
	) );
	// control - background color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_two_background_color_control', array(
			'label'           => __( 'Background Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_background_color_setting'
		)
	) );
	// control - background opacity
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_two_background_opacity_control', array(
			'label'           => __( 'Background Opacity', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_background_opacity_setting'
		)
	) );
	// control - border color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_button_two_border_color_control', array(
			'label'           => __( 'Border Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_border_color_setting'
		)
	) );
	// control - border width
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_button_two_border_width_control', array(
			'label'           => __( 'Border Width', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_border_width_setting'
		)
	) );
	// control - border style
	$wp_customize->add_control( new ct_tracks_Dropdown_Control(
		$wp_customize, 'ct_tracks_bold_button_two_border_style_control', array(
			'label'           => __( 'Border Style', 'tracks' ),
			'section'         => 'ct_tracks_bold_button_two',
			'settings'        => 'ct_tracks_bold_button_two_border_style_setting',
			'choices'         => array(
				'solid' => __('Solid', 'tracks'),
				'dashed' => __('Dashed', 'tracks'),
				'dotted' => __('Dotted', 'tracks'),
				'double' => __('Double', 'tracks'),
				'groove' => __('Groove', 'tracks'),
				'ridge' => __('Ridge', 'tracks'),
				'inset' => __('Inset', 'tracks'),
				'outset' => __('Outset', 'tracks')
			)
		)
	) );

	/* Overlay */

	// section - overlay
	$wp_customize->add_section( 'ct_tracks_bold_overlay', array(
		'title'      => __( 'Overlay', 'tracks' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
	) );
	// control - color
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ct_tracks_bold_overlay_color_control', array(
			'label'           => __( 'Overlay Color', 'tracks' ),
			'section'         => 'ct_tracks_bold_overlay',
			'settings'        => 'ct_tracks_bold_overlay_color_setting'
		)
	) );
	// control - overlay opacity
	$wp_customize->add_control( new ct_tracks_number_input_control(
		$wp_customize, 'ct_tracks_bold_overlay_opacity_control', array(
			'label'           => __( 'Overlay Opacity', 'tracks' ),
			'section'         => 'ct_tracks_bold_overlay',
			'settings'        => 'ct_tracks_bold_overlay_opacity_setting'
		)
	) );

	/* Background Image */

	// section - background image
	$wp_customize->add_section( 'ct_tracks_bold_background_image', array(
		'title'      => __( 'Background Image', 'tracks' ),
		'priority'   => 70,
		'capability' => 'edit_theme_options',
	) );
	// control - position
	$wp_customize->add_control( 'ct_tracks_bold_background_position_control', array(
		'type'      => 'radio',
		'label'     => __( 'Position', 'tracks' ),
		'section'   => 'ct_tracks_bold_background_image',
		'settings'  => 'ct_tracks_bold_background_position_setting',
		'choices'   => array(
			'fill'      =>  __('Fill screen', 'tracks'),
			'fit'       =>  __('Fit to screen', 'tracks'),
			'stretch'   =>  __('Stretch to fill screen', 'tracks')
		),
	) );
	// control - effect
	$wp_customize->add_control( 'ct_tracks_bold_background_effect_control', array(
		'label'           => __( 'Background Effect', 'tracks' ),
		'section'         => 'ct_tracks_bold_background_image',
		'settings'        => 'ct_tracks_bold_background_effect_setting',
		'type'            => 'radio',
		'choices'         => array(
			'none'  =>  __('none', 'tracks'),
			'bw'    =>  __('Black & white', 'tracks'),
			'blur'  =>  __('Blur', 'tracks')
		)
	) );
}

/*
 * Bold customizer settings always loaded.
 * If loaded conditionally, settings will not save
 */
function ct_tracks_bold_customizer_settings( $wp_customize ) {

	/* Heading */

	// setting - color
	$wp_customize->add_setting( 'ct_tracks_bold_heading_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - font size
	$wp_customize->add_setting( 'ct_tracks_bold_heading_size_setting', array(
		'default'           => '48',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	/* Sub-heading */

	// setting - color
	$wp_customize->add_setting( 'ct_tracks_bold_sub_heading_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - font size
	$wp_customize->add_setting( 'ct_tracks_bold_sub_heading_size_setting', array(
		'default'           => '37',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	/* Description */

	// setting - color
	$wp_customize->add_setting( 'ct_tracks_bold_description_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - font size
	$wp_customize->add_setting( 'ct_tracks_bold_description_size_setting', array(
		'default'           => '37',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	/* Button 1 */

	// setting - color
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - font size
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_size_setting', array(
		'default'           => '13',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	// setting - background color
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_background_color_setting', array(
		'default'           => '#E59E45',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - background opacity
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_background_opacity_setting', array(
		'default'           => '0',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_float'
	) );
	// setting - border color
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_border_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - border width
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_border_width_setting', array(
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	// setting - border style
	$wp_customize->add_setting( 'ct_tracks_bold_button_one_border_style_setting', array(
		'default'           => 'solid',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_border_style'
	) );

	/* Button 2 */

	// setting - color
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - font size
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_size_setting', array(
		'default'           => '13',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	// setting - background color
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_background_color_setting', array(
		'default'           => '#E59E45',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - background opacity
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_background_opacity_setting', array(
		'default'           => '0',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_float'
	) );
	// setting - border color
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_border_color_setting', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - border width
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_border_width_setting', array(
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	// setting - border style
	$wp_customize->add_setting( 'ct_tracks_bold_button_two_border_style_setting', array(
		'default'           => 'solid',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_border_style'
	) );

	/* Overlay */

	// setting - overlay color
	$wp_customize->add_setting( 'ct_tracks_bold_overlay_color_setting', array(
		'default'           => '#222222',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	// setting - overlay opacity
	$wp_customize->add_setting( 'ct_tracks_bold_overlay_opacity_setting', array(
		'default'           => '0.6',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_float'
	) );

	/* Background Image */

	// setting - background position
	$wp_customize->add_setting( 'ct_tracks_bold_background_position_setting', array(
		'default'           => 'fill',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_background_position'
	) );
	// setting - background effect
	$wp_customize->add_setting( 'ct_tracks_bold_background_effect_setting', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ct_tracks_sanitize_background_effect'
	) );
}
add_action( 'customize_register', 'ct_tracks_bold_customizer_settings' );

/* Custom sanitization callbacks */

// sanitize float
function ct_tracks_sanitize_float( $input ) {
	return floatval( $input );
}

// sanitize border style
function ct_tracks_sanitize_border_style( $input ) {

	$valid = array(
		'solid' => __('Solid', 'tracks'),
		'dashed' => __('Dashed', 'tracks'),
		'dotted' => __('Dotted', 'tracks'),
		'double' => __('Double', 'tracks'),
		'groove' => __('Groove', 'tracks'),
		'ridge' => __('Ridge', 'tracks'),
		'inset' => __('Inset', 'tracks'),
		'outset' => __('Outset', 'tracks')
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

// sanitize background position
function ct_tracks_sanitize_background_position( $input ) {

	$valid = array(
		'fill'      =>  __('Fill screen', 'tracks'),
		'fit'       =>  __('Fit to screen', 'tracks'),
		'stretch'   =>  __('Stretch to fill screen', 'tracks')
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

// sanitize background effect
function ct_tracks_sanitize_background_effect( $input ) {

	$valid = array(
		'none'  =>  __('none', 'tracks'),
		'bw'    =>  __('Black & white', 'tracks'),
		'blur'  =>  __('Blur', 'tracks')
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}