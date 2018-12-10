<?php
/**
 * AMP Compatibility.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

/**
 * Astra BB Ultimate Addon Compatibility
 */
if ( ! class_exists( 'Astra_AMP' ) ) :

	/**
	 * Class Astra_AMP
	 */
	class Astra_AMP {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'parse_query', array( $this, 'astra_amp_init' ) );
		}

		/**
		 * Init Astra Amp Compatibility.
		 * This adds required actions and filters only if AMP endpoinnt is detected.
		 *
		 * @since x.x.x
		 * @return void
		 */
		public function astra_amp_init() {

			// bail if AMP endpoint is not detected.
			if ( ! astra_is_emp_endpoint() ) {
				return;
			}

			add_filter( 'astra_nav_toggle_data_attrs', array( $this, 'add_nav_toggle_attrs' ) );
			add_filter( 'astra_search_slide_toggle_data_attrs', array( $this, 'add_search_slide_toggle_attrs' ) );
			add_action( 'wp_head', array( $this, 'render_amp_states' ) );
			add_filter( 'astra_attr_ast-main-header-bar-alignment', array( $this, 'nav_menu_wrapper' ) );
		}

		/**
		 * Add AMP attributes to the nav menu wrapper.
		 *
		 * @param [type] $attr
		 * @return void
		 */
		public function nav_menu_wrapper( $attr ) {
			$attr['[class]']         = '( astraAmpMenuExpanded ? \'toggle-on\' : \'\' )';
			$attr['aria-expanded']   = 'false';
			$attr['[aria-expanded]'] = "astraAmpMenuExpanded ? \'true\' : \'false\'";

			return $attr;
		}

		/**
		 * Add amp states to the dom.
		 */
		public function render_amp_states() {
			echo '<amp-state id="astraAmpMenuExpanded">';
			echo '<script type="application/json">false</script>';
			echo '</amp-state>';
		}

		/**
		 * Add search slide data attributes.
		 *
		 * @param string $input the data attrs already existing in the nav.
		 *
		 * @return string
		 */
		public function add_search_slide_toggle_attrs( $input ) {
			$input .= ' on="tap:AMP.setState( { astraAmpSlideSearchMenuExpanded: ! astraAmpSlideSearchMenuExpanded } )" ';
			$input .= ' [class]="( astraAmpSlideSearchMenuExpanded ? \'ast-search-menu-icon slide-search \' : \'ast-search-menu-icon slide-search ast-dropdown-active\' )" ';
			$input .= ' aria-expanded="false" [aria-expanded]="astraAmpSlideSearchMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}

		/**
		 * Add the nav toggle data attributes.
		 *
		 * @param string $input the data attrs already existing in nav toggle.
		 *
		 * @return string
		 */
		public function add_nav_toggle_attrs( $input ) {
			$input .= ' on="tap:AMP.setState( { astraAmpMenuExpanded: ! astraAmpMenuExpanded } )" ';
			$input .= ' [class]="\'menu-toggle main-header-menu-toggle  ast-mobile-menu-buttons-minimal\' + ( astraAmpMenuExpanded ? \' active\' : \'\' )" ';
			$input .= ' aria-expanded="false" ';
			$input .= ' [aria-expanded]="astraAmpMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}

	}
endif;

/**
* Kicking this off by calling 'get_instance()' method
*/
Astra_AMP::get_instance();
