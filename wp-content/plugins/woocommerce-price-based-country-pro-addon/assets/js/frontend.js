/* global wc_price_based_country_pro_frontend_param, woocommerce_params */
jQuery(document).ready( function($){

	if ( typeof wc_price_based_country_pro_frontend_params === 'undefined' ) {
		return false;
	}

	// Ajax geolocation
	var geolocation_pro = {

		products: {},

		refresh_addon_total: function() {
			if ( $('#product-addons-total').length > 0 ) {
				var product_id = $('#product-addons-total').data('product-id');
				if ( $('form.variations_form input[name="variation_id"]').length > 0 ) {
					product_id = $('form.variations_form input[name="variation_id"]').val();
				}
				if ( typeof product_id !== 'undefined' && typeof this.products[product_id] !== 'undefined'  ){
					$('#product-addons-total').data('price', this.products[product_id].display_price);
					$('#product-addons-total').data('raw-price', this.products[product_id].raw_price);
				}
			}
		},

		refresh_price_per_unit: function() {
			$('.product.type-product').each(function(){
				if ( typeof $(this).attr('id') !== 'undefined' ) {
					var product_id = $(this).attr('id').replace('product-', '');
					if ( typeof geolocation_pro.products[product_id] !== 'undefined' && typeof geolocation_pro.products[product_id]['price_per_unit_html'] !== 'undefined' ) {
						var $price_per_unit_html = $(geolocation_pro.products[product_id]['price_per_unit_html']);
						if ( typeof $(this).find('.wgm-info.price-per-unit').first() !== 'undefined' ) {
							$(this).find('.wgm-info.price-per-unit').first().html($price_per_unit_html.html());
						}
					}
				}
			});
		},

		refresh_bundled_items: function() {
			$('.bundle_data[data-bundle_id][data-bundle_price_data], .bundle_data[data-bundle_id][data-bundle_form_data]').each( function(){
				var bundle_id = $(this).data('bundle_id');
				if ( geolocation_pro.products[ bundle_id ] && typeof geolocation_pro.products[ bundle_id ].bundle_price_data !== 'undefined' ) {
					$(this).data( 'bundle_price_data', geolocation_pro.products[ bundle_id ].bundle_price_data );
					if ( $(this).data('bundle_form_data') ) {
						$(this).data( 'bundle_form_data', geolocation_pro.products[ bundle_id ].bundle_price_data );
					}
					if ( typeof wc_pb_bundle_scripts !== 'undefined' && typeof wc_pb_bundle_scripts[ bundle_id ] !== 'undefined' ) {
						wc_pb_bundle_scripts[ bundle_id ].price_data = geolocation_pro.products[ bundle_id ].bundle_price_data;
						wc_pb_bundle_scripts[ bundle_id ].update_totals();
					}
				}
			});

			$('.bundled_product div[data-bundle_id][data-product_id]').each( function(){
				var bundle_id  = $(this).data('bundle_id');
				var product_id = $(this).data('product_id');

				if ( geolocation_pro.products[ bundle_id ] && typeof geolocation_pro.products[ bundle_id ].bundled_items[ product_id ] !== 'undefined') {
					var bundled_item = geolocation_pro.products[ bundle_id ].bundled_items[ product_id ];
					$price_html = $('<div>'+ bundled_item.price_html+'</div>').find('.wcpbc-price.wcpbc-price-' + bundled_item.id + ':first');

					if ( typeof $price_html !== 'undefined') {
						$(this).closest('.bundled_product').find( '.wcpbc-price.wcpbc-price-' + bundled_item.id ).html($price_html.html()).removeClass('loading');
					}
					if ( bundled_item.variations ) {
						$(this).data('product_variations', bundled_item.variations);
						$(this).trigger('reload_product_variations');
					}
				}
			} );
		},

		refresh_name_your_price: function() {
			if ( $('form.cart').find('.nyp').length ) {
				var $nyp     = $('form.cart').find('.nyp');
				var $wrapper = $nyp.closest('.nyp-product.product');
				if ( $wrapper.length ) {
					var product_id = $wrapper.attr('id').replace('product-', '');
					if ( typeof geolocation_pro.products[product_id] !== 'undefined' ) {
						var product = geolocation_pro.products[product_id];
						if ( typeof product.min_price !== 'undefined' && product.max_price !== 'undefined' && product.suggested_price !== 'undefined' ) {
							$nyp.data('min-price', product.min_price );
							$nyp.data('max-price', product.max_price );
							$nyp.data('price', product.suggested_price );
							$nyp.find('input#nyp').first().attr('value', product.price_attr );
							if ( $nyp.find('.minimum-text').length ) {
								$nyp.find('.minimum-text').parent().html( product.min_price_html );
							}
						}
					}
				}

				if ( $( 'form.variations_form' ).length ) {
					var product_variations = $( 'form.variations_form' ).data( 'product_variations' );
					if ( null !== product_variations && typeof product_variations !== 'undefined' ){
						$.each( product_variations, function( i, variation ) {
							if ( typeof geolocation_pro.products[ variation.variation_id ] !== 'undefined' && geolocation_pro.products[ variation.variation_id ].suggested_price  !== 'undefined' ) {
								product_variations[ i ].display_price         = geolocation_pro.products[ variation.variation_id ].suggested_price;
								product_variations[ i ].display_regular_price = geolocation_pro.products[ variation.variation_id ].suggested_price;
								product_variations[ i ].maximum_price         = geolocation_pro.products[ variation.variation_id ].max_price;
								product_variations[ i ].minimum_price         = geolocation_pro.products[ variation.variation_id ].min_price;
								product_variations[ i ].minimum_price_html    = geolocation_pro.products[ variation.variation_id ].min_price_html;
							}
						} );

						$('form.variations_form').data('product_variations', product_variations);
					}
				}
			}
		},

		german_market: {
			get_product_id: function( $el ) {
				var id      = false;
				var classes = $el.attr('class');
				var patt    = / wgm-pbc-info-\d+/i;
				var result  = classes.match(patt);
				if ( result.length > 0 ) {
					var id = result[0].replace( ' wgm-pbc-info-', '' );
				}
				return id;
			},

			refresh: function() {
				$('.wgm-pbc-info.price-per-unit').each( function() {
					var product_id = geolocation_pro.german_market.get_product_id( $(this) );
					if ( typeof geolocation_pro.products[ product_id ] !== 'undefined' && typeof geolocation_pro.products[ product_id ]['price_per_unit_html'] !== 'undefined' ) {
						var $price_per_unit_html = $( geolocation_pro.products[ product_id ]['price_per_unit_html'] );
						$(this).html( $price_per_unit_html.html() );
					}
				} );

				$('.wgm-pbc-info.woocommerce-de_price_taxrate').each( function() {
					var product_id = geolocation_pro.german_market.get_product_id( $(this) );
					if ( typeof geolocation_pro.products[ product_id ] !== 'undefined' && typeof geolocation_pro.products[ product_id ]['text_including_tax'] !== 'undefined' ) {
						var $text_including_tax = $( geolocation_pro.products[ product_id ]['text_including_tax'] );
						$(this).html( $text_including_tax.html() );
					}
				} );
			},
		},

		germanized: {
			refresh: function(){
				if ( ! $('.wcpbc-gzd-price-unit').length ) {
					return;
				}
				$.each( geolocation_pro.products, function( i, product ) {
					var $unit_price_html;
					if ( typeof product.unit_price_html !== 'undefined' && product.unit_price_html && $('.wcpbc-gzd-price-unit-' + product.id ).length ) {
						$unit_price_html = $('<div>' + product.unit_price_html + '</div>').find('.wcpbc-gzd-price-unit-' + product.id + ':first');
						$('.wcpbc-gzd-price-unit-' + product.id ).html( $unit_price_html.html() );
					}
				});

				if ( $( 'form.variations_form' ).length ) {
					var product_variations = $( 'form.variations_form' ).data( 'product_variations' );
					if ( null !== product_variations && typeof product_variations !== 'undefined' ){
						$.each( product_variations, function( i, variation ) {
							if ( typeof geolocation_pro.products[ variation.variation_id ] !== 'undefined' && typeof geolocation_pro.products[ variation.variation_id ]['unit_price_html'] !== 'undefined' ) {
								product_variations[i].unit_price = geolocation_pro.products[ variation.variation_id ]['unit_price_html'];
							}
						});
						$('form.variations_form').data('product_variations', product_variations);
					}
				}
			}
		},

		refresh_measurement_price_calculator: function() {
			if ( typeof wc_price_calculator_params == 'undefined' ) {
				return;
			}
			wc_price_calculator_params.woocommerce_currency_symbol = geolocation_pro.currency_params.symbol;
			wc_price_calculator_params.woocommerce_price_decimal_sep = geolocation_pro.currency_params.decimal_sep;
			wc_price_calculator_params.woocommerce_price_num_decimals = geolocation_pro.currency_params.num_decimals;
			wc_price_calculator_params.woocommerce_price_thousand_sep = geolocation_pro.currency_params.thousand_sep;

			var product_id = wc_price_calculator_params.product_id !== 'undefined' ? wc_price_calculator_params.product_id : false;
			if ( product_id && typeof geolocation_pro.products[ product_id ] !== 'undefined' ) {

				wc_price_calculator_params.product_price = geolocation_pro.products[ product_id ].display_price;

				if ( typeof wc_price_calculator_params.minimum_price !== 'undefined' && typeof geolocation_pro.products[ product_id ]['measurement_min_price'] !== 'undefined' ) {
					wc_price_calculator_params.minimum_price = geolocation_pro.products[ product_id ]['measurement_min_price'];
				}
				if ( typeof geolocation_pro.products[ product_id ]['measurement_pricing_rules'] !== 'undefined' ) {
					wc_price_calculator_params.pricing_rules = geolocation_pro.products[ product_id ]['measurement_pricing_rules']
				}

				// Variations.
				if ( $( 'form.variations_form' ).length ) {
					var product_variations = $( 'form.variations_form' ).data( 'product_variations' );
					if ( null !== product_variations && typeof product_variations !== 'undefined' ){
						$.each( product_variations, function( i, variation ) {
							if ( typeof geolocation_pro.products[ variation.variation_id ] !== 'undefined' && geolocation_pro.products[ variation.variation_id ].measurement_min_price  !== 'undefined' ) {
								product_variations[i].price         = geolocation_pro.products[ variation.variation_id ].display_price;
								product_variations[i].minimum_price = geolocation_pro.products[ variation.variation_id ].measurement_min_price;
							}
						});
						$('form.variations_form').data('product_variations', product_variations);
					}
				}
			}
			// Refresh the price calculator.
			$( 'form.cart' ).triggerHandler( 'wc-measurement-price-calculator-update');
		},

		refresh_name_your_price_currency: function() {
			if ( $('label[for="nyp"]').length ) {
				var label_text = $('label[for="nyp"]').html().replace( wc_price_based_country_pro_frontend_params.currency_format_symbol, geolocation_pro.currency_params.symbol );
				$('label[for="nyp"]').html(label_text);
			}

			if ( typeof woocommerce_nyp_params !== 'undefined' ) {
				woocommerce_nyp_params.currency_format_symbol       = geolocation_pro.currency_params.symbol;
				woocommerce_nyp_params.currency_format_num_decimals = geolocation_pro.currency_params.num_decimals;
				woocommerce_nyp_params.currency_format_decimal_sep  = geolocation_pro.currency_params.decimal_sep;
				woocommerce_nyp_params.currency_format_thousand_sep = geolocation_pro.currency_params.thousand_sep;
				woocommerce_nyp_params.currency_format              = geolocation_pro.currency_params.format;
			}
		},

		refresh_addons_currency: function() {
			// Replace the Product addons currency format params
			if ( typeof woocommerce_addons_params !== 'undefined' ) {
				woocommerce_addons_params.currency_format_num_decimals = geolocation_pro.currency_params.num_decimals;
				woocommerce_addons_params.currency_format_symbol       = geolocation_pro.currency_params.symbol;
				woocommerce_addons_params.currency_format_decimal_sep  = geolocation_pro.currency_params.decimal_sep;
				woocommerce_addons_params.currency_format_thousand_sep = geolocation_pro.currency_params.thousand_sep;
				woocommerce_addons_params.currency_format              = geolocation_pro.currency_params.format;
				//refresh the subtotals.
				$('.cart:not(.cart_group)').trigger( 'woocommerce-product-addons-update' );
			}
		},

		refresh_bundled_currency: function() {
			// Replace the Product bundled currency format params
			if ( typeof wc_bundle_params !== 'undefined' && $('.bundle_form .bundle_data').length ) {
				wc_bundle_params.currency_format_decimal_sep = geolocation_pro.currency_params.decimal_sep;
				//wc_bundle_params.currency_position,
				wc_bundle_params.currency_symbol = geolocation_pro.currency_params.symbol;
				wc_bundle_params.currency_format_num_decimals = geolocation_pro.currency_params.num_decimals
				//refresh the subtotals
				$('.bundle_form .bundle_data').trigger( 'woocommerce-product-bundle-update-totals', true );
			}
		},

		// Bundle and WCSATT integration
		bundle_wcsatt: {
			init: function() {
				if ( $('.bundle_form .bundle_data').length > 0 && $('.wcsatt-options-wrapper').length > 0 ) {
					$( '.bundle_form .bundle_data' ).each( function() {
						$( this ).on( 'woocommerce-product-bundle-initializing', function( event, bundle ) {
							if ( typeof geolocation_pro.bundle_wcsatt.bundle_obj === 'undefined' && ! bundle.is_composited() ) {
								geolocation_pro.bundle_wcsatt.bundle_obj = bundle;
							}
						} );
					} );

					$(document.body).on( 'wc_price_based_country_after_ajax_geolocation', function() {
						if ( typeof geolocation_pro.bundle_wcsatt.bundle_obj !== 'undefined' ) {
							geolocation_pro.bundle_wcsatt.bundle_obj.$bundle_data.trigger('woocommerce-product-bundle-initializing', [geolocation_pro.bundle_wcsatt.bundle_obj]);
						}
					});
				}
			}
		},

		// MSRP Pricing integration.
		refresh_msrp: function() {
			if ( $('.woocommerce_msrp').length > 0 ) {
				$('.woocommerce_msrp').each(function(){
					var product_id = geolocation_pro.find_product_id( this );
					if ( product_id && geolocation_pro.products[ product_id ] && geolocation_pro.products[ product_id ].msrp_html ) {
						$(this).replaceWith( geolocation_pro.products[ product_id ].msrp_html );
					}
				});

				// Variations.
				if ( $( 'form.variations_form' ).length ) {
					var product_variations = $( 'form.variations_form' ).data( 'product_variations' );
					if ( null !== product_variations && typeof product_variations !== 'undefined' ){
						$.each( product_variations, function( i, variation ) {
							if ( typeof geolocation_pro.products[ variation.variation_id ] !== 'undefined' && typeof geolocation_pro.products[ variation.variation_id ]['mrsp_variation'] !== 'undefined' ) {
								var variation_data = geolocation_pro.products[ variation.variation_id ]['mrsp_variation'];
								product_variations[i].msrp = variation_data.msrp
								product_variations[i].msrp_html = variation_data.msrp_html
								product_variations[i].non_msrp_price = variation_data.non_msrp_price
								product_variations[i].msrp_saving = variation_data.msrp_saving
							}
						});
						$('form.variations_form').data('product_variations', product_variations);
					}
				}
			} // End $('.woocommerce_msrp').length
		},

		/**
		 * Find the product ID from the parent element.
		 */
		find_product_id: function( el ) {
			var id      = false;
			var $parent = $(el).closest('.type-product');
			if ( $parent ) {
				var classes = $parent.attr('class');
				var patt    = / post-\d+/i;
				var result  = classes.match(patt);
				if ( result.length > 0 ) {
					var id = result[0].replace( ' post-', '' );
				}
			}
			return id;
		},

		init: function() {

			$(document.body).on( 'wc_price_based_country_set_product_price', function(e, products) {
				if ( typeof products !== 'undefined' ) {
					geolocation_pro.products = products;
					geolocation_pro.refresh_addon_total();
					geolocation_pro.refresh_price_per_unit();
					geolocation_pro.refresh_bundled_items();
					geolocation_pro.refresh_name_your_price();
					geolocation_pro.german_market.refresh();
					geolocation_pro.germanized.refresh();
					geolocation_pro.refresh_msrp();
				}
			});

			$(document.body).on( 'wc_price_based_country_set_currency_params', function(e, currency_params) {
				if ( typeof currency_params !== 'undefined' ) {
					geolocation_pro.currency_params = currency_params;
					geolocation_pro.refresh_name_your_price_currency();
					geolocation_pro.refresh_addons_currency();
					geolocation_pro.refresh_bundled_currency();
					geolocation_pro.refresh_measurement_price_calculator();

					wc_price_based_country_pro_frontend_params.currency_format_symbol       = currency_params.symbol;
					wc_price_based_country_pro_frontend_params.currency_format_num_decimals = currency_params.num_decimals;
					wc_price_based_country_pro_frontend_params.currency_format_decimal_sep  = currency_params.decimal_sep;
					wc_price_based_country_pro_frontend_params.currency_format_thousand_sep = currency_params.thousand_sep;
					wc_price_based_country_pro_frontend_params.currency_format              = currency_params.format;
				}
			});

			$(document.body).on('wc_price_based_country_refresh_areas', function(){
				// Product Addons compatibilty - Remove loading class
				$('.wc-price-based-country-addons-total-wrapper.loading').removeClass('loading');
			});

			$(document.body).on( 'wc_price_based_country_after_ajax_geolocation', function(e, zone_id ) {

				// Content shortcode.
				var zone_class = (zone_id ? 'content-' + zone_id : 'no-zone');
				$('.wcpbc-content').hide();
				$('.wcpbc-content.' + zone_class ).show();
				$('.wcpbc-content').addClass('refreshed');

				// Product Addons compatibilty - init image swatch
				if (  $( '.wc-pao-addon-image-swatch').length > 0 ) {
					$( '.wc-pao-addon-image-swatch' ).tipTip( { delay: 200 } );
				}
			});

			// init the Bundle and WCSATT integration.
			geolocation_pro.bundle_wcsatt.init();
		}
	};

	geolocation_pro.init();

} );