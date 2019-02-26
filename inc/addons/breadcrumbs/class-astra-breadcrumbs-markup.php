<?php
/**
 * Breadcrumbs for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.7.0
 */

if ( ! class_exists( 'Astra_Breadcrumbs_Markup' ) ) {

	/**
	 * Breadcrumbs Markup Initial Setup
	 *
	 * @since 1.7.0
	 */
	class Astra_Breadcrumbs_Markup {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'after_setup_theme', array( $this, 'astra_breadcumb_template' ) );
		}

		/**
		 * Astra Breadcrumbs Template
		 *
		 * Loads template based on the style option selected in options panel for Breadcrumbs.
		 *
		 * @since 1.7.0
		 *
		 * @return void
		 */
		public function astra_breadcumb_template() {

			$breadcrumb_position = astra_get_option( 'breadcrumb-position' );

			if ( $breadcrumb_position && 'none' != $breadcrumb_position ) {
				switch ( $breadcrumb_position ) {
					case 'inside-header-bottom':
						add_action( 'astra_masthead_bottom', array( $this, 'astra_inside_header_bottom_markup' ), 15 );
						break;
					case 'after-header':
						add_action( 'astra_header_after', array( $this, 'astra_after_header_markup' ), 1 );
						break;
					case 'inside-content-top':
						add_action( 'astra_content_top', array( $this, 'astra_inside_content_top_markup' ), 1 );
						break;
				}
			}
		}

		/**
		 * Inside Header Bottom Breadcrumbs Markup
		 *
		 * Loads markup for Inside Header Bottom option in panel for breadcrumbs.
		 *
		 * @since 1.7.0
		 *
		 * @return void
		 */
		public function astra_inside_header_bottom_markup() {
			?>
			<div class="ast-breadcrumbs">
				<div class="main-header-bar-wrap">
					<div class="main-header-bar">
						<div class="ast-container">
							<div class="ast-flex main-header-container">
								<?php
									// Check if breadcrumb is turned on from WPSEO option.
									$wpseo_option = get_option( 'wpseo_internallinks' );

								if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_option && true === $wpseo_option['breadcrumbs-enable'] ) {
									yoast_breadcrumb( '<div id="ast-breadcrumbs-yoast" >', '</div>' );
								} else {
									Astra_Breadcrumbs::astra_breadcrumb();
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * After Header Breadcrumbs Markup
		 *
		 * Loads markup for After Header option in panel for breadcrumbs.
		 *
		 * @since 1.7.0
		 *
		 * @return void
		 */
		public function astra_after_header_markup() {
			?>
			<div class="ast-breadcrumbs">
				<div class="main-header-bar-wrap">
					<div class="main-header-bar">
						<div class="ast-container">
							<div class="ast-flex main-header-container">
								<?php
									// Check if breadcrumb is turned on from WPSEO option.
									$wpseo_option = get_option( 'wpseo_internallinks' );

								if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_option && true === $wpseo_option['breadcrumbs-enable'] ) {
									yoast_breadcrumb( '<div id="ast-breadcrumbs-yoast" >', '</div>' );
								} else {
									Astra_Breadcrumbs::astra_breadcrumb();
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Inside Content Top Breadcrumbs Markup
		 *
		 * Loads markup for Inside Content Top option in panel for breadcrumbs.
		 *
		 * @since 1.7.0
		 *
		 * @return void
		 */
		public function astra_inside_content_top_markup() {
			?>
			<div class="ast-breadcrumbs">
				<?php
				// Check if breadcrumb is turned on from WPSEO option.
				$wpseo_option = get_option( 'wpseo_internallinks' );

				if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_option && true === $wpseo_option['breadcrumbs-enable'] ) {
					yoast_breadcrumb( '<div id="ast-breadcrumbs-yoast" >', '</div>' );
				} else {
					Astra_Breadcrumbs::astra_breadcrumb();
				}
				?>
			</div>
			<?php
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Breadcrumbs_Markup::get_instance();
