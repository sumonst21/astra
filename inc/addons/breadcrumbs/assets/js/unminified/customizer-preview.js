/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package Astra
 * @since 1.7.0
 */

( function( $ ) {

	/* Breadcrumb Header Colors */                                                                                                                                                                                                                                                                                                                                                                                                                                                        
	astra_color_responsive_css( 'breadcrumb', 'astra-settings[breadcrumb-text-color-responsive]', 'color', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item .ast-breadcrumbs-name' );
	astra_color_responsive_css( 'breadcrumb', 'astra-settings[breadcrumb-active-color-responsive]', 'color', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name' );
	astra_color_responsive_css( 'breadcrumb', 'astra-settings[breadcrumb-hover-color-responsive]', 'color', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item > .ast-breadcrumbs-name' );
	astra_color_responsive_css( 'breadcrumb', 'astra-settings[breadcrumb-separator-color]', 'color', '.ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' );

	/* Breadcrumb Typography */                                                                                                                                                                                                                                                                                                                                                                                                                                                        
	astra_responsive_font_size('astra-settings[breadcrumb-font-size]', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator');
	astra_css( 'astra-settings[breadcrumb-font-family]', 'font-family', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' );
	astra_css( 'astra-settings[breadcrumb-font-weight]', 'font-weight', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' );
	astra_css( 'astra-settings[breadcrumb-text-transform]', 'text-transform', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' );
	astra_css( 'astra-settings[breadcrumb-line-height]', 'line-height', '.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' );

} )( jQuery );
