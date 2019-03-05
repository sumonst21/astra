<?php
/**
 * Breadcrumbs - Dynamic CSS
 *
 * @package Astra
 */

/**
 * Breadcrumbs
 */
add_filter( 'wp_enqueue_scripts', 'astra_breadcrumb_section_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Breadcrumb.
 *
 * @since 1.7.0
 */
function astra_breadcrumb_section_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$breadcrumb_position = astra_get_option( 'breadcrumb-position' );

	if ( 'none' === $breadcrumb_position ) {
		return $dynamic_css;
	}

	/**
	 * Set CSS Params
	 */

	$breadcrumb_text_color      = astra_get_option( 'breadcrumb-text-color-responsive' );
	$breadcrumb_active_color    = astra_get_option( 'breadcrumb-active-color-responsive' );
	$breadcrumb_hover_color     = astra_get_option( 'breadcrumb-hover-color-responsive' );
	$breadcrumb_separator_color = astra_get_option( 'breadcrumb-separator-color' );

	$breadcrumb_font_family    = astra_get_option( 'breadcrumb-font-family' );
	$breadcrumb_font_weight    = astra_get_option( 'breadcrumb-font-weight' );
	$breadcrumb_font_size      = astra_get_option( 'breadcrumb-font-size' );
	$breadcrumb_line_height    = astra_get_option( 'breadcrumb-line-height' );
	$breadcrumb_text_transform = astra_get_option( 'breadcrumb-text-transform' );

	/**
	 * Generate Dynamic CSS
	 */

	$css = '';

	/**
	 * Breadcrumb Colors & Typography
	 */

	$breadcrumbs_desktop = array(
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_text_color['desktop'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name'       => array(
			'color' => esc_attr( $breadcrumb_active_color['desktop'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item > .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_hover_color['desktop'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'color' => esc_attr( $breadcrumb_separator_color['desktop'] ),
		),

		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'font-family'    => astra_get_font_family( $breadcrumb_font_family ),
			'font-weight'    => esc_attr( $breadcrumb_font_weight ),
			'font-size'      => astra_responsive_font( $breadcrumb_font_size, 'desktop' ),
			'line-height'    => esc_attr( $breadcrumb_line_height ),
			'text-transform' => esc_attr( $breadcrumb_text_transform ),
		),
	);

	$css .= astra_parse_css( $breadcrumbs_desktop );

	// Tablet Breadcrumb Colors & Typography.
	$breadcrumbs_tablet = array(
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_text_color['tablet'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name'       => array(
			'color' => esc_attr( $breadcrumb_active_color['tablet'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item > .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_hover_color['tablet'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'color' => esc_attr( $breadcrumb_separator_color['tablet'] ),
		),

		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'font-size' => astra_responsive_font( $breadcrumb_font_size, 'tablet' ),
		),
	);

	$css .= astra_parse_css( $breadcrumbs_tablet, '', '768' );

	// Mobile Breadcrumb Colors & Typography.
	$breadcrumbs_mobile = array(
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_text_color['mobile'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name'       => array(
			'color' => esc_attr( $breadcrumb_active_color['mobile'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs-link-wrap:hover > .ast-breadcrumbs-item > .ast-breadcrumbs-name' => array(
			'color' => esc_attr( $breadcrumb_hover_color['mobile'] ),
		),
		'.ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'color' => esc_attr( $breadcrumb_separator_color['mobile'] ),
		),

		'.ast-breadcrumbs-wrapper .ast-breadcrumbs-name, .ast-breadcrumbs-wrapper .ast-breadcrumbs-item, .ast-breadcrumbs-wrapper .ast-breadcrumbs .separator' => array(
			'font-size' => astra_responsive_font( $breadcrumb_font_size, 'mobile' ),
		),
	);

	$css .= astra_parse_css( $breadcrumbs_mobile, '', '543' );

	$dynamic_css .= $css;

	wp_add_inline_style( 'astra-theme-css', $dynamic_css );

}
