<?php
/**
 * Breadcrumbs for Astra theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2019, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra 1.7.3
 */

if ( ! class_exists( 'Astra_Breadcrumbs_Markup' ) ) {

	/**
	 * Breadcrumbs Markup Initial Setup
	 *
	 * @since 1.7.3
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

			add_action( 'wp', array( $this, 'astra_breadcumb_template' ) );
		}

		/**
		 * Astra Breadcrumbs Template
		 *
		 * Loads template based on the style option selected in options panel for Breadcrumbs.
		 *
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_breadcumb_template() {

			$breadcrumb_position = astra_get_option( 'breadcrumb-position' );

			if ( $breadcrumb_position && 'none' != $breadcrumb_position ) {
				if ( self::astra_breadcrumb_rules() ) {
					switch ( $breadcrumb_position ) {
						case 'inside-header-bottom':
							add_action( 'astra_masthead_bottom', array( $this, 'astra_inside_header_bottom_markup' ), 15 );
							break;
						case 'after-header':
							add_action( 'astra_header_after', array( $this, 'astra_after_header_markup' ), 1 );
							break;
						case 'inside-content-top':
							add_action( 'astra_entry_top', array( $this, 'astra_inside_content_top_markup' ), 1 );
							break;
					}
				}
			}
		}

		/**
		 * Inside Header Bottom Breadcrumbs Markup
		 *
		 * Loads markup for Inside Header Bottom option in panel for breadcrumbs.
		 *
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_get_breadcrumb() {
			$breadcrumb_position = astra_get_option( 'breadcrumb-position' );

			if ( $breadcrumb_position && 'none' != $breadcrumb_position ) {
				if ( self::astra_breadcrumb_rules() ) {
					switch ( $breadcrumb_position ) {
						case 'inside-header-bottom':
							$this->astra_inside_header_bottom_markup();
							break;
						case 'after-header':
							$this->astra_after_header_markup();
							break;
						case 'inside-content-top':
							$this->astra_inside_content_top_markup();
							break;
					}
				}
			}
		}

		/**
		 * Astra Breadcrumbs Rules
		 *
		 * Checks the rules defined for displaying Breadcrumb on different pages.
		 *
		 * @since 1.7.3
		 *
		 * @return boolean
		 */
		public static function astra_breadcrumb_rules() {

			// Display Breadcrumb default true.
			$display_breadcrumb = true;

			if ( is_category() && '1' == astra_get_option( 'breadcrumb-disable-categories' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_search() && '1' == astra_get_option( 'breadcrumb-disable-search' ) ) {
				$display_breadcrumb = false;
			}

			if ( ( is_archive() || is_search() || is_404() ) && '1' == astra_get_option( 'breadcrumb-disable-archive' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_page() && '1' == astra_get_option( 'breadcrumb-disable-single-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_single() && '1' == astra_get_option( 'breadcrumb-disable-single-post' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_singular() && '1' == astra_get_option( 'breadcrumb-disable-singular' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_404() && '1' == astra_get_option( 'breadcrumb-disable-404-page' ) ) {
				$display_breadcrumb = false;
			}

			return apply_filters( 'astra_is_breadcrumb', $display_breadcrumb );
		}

		/**
		 * Inside Header Bottom Breadcrumbs Markup
		 *
		 * Loads markup for Inside Header Bottom option in panel for breadcrumbs.
		 *
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_inside_header_bottom_markup() {
			?>
			<div class="ast-breadcrumbs-wrapper">
				<div class="main-header-bar-wrap">
					<div class="main-header-bar">
						<div class="ast-container">
							<div class="ast-flex main-header-container">
								<?php $this->astra_load_selected_breadcrumb(); ?>
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
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_after_header_markup() {
			?>
			<div class="ast-breadcrumbs-wrapper">
				<div class="main-header-bar-wrap">
					<div class="main-header-bar">
						<div class="ast-container">
							<div class="ast-flex main-header-container">
								<?php $this->astra_load_selected_breadcrumb(); ?>
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
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_inside_content_top_markup() {
			?>
			<div class="ast-breadcrumbs-wrapper">
				<?php $this->astra_load_selected_breadcrumb(); ?>
			</div>
			<?php
		}

		/**
		 * Get  Markup
		 *
		 * Loads markup for Inside Content Top option in panel for breadcrumbs.
		 *
		 * @since 1.7.3
		 *
		 * @return void
		 */
		public function astra_load_selected_breadcrumb() {

			$breadcrumb_source = astra_get_option( 'select-breadcrumb-source' );
			$wpseo_option      = get_option( 'wpseo_internallinks' );

			if ( $breadcrumb_source && 'yoast-seo-breadcrumbs' == $breadcrumb_source && function_exists( 'yoast_breadcrumb' ) && $wpseo_option && true === $wpseo_option['breadcrumbs-enable'] ) {
				// Check if breadcrumb is turned on from WPSEO option.
				yoast_breadcrumb( '<div id="ast-breadcrumbs-yoast" >', '</div>' );
			} elseif ( $breadcrumb_source && 'breadcrumb-navxt' == $breadcrumb_source && function_exists( 'bcn_display' ) ) {
				// Check if breadcrumb is turned on from Breadcrumb NavXT plugin.
				?>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
				</div>
				<?php
			} elseif ( $breadcrumb_source && 'rank-math' == $breadcrumb_source && function_exists( 'rank_math_the_breadcrumbs' ) ) {
				rank_math_the_breadcrumbs();
			} else {
				// Load default Astra breadcrumb if none selected.
				$get_markup = new Astra_Breadcrumbs;
				$get_markup->astra_breadcrumb();
			}
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Astra_Breadcrumbs_Markup::get_instance();
