<?php
/**
 * Styling Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.15
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Single_Typo_Configs' ) ) {

	/**
	 * Customizer Single Typography Configurations.
	 *
	 * @since 1.4.3
	 */
	class Astra_Single_Typo_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Single Typography configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[divider-section-single-post-typo]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-blog-single',
					'priority' => 13,
					'title'    => __( 'Typography', 'astra-addon' ),
					'settings' => array(),
				),

				array(
					'name'      => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'type'      => 'control',
					'priority'  => 13,
					'control'   => 'ast-settings-group',
					'title'     => __( 'Single Post / Page Title', 'astra-addon' ),
					'section'   => 'section-blog-single',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Single Post / Page Title Font Size
				 */
				array(
					'name'        => 'font-size-entry-title',
					'parent'      => ASTRA_THEME_SETTINGS . '[blog-single-title-typo]',
					'type'        => 'control',
					'control'     => 'ast-responsive',
					'default'     => astra_get_option( 'font-size-entry-title' ),
					'transport'   => 'postMessage',
					'priority'    => 10,
					'title'       => __( 'Font Size', 'astra' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Astra_Single_Typo_Configs;


