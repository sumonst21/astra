/**
 * Customizer controls toggles
 *
 * @package Astra
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	ASTControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'astra-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'astra-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'astra-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class ASTCustomizerToggles
	 */
	ASTCustomizerToggles = {

		'astra-settings[display-site-title]' :
		[
			{
				controls: [
					'astra-settings[divider-section-header-typo-title]',
					'astra-settings[font-size-site-title]',
				],
				callback: function( value ) {

					if ( value ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[logo-title-inline]',
				],
				callback: function( value ) {

					var site_tagline = api( 'astra-settings[display-site-tagline]' ).get();
					var has_custom_logo = api( 'custom_logo' ).get();
					var has_retina_logo = api( 'astra-settings[ast-header-retina-logo]' ).get();

					if ( ( value || site_tagline ) && ( has_custom_logo || has_retina_logo ) ) {
						return true;
					}
					return false;
				}
			},
		],

		'astra-settings[display-site-tagline]' :
		[
			{
				controls: [
					'astra-settings[divider-section-header-typo-tagline]',
					'astra-settings[font-size-site-tagline]',
				],
				callback: function( value ) {

					if ( value ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[logo-title-inline]',
				],
				callback: function( value ) {

					var site_title = api( 'astra-settings[display-site-title]' ).get();
					var has_custom_logo = api( 'custom_logo' ).get();
					var has_retina_logo = api( 'astra-settings[ast-header-retina-logo]' ).get();

					if ( ( value || site_title ) && ( has_custom_logo || has_retina_logo ) ) {
						return true;
					}
					return false;
				}
			},
		],

		'astra-settings[ast-header-retina-logo]' :
		[
			{
				controls: [
					'astra-settings[logo-title-inline]',
				],
				callback: function( value ) {

					var has_custom_logo = api( 'custom_logo' ).get();
					var site_tagline = api( 'astra-settings[display-site-tagline]' ).get();
					var site_title = api( 'astra-settings[display-site-title]' ).get();

					if ( ( value || has_custom_logo ) && ( site_title || site_tagline ) ) {
						return true;
					}
					return false;
				}
			},
		],

		'custom_logo' :
		[
			{
				controls: [
					'astra-settings[logo-title-inline]',
				],
				callback: function( value ) {

					var has_retina_logo = api( 'astra-settings[ast-header-retina-logo]' ).get();
					var site_tagline = api( 'astra-settings[display-site-tagline]' ).get();
					var site_title = api( 'astra-settings[display-site-title]' ).get();

					if ( ( value || has_retina_logo ) && ( site_title || site_tagline ) ) {
						return true;
					}
					return false;
				}
			},
		],

		/**
		 * Section - Header
		 *
		 * @link  ?autofocus[section]=section-header
		 */

		/**
		 * Layout 2
		 */
		// Layout 2 > Right Section > Text / HTML
		// Layout 2 > Right Section > Search Type
		// Layout 2 > Right Section > Search Type > Search Box Type.
		'astra-settings[header-main-rt-section]' :
		[
			{
				controls: [
					'astra-settings[header-main-rt-section-html]'
				],
				callback: function( val ) {

					if ( 'text-html' == val ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[header-main-menu-label]',
					'astra-settings[header-main-menu-label-divider]',
				],
				callback: function( custom_menu ) {
					var menu = api( 'astra-settings[disable-primary-nav]' ).get();
					if ( !menu || 'none' !=  custom_menu) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[header-display-outside-menu]',
				],
				callback: function( custom_menu ) {
					
					if ( 'none' !=  custom_menu ) {
						return true;
					}
					return false;
				}
			}
		],

		/**
		 * Blog
		 */
		'astra-settings[blog-tabs]' :
		[
			{
				controls: [
					'astra-settings[blog-post-content]',
					'astra-settings[blog-post-structure]',
					'astra-settings[ast-styling-section-blog-width]',
					'astra-settings[blog-width]',
				],
				callback: function( tab )
				{
					if ( 'layout' == tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[divider-section-archive-summary-box-typo]',
					'astra-settings[font-size-archive-summary-title]',
					'astra-settings[divider-section-archive-typo-archive-title]',
					'astra-settings[font-size-page-title]',
				],
				callback: function( tab )
				{
					if ( 'typography' == tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[blog-max-width]',
				],
				callback: function( tab )
				{
					var blog_width = api( 'astra-settings[blog-width]' ).get();

					if ( 'custom' == blog_width && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[blog-meta]',
				],
				callback: function( tab )
				{
					var blog_structure = api( 'astra-settings[blog-post-structure]' ).get();

					if ( jQuery.inArray ( "title-meta", blog_structure ) !== -1 && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[blog-width]' :
		[
			{
				controls: [
					'astra-settings[blog-max-width]'
				],
				callback: function( blog_width ) {

					var tab = api( 'astra-settings[blog-tabs]' ).get();

					if ( 'custom' == blog_width && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[blog-post-structure]' :
		[
			{
				controls: [
					'astra-settings[blog-meta]',
				],
				callback: function( blog_structure )
				{
					var tab = api( 'astra-settings[blog-tabs]' ).get();
					if ( jQuery.inArray ( "title-meta", blog_structure ) !== -1 && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],






		/**
		 * Blog Single
		 */
		 'astra-settings[blog-single-tabs]' :
		[
			{
				controls: [
					'astra-settings[blog-single-post-structure]',
					'astra-settings[ast-styling-section-single-blog-layouts]',
					'astra-settings[blog-single-width]',
				],
				callback: function( tab ) {
					if ( 'layout' === tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[divider-section-header-single-title]',
					'astra-settings[font-size-entry-title]',
				],
				callback: function( tab ) {
					if ( 'typography' === tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[blog-single-meta]',
				],
				callback: function( tab ) {

					var blog_structure = api( 'astra-settings[blog-single-post-structure]' ).get();

					if ( jQuery.inArray ( "single-title-meta", blog_structure ) !== -1 && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[blog-single-max-width]'
				],
				callback: function( tab ) {

					var blog_width = api( 'astra-settings[blog-single-width]' ).get();
					if ( 'custom' == blog_width && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],
		 'astra-settings[blog-single-post-structure]' :
		[
			{
				controls: [
					'astra-settings[blog-single-meta]',
				],
				callback: function( blog_structure ) {

					var tab = api( 'astra-settings[blog-single-tabs]' ).get();

					if ( jQuery.inArray ( "single-title-meta", blog_structure ) !== -1 && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[blog-single-width]' :
		[
			{
				controls: [
					'astra-settings[blog-single-max-width]'
				],
				callback: function( blog_width ) {

					var tab = api( 'astra-settings[blog-single-tabs]' ).get();
					if ( 'custom' == blog_width && 'layout' === tab ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[blog-single-meta]' :
		[
			{
				controls: [
					'astra-settings[blog-single-meta-comments]',
					'astra-settings[blog-single-meta-cat]',
					'astra-settings[blog-single-meta-author]',
					'astra-settings[blog-single-meta-date]',
					'astra-settings[blog-single-meta-tag]',
				],
				callback: function( enable_postmeta ) {

					if ( '1' == enable_postmeta ) {
						return true;
					}
					return false;
				}
		}
		],

		/**
		 * Small Footer
		 */
		'astra-settings[footer-bar-tabs]' :
		[
			// Layouts.
			{
				controls: [
					'astra-settings[footer-sml-layout]',
				],
				callback: function( footer_tab ) {
					if ( 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},

			{
				controls: [

					'astra-settings[footer-sml-section-1]',
					'astra-settings[footer-sml-section-2]',
					'astra-settings[section-ast-small-footer-background-styling]',
					'astra-settings[ast-small-footer-bg-img]',
					'astra-settings[section-ast-small-footer-typography]',
					'astra-settings[ast-small-footer-text-font]',
					'astra-settings[footer-sml-divider]',
					'astra-settings[footer-layout-width]',
					'astra-settings[section-ast-small-footer-layout-info]',
				],
				callback: function( footer_tab ) {

					var small_footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( 'disabled' != small_footer_layout && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-color]',
					'astra-settings[footer-link-color]',
					'astra-settings[footer-link-h-color]',
					'astra-settings[footer-bg-color]',
					'astra-settings[divider-footer-image]',
				],
				callback: function( footer_tab )
				{
					var small_footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( 'disabled' != small_footer_layout && 'colors' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-section-1-credit]',
				],
				callback: function( footer_tab ) {

					var small_footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();
					var footer_section_1    = api( 'astra-settings[footer-sml-section-1]' ).get();

					if ( 'disabled' != small_footer_layout && 'custom' == footer_section_1 && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-section-2-credit]',
				],
				callback: function( footer_tab ) {

					var footer_section_2 = api( 'astra-settings[footer-sml-section-2]' ).get();

					var small_footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( 'disabled' != small_footer_layout && 'custom' == footer_section_2 && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-divider-color]',
				],
				callback: function( footer_tab ) {

					var border_width = api( 'astra-settings[footer-sml-divider]' ).get();

					var small_footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( '1' <= border_width && 'disabled' != small_footer_layout && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
		],

		/**
		 * Small Footer
		 */
		'astra-settings[footer-sml-layout]' :
		[
			{
				controls: [
					'astra-settings[footer-sml-section-1]',
					'astra-settings[footer-sml-section-2]',
					'astra-settings[section-ast-small-footer-background-styling]',
					'astra-settings[ast-small-footer-bg-img]',
					'astra-settings[section-ast-small-footer-typography]',
					'astra-settings[ast-small-footer-text-font]',
					'astra-settings[footer-sml-divider]',
					'astra-settings[footer-layout-width]',
					'astra-settings[section-ast-small-footer-layout-info]',
				],
				callback: function( small_footer_layout ) {

					var footer_tab = api( 'astra-settings[footer-bar-tabs]' ).get();

					if ( 'disabled' != small_footer_layout && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-color]',
					'astra-settings[footer-link-color]',
					'astra-settings[footer-link-h-color]',
					'astra-settings[footer-bg-color]',
					'astra-settings[divider-footer-image]',
				],
				callback: function( small_footer_layout )
				{
					var footer_tab = api( 'astra-settings[footer-bar-tabs]' ).get();

					if ( 'disabled' != small_footer_layout && 'colors' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-section-1-credit]',
				],
				callback: function( small_footer_layout ) {

					var footer_section_1 = api( 'astra-settings[footer-sml-section-1]' ).get();

					var footer_tab = api( 'astra-settings[footer-bar-tabs]' ).get();

					if ( 'disabled' != small_footer_layout && 'custom' == footer_section_1 && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-section-2-credit]',
				],
				callback: function( small_footer_layout ) {

					var footer_section_2 = api( 'astra-settings[footer-sml-section-2]' ).get();

					var footer_tab = api( 'astra-settings[footer-bar-tabs]' ).get();

					if ( 'disabled' != small_footer_layout && 'custom' == footer_section_2 && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-sml-divider-color]',
				],
				callback: function( small_footer_layout ) {

					var border_width = api( 'astra-settings[footer-sml-divider]' ).get();

					var footer_tab = api( 'astra-settings[footer-bar-tabs]' ).get();

					if ( '1' <= border_width && 'disabled' != small_footer_layout && 'layout' === footer_tab ) {
						return true;
					}
					return false;
				}
			},
		],
		'astra-settings[footer-sml-section-1]' :
		[
			{
				controls: [
					'astra-settings[footer-sml-section-1-credit]',
				],
				callback: function( enabled_section_1 ) {

					var footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( 'custom' == enabled_section_1 && 'disabled' != footer_layout ) {
						return true;
					}
					return false;
				}
			}
		],
		'astra-settings[footer-sml-section-2]' :
		[
			{
				controls: [
					'astra-settings[footer-sml-section-2-credit]',
				],
				callback: function( enabled_section_2 ) {

					var footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( 'custom' == enabled_section_2 && 'disabled' != footer_layout ) {
						return true;
					}
					return false;
				}
			}
		],

		'astra-settings[footer-sml-divider]' :
		[
			{
				controls: [
					'astra-settings[footer-sml-divider-color]',
				],
				callback: function( border_width ) {

					var footer_layout = api( 'astra-settings[footer-sml-layout]' ).get();

					if ( '1' <= border_width && 'disabled' != footer_layout ) {
						return true;
					}
					return false;
				}
			},
		],

		'astra-settings[header-main-sep]' :
		[
			{
				controls: [
					'astra-settings[header-main-sep-color]',
				],
				callback: function( border_width ) {

					if ( '1' <= border_width ) {
						return true;
					}
					return false;
				}
			},
		],

		'astra-settings[disable-primary-nav]' :
		[
			{
				controls: [
					'astra-settings[header-main-menu-label]',
					'astra-settings[header-main-menu-label-divider]',
				],
				callback: function( menu ) {
					var custom_menu = api( 'astra-settings[header-main-rt-section]' ).get();
					if ( !menu || 'none' !=  custom_menu) {
						return true;
					}
					return false;
				}
			},
		],

		/**
		 * Footer Widgets
		 */
		'astra-settings[footer-adv]' :
		[
			{
				controls: [
					'astra-settings[footer-adv-background-divider]',
					'astra-settings[footer-adv-wgt-title-color]',
					'astra-settings[footer-adv-text-color]',
					'astra-settings[footer-adv-link-color]',
					'astra-settings[footer-adv-link-h-color]',
					'astra-settings[footer-adv-bg-color]',
				],
				callback: function( footer_widget_area ) {

					var footer_widget_tabs = api( 'astra-settings[footer-widget-tabs]' ).get();

					if ( 'disabled' != footer_widget_area && 'colors' === footer_widget_tabs ) {
						return true;
					}
					return false;
				}
			},
		],
		'astra-settings[footer-widget-tabs]' :
		[
			{
				controls: [
					'astra-settings[footer-adv]',
				],
				callback: function( footer_widget_tabs ) {

					if ( 'layout' === footer_widget_tabs ) {
						return true;
					}
					return false;
				}
			},
			{
				controls: [
					'astra-settings[footer-adv-background-divider]',
					'astra-settings[footer-adv-wgt-title-color]',
					'astra-settings[footer-adv-text-color]',
					'astra-settings[footer-adv-link-color]',
					'astra-settings[footer-adv-link-h-color]',
					'astra-settings[footer-adv-bg-color]',
				],
				callback: function( footer_widget_tabs ) {

					var footer_widget_area = api( 'astra-settings[footer-adv]' ).get();

					if ( 'disabled' != footer_widget_area && 'colors' === footer_widget_tabs ) {
						return true;
					}
					return false;
				}
			},
		],
		'astra-settings[shop-archive-width]' :
		[
			{
				controls: [
					'astra-settings[shop-archive-max-width]'
				],
				callback: function( blog_width ) {

					if ( 'custom' == blog_width ) {
						return true;
					}
					return false;
				}
			}
		],
	};
} )( jQuery );