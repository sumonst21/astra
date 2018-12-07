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
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_filter( 'astra_nav_data_attrs', array( $this, 'add_nav_attrs' ) );
			add_filter( 'astra_nav_toggle_data_attrs', array( $this, 'add_nav_toggle_attrs' ) );
			add_filter( 'astra_caret_wrap_filter', array( $this, 'amp_dropdowns' ), 10, 2 );
			add_action( 'wp_head', array( $this, 'render_amp_states' ) );
		}

		/**
		 * Add amp states to the dom.
		 */
		public function render_amp_states() {
			if ( ! astra_is_emp_endpoint() ) {
				return;
			}
			echo '<amp-state id="astraAmpMenuExpanded">';
			echo '<script type="application/json">false</script>';
			echo '</amp-state>';
		}

		/**
		 * Add navigation data attributes.
		 *
		 * @param string $input the data attrs already existing in the nav.
		 *
		 * @return string
		 */
		public function add_nav_attrs( $input ) {
			
			if ( ! astra_is_emp_endpoint() ) {
				return $input;
			}

			$input .= ' [class]="( astraAmpMenuExpanded ? \'main-header-bar-navigation responsive-opened\' : \'astra-navbar\' )" ';
			$input .= ' aria-expanded="false" [aria-expanded]="astraAmpMenuExpanded ? \'true\' : \'false\'" ';
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
			if ( ! astra_is_emp_endpoint() ) {
				return $input;
			}
			$input .= ' on="tap:AMP.setState( { astraAmpMenuExpanded: ! astraAmpMenuExpanded } )" ';
			$input .= ' [class]="\'menu-toggle main-header-menu-toggle  ast-mobile-menu-buttons-minimal\' + ( astraAmpMenuExpanded ? \' active\' : \'\' )" ';
			$input .= ' aria-expanded="false" ';
			$input .= ' [aria-expanded]="astraAmpMenuExpanded ? \'true\' : \'false\'" ';
			return $input;
		}

		/**
		 * Implement AMP integration on drop-downs.
		 *
		 * @param string $output the output.
		 * @param string $id     menu item order.
		 *
		 * @return mixed
		 */
		public function amp_dropdowns( $output, $id ) {
			// Bail if not AMP.
			if ( ! astra_is_emp_endpoint() ) {
				return $output;
			}
			// Generate a unique id for drop-down items.
			$state  = 'astraMenuItemExpanded' . $id;
			$attrs  = '';
			$attrs .= ' class="caret-wrap"';
			$attrs .= ' [class]="\'caret-wrap\' + ( ' . $state . ' ? \' caret-dropdown-open\' : \'\')" ';
			$attrs .= ' on="tap:AMP.setState( { ' . $state . ': ! ' . $state . ' } )"';
			$attrs .= ' aria-expanded="false" ';
			$attrs .= ' [aria-expanded]="' . $state . ' ? \'true\' : \'false\'" ';
			$output = str_replace( 'class="caret-wrap ' . $id . '"', $attrs, $output );
			$output = str_replace( '</li>', '<amp-state id="' . $state . '"><script type="application/json">false</script></amp-state></li>', $output );
			return $output;
		}
	}
endif;

/**
* Kicking this off by calling 'get_instance()' method
*/
Astra_AMP::get_instance();
