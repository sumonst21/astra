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
			add_filter( 'astra_theme_dynamic_css', array( $this, 'dynamic_css' ) );
		}

		/**
		 * Dynamic CSS used for AMP pages.
		 * This should be changed to main CSS in next versions, replacing JavaScript based interactions with pure CSS alternatives.
		 *
		 * @since x.x.x
		 * @param String $compiled_css Dynamic CSS received to  be enqueued on page.
		 *
		 * @return String Updated dynamic CSS with AMP specific changes.
		 */
		public function dynamic_css( $compiled_css ) {
			$css = array(
				'.ast-mobile-menu-buttons'                 => array(
					'text-align'              => 'right',
					'-js-display'             => 'flex',
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
					'-webkit-align-self'      => 'center',
					'-ms-flex-item-align'     => 'center',
					'align-self'              => 'center',
				),

				'.site-header .main-header-bar-wrap .site-branding' => array(
					'display'             => '-webkit-box',
					'display'             => '-webkit-flex',
					'display'             => '-moz-box',
					'display'             => '-ms-flexbox',
					'display'             => 'flex',
					'-webkit-box-flex'    => '1',
					'-webkit-flex'        => '1',
					'-moz-box-flex'       => '1',
					'-ms-flex'            => '1',
					'flex'                => '1',
					'-webkit-align-self'  => 'center',
					'-ms-flex-item-align' => 'center',
					'align-self'          => 'center',
				),

				'.ast-main-header-bar-alignment.toggle-on .main-header-bar-navigation' => array(
					'display' => 'block',
				),

				'.main-navigation'                         => array(
					'display' => 'block',
					'width'   => '100%',
				),

				'.main-header-menu > .menu-item > a'       => array(
					'padding'             => '0 20px',
					'display'             => 'inline-block',
					'width'               => '100%',
					'border-bottom-width' => '1px',
					'border-style'        => 'solid',
					'border-color'        => '#eaeaea',
				),

				'.ast-main-header-bar-alignment.toggle-on' => array(
					'display'                   => 'block',
					'width'                     => '100%',
					'-webkit-box-flex'          => '1',
					'-webkit-flex'              => 'auto',
					'-moz-box-flex'             => '1',
					'-ms-flex'                  => 'auto',
					'flex'                      => 'auto',
					'-webkit-box-ordinal-group' => '5',
					'-webkit-order'             => '4',
					'-moz-box-ordinal-group'    => '5',
					'-ms-flex-order'            => '4',
					'order'                     => '4',
				),

				'.main-header-menu .menu-item'             => array(
					'width'      => '100%',
					'text-align' => 'left',
					'border-top' => '0',
				),

				'.header-main-layout-1 .main-navigation'   => array(
					'padding' => '0',
				),

				'.main-header-bar-navigation'              => array(
					'width'  => '-webkit-calc( 100% + 40px)',
					'width'  => 'calc( 100% + 40px)',
					'margin' => '0 -20px',
				),

				'.main-header-bar .main-header-bar-navigation .main-header-menu' => array(
					'border-top-width' => '1px',
					'border-style'     => 'solid',
					'border-color'     => '#eaeaea',
				),

				'.main-header-bar .main-header-bar-navigation .page_item_has_children > .ast-menu-toggle, .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle' => array(
					'display'                 => 'inline-block',
					'position'                => 'absolute',
					'font-size'               => 'inherit',
					'top'                     => '-1px',
					'right'                   => '20px',
					'cursor'                  => 'pointer',
					'-webkit-font-smoothing'  => 'antialiased',
					'-moz-osx-font-smoothing' => 'grayscale',
					'padding'                 => '0 0.907em',
					'font-weight'             => 'normal',
					'line-height'             => 'inherit',
					'-webkit-transition'      => 'all .2s',
					'transition'              => 'all .2s',
				),

				'.main-header-bar-navigation .menu-item-has-children > a:after' => array(
					'content' => 'none',
				),

				'.main-header-bar .main-header-bar-navigation .page_item_has_children > .ast-menu-toggle::before, .main-header-bar .main-header-bar-navigation .menu-item-has-children > .ast-menu-toggle::before' => array(
					'font-weight'     => 'bold',
					'content'         => '"\e900"',
					'font-family'     => 'Astra',
					'text-decoration' => 'inherit',
					'display'         => 'inline-block',
				),

			);

			return $compiled_css . astra_parse_css( $css, '', astra_header_break_point() );
		}

		/**
		 * Add AMP attributes to the nav menu wrapper.
		 *
		 * @since x.x.x
		 * @param Array $attr HTML attributes to be added to the nav menu wrapper.
		 *
		 * @return Array updated HTML attributes.
		 */
		public function nav_menu_wrapper( $attr ) {
			$attr['[class]']         = '( astraAmpMenuExpanded ? \'ast-main-header-bar-alignment toggle-on\' : \'ast-main-header-bar-alignment\' )';
			$attr['aria-expanded']   = 'false';
			$attr['[aria-expanded]'] = '(astraAmpMenuExpanded ? \'true\' : \'false\')';

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
			$input .= ' [class]="( astraAmpSlideSearchMenuExpanded ? \'ast-search-menu-icon slide-search ast-dropdown-active\' : \'ast-search-menu-icon slide-search\' )" ';
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
