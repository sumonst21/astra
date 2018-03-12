/**
 * File radio-tabs.js
 *
 * Handles toggling the radio images button
 *
 * @package Astra
 */

	wp.customize.controlConstructor['ast-radio-tabs'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this;

			// Change the value.
			this.container.on( 'click', '.radio-tabs-wrapper label', function() {
			
				// Add active class.
				$(this).siblings().removeClass('activated');
				$(this).addClass('activated');

				// Set value.
				var value = $( this ).find('input').val();
				control.setting.set( value );

			});

		},

	});