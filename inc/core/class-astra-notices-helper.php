<?php
/**
 * Admin notices helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.7.2
 */

/**
 * Astra_Notices_Helper
 *
 * @since 1.7.2
 */
class Astra_Notices_Helper {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.4.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.4.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.4.0
	 */
	public function __construct() {
		require_once ASTRA_THEME_DIR . 'inc/lib/notices/class-astra-notices.php';
		add_action( 'admin_notices', __CLASS__ . '::register_notices' );
	}

	/**
	 * Ask Theme Rating
	 *
	 * @since 1.4.0
	 */
	public static function register_notices() {

		if ( class_exists( 'Astra_Ext_White_Label_Markup' ) ) {
			if ( ! empty( Astra_Ext_White_Label_Markup::$branding['astra']['name'] ) ) {
				return;
			}
		}

		if ( false === get_option( 'astra-theme-old-setup' ) ) {
			set_transient( 'astra-theme-first-rating', true, MONTH_IN_SECONDS );
			update_option( 'astra-theme-old-setup', true );
		} elseif ( false === get_transient( 'astra-theme-first-rating' ) ) {
			$image_path = ASTRA_THEME_URI . 'inc/assets/images/astra-logo.svg';
			Astra\Notices\Astra_Notices::add_notice(
				array(
					'id'                         => 'astra-theme-rating',
					'type'                       => '',
					'message'                    => sprintf(
						'<div class="notice-image">
							<img src="%1$s" class="custom-logo" alt="Astra" itemprop="logo"></div> 
							<div class="notice-content">
								<div class="notice-heading">
									%2$s
								</div>
								%3$s<br />
								<div class="astra-review-notice-container">
									<a href="%4$s" class="astra-notice-close astra-review-notice button-primary" target="_blank">
									%5$s
									</a>
								<span class="dashicons dashicons-calendar"></span>
									<a href="#" data-repeat-notice-after="%6$s" class="astra-notice-close astra-review-notice">
									%7$s
									</a>
								<span class="dashicons dashicons-smiley"></span>
									<a href="#" class="astra-notice-close astra-review-notice">
									%8$s
									</a>
								</div>
							</div>',
						$image_path,
						__( 'Hello! Seems like you have used Astra theme to build this website — Thanks a ton!', 'astra' ),
						__( 'Could you please do us a BIG favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the Astra theme.', 'astra' ),
						'https://wordpress.org/support/theme/astra/reviews/?filter=5#new-post',
						__( 'Ok, you deserve it', 'astra' ),
						MONTH_IN_SECONDS,
						__( 'Nope, maybe later', 'astra' ),
						__( 'I already did', 'astra' )
					),
					'repeat-notice-after'        => MONTH_IN_SECONDS,
					'priority'                   => 10,
					'display-with-other-notices' => false,
					'show_if'                    => class_exists( 'Astra_Ext_White_Label_Markup' ) ? Astra_Ext_White_Label_Markup::show_branding() : true,
				)
			);
		}

		// Force Astra welcome notice on theme activation.
		if ( current_user_can( 'install_plugins' ) && ! defined( 'ASTRA_SITES_NAME' ) && '1' == get_option( 'fresh_site' ) ) {

			wp_enqueue_script( 'astra-admin-settings' );
			$image_path           = ASTRA_THEME_URI . 'inc/assets/images/astra-logo.svg';
			$ast_sites_notice_btn = Astra_Admin_Settings::astra_sites_notice_button();

			if ( file_exists( WP_PLUGIN_DIR . '/astra-sites/astra-sites.php' ) && is_plugin_inactive( 'astra-sites/astra-sites.php' ) && is_plugin_inactive( 'astra-pro-sites/astra-pro-sites.php' ) ) {
				$ast_sites_notice_btn['button_text'] = __( 'Get Started', 'astra' );
				$ast_sites_notice_btn['class']      .= ' button button-primary button-hero';
			} elseif ( ! file_exists( WP_PLUGIN_DIR . '/astra-sites/astra-sites.php' ) && is_plugin_inactive( 'astra-pro-sites/astra-pro-sites.php' ) ) {
				$ast_sites_notice_btn['button_text'] = __( 'Get Started', 'astra' );
				$ast_sites_notice_btn['class']      .= ' button button-primary button-hero';
				// Astra Premium Sites - Active.
			} elseif ( is_plugin_active( 'astra-pro-sites/astra-pro-sites.php' ) ) {
				$ast_sites_notice_btn['class'] = ' button button-primary button-hero astra-notice-close';
			} else {
				$ast_sites_notice_btn['class'] = ' button button-primary button-hero astra-notice-close';
			}

			$astra_sites_notice_args = array(
				'id'                         => 'astra-sites-on-active',
				'type'                       => '',
				'message'                    => sprintf(
					'<div class="notice-image">
						<img src="%1$s" class="custom-logo" alt="Astra" itemprop="logo"></div> 
						<div class="notice-content">
							<h2 class="notice-heading">
								%2$s
							</h2>
							<p>%3$s</p>
							<div class="astra-review-notice-container">
								<a class="%4$s" %5$s %6$s %7$s %8$s %9$s %10$s> %11$s </a>
							</div>
						</div>',
					$image_path,
					__( 'Thank you for installing Astra!', 'astra' ),
					__( 'Did you know Astra comes with dozens of ready-to-use <a href="https://wpastra.com/ready-websites/?utm_source=install-notice">starter site templates</a>? Install the Astra Starter Sites plugin to get started.', 'astra' ),
					esc_attr( $ast_sites_notice_btn['class'] ),
					'href="' . astra_get_prop( $ast_sites_notice_btn, 'link', '' ) . '"',
					'data-slug="' . astra_get_prop( $ast_sites_notice_btn, 'data_slug', '' ) . '"',
					'data-init="' . astra_get_prop( $ast_sites_notice_btn, 'data_init', '' ) . '"',
					'data-settings-link-text="' . astra_get_prop( $ast_sites_notice_btn, 'data_settings_link_text', '' ) . '"',
					'data-settings-link="' . astra_get_prop( $ast_sites_notice_btn, 'data_settings_link', '' ) . '"',
					'data-activating-text="' . astra_get_prop( $ast_sites_notice_btn, 'activating_text', '' ) . '"',
					esc_html( $ast_sites_notice_btn['button_text'] )
				),
				'priority'                   => 5,
				'display-with-other-notices' => false,
				'show_if'                    => class_exists( 'Astra_Ext_White_Label_Markup' ) ? Astra_Ext_White_Label_Markup::show_branding() : true,
			);

			Astra\Notices\Astra_Notices::add_notice(
				$astra_sites_notice_args
			);

			// Enqueue Plugin Install script only if the notice with plugin installation is not expired.
			if ( ! Astra\Notices\Astra_Notices::is_notice_expired( $astra_sites_notice_args ) ) {
				wp_enqueue_script( 'plugin-install' );
			}
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Astra_Notices_Helper::get_instance();
