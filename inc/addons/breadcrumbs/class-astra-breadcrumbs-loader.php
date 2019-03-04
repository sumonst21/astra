<?php
/**
 * Breadcrumbs Loader for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.7.0
 */

if ( ! class_exists( 'Astra_Breadcrumbs_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.7.0
	 */
	class Astra_Breadcrumbs_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );

		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function customize_register( $wp_customize ) {

			/**
			 * Register Panel & Sections
			 */
			require_once ASTRA_THEME_BREADCRUMBS_DIR . 'customizer/class-astra-breadcrumbs-configs.php';
			require_once ASTRA_THEME_BREADCRUMBS_DIR . 'customizer/class-astra-breadcrumbs-color-configs.php';
			require_once ASTRA_THEME_BREADCRUMBS_DIR . 'customizer/class-astra-breadcrumbs-typo-configs.php';

		}

		/**
		 * Customizer Preview
		 */
		function preview_scripts() {
			wp_enqueue_script( 'astra-breadcrumbs-customizer-preview-js', ASTRA_THEME_BREADCRUMBS_URI . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_THEME_VERSION, true );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Breadcrumbs_Loader::get_instance();
