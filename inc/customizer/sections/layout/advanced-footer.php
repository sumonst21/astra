<?php
/**
 * Bottom Footer Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0.12
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Option: Footer Widget Tabs
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[footer-widget-tabs]', array(
			'default' => 'layout',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		new Astra_Control_Radio_Tabs(
			$wp_customize, ASTRA_THEME_SETTINGS . '[footer-widget-tabs]', array(
				'type'     => 'ast-radio-tabs',
				'label'    => __( 'Footer Widget Tabs', 'astra' ),
				'section'  => 'section-footer-adv',
				'priority' => 0,
				'choices'  => apply_filters( 'astra_customizer_footer_widget_tabs', array(
					'layout'     => array(
						ASTRA_THEME_SETTINGS . '[footer-adv]'
					),
					'colors'     => array(
						ASTRA_THEME_SETTINGS . '[footer-color]',
						ASTRA_THEME_SETTINGS . '[footer-link-color]',
						ASTRA_THEME_SETTINGS . '[footer-link-h-color]',
						ASTRA_THEME_SETTINGS . '[footer-bg-color]',
					),
					'typography' => array(),
				) ),
			)
		)
	);

	/**
	 * Option: Footer Widgets Layout Layout
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[footer-adv]', array(
			'default'           => astra_get_option( 'footer-adv' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Astra_Control_Radio_Image(
			$wp_customize, ASTRA_THEME_SETTINGS . '[footer-adv]', array(
				'type'    => 'ast-radio-image',
				'label'   => __( 'Footer Widgets Layout', 'astra' ),
				'section' => 'section-footer-adv',
				'choices' => array(
					'disabled' => array(
						'label' => __( 'Disable', 'astra' ),
						'path'  => ASTRA_THEME_URI . '/assets/images/no-adv-footer-115x48.png',
					),
					'layout-4' => array(
						'label' => __( 'Layout 4', 'astra' ),
						'path'  => ASTRA_THEME_URI . '/assets/images/layout-4-115x48.png',
					),
				),
			)
		)
	);
