/* global wc_price_based_country_pro_order_metaboxes_param */
;( function( $ ) {
	'use strict';
	if ( typeof woocommerce_admin_meta_boxes === 'undefined' || typeof wc_price_based_country_pro_order_metaboxes_param === 'undefined' ) {
		return;
	}

	// Order items actions
	var wcpbc_meta_boxes_order_items = {
		init: function(){
			$( '#woocommerce-order-items' ).on( 'click', 'button.wcpbc-load-pricing-action', this.on_load_country_pricing );
		},

		block: function(){
			$( '#woocommerce-order-items' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});
		},

		refresh: function(data){
			//replace content
			$( '#woocommerce-order-items' ).find( '.inside' ).empty();
			$( '#woocommerce-order-items' ).find( '.inside' ).append( data );

			// init tiptip
			$( '#tiptip_holder' ).removeAttr( 'style' );
			$( '#tiptip_arrow' ).removeAttr( 'style' );
			$( '.tips' ).tipTip({
				'attribute': 'data-tip',
				'fadeIn': 50,
				'fadeOut': 50,
				'delay': 200
			});

			//unblock
			$( '#woocommerce-order-items' ).unblock();

			//stupidtable init
			$( '.woocommerce_order_items' ).stupidtable();
			$( '.woocommerce_order_items' ).on( 'aftertablesort', this.add_arrows );
		},

		add_arrows: function( event, data ) {
			var th    = $( this ).find( 'th' );
			var arrow = data.direction === 'asc' ? '&uarr;' : '&darr;';
			var index = data.column;
			th.find( '.wc-arrow' ).remove();
			th.eq( index ).append( '<span class="wc-arrow">' + arrow + '</span>' );
		},

		on_load_country_pricing: function(){
			if ( window.confirm( wc_price_based_country_pro_order_metaboxes_param.i18n_load_country_pricing_confirm ) ) {
				wcpbc_meta_boxes_order_items.load_country_pricing();
			}
		},

		load_country_pricing: function( callback ){

			// get tax args
			var tax_args = {
				country: '',
				state:'',
				postcode: '',
				city: ''
			}

			if ( 'shipping' === woocommerce_admin_meta_boxes.tax_based_on ) {
				tax_args.country  = $( '#_shipping_country' ).val();
				tax_args.state    = $( '#_shipping_state' ).val();
				tax_args.postcode = $( '#_shipping_postcode' ).val();
				tax_args.city     = $( '#_shipping_city' ).val();
			}

			if ( 'billing' === woocommerce_admin_meta_boxes.tax_based_on || ! tax_args.country ) {
				tax_args.country  = $( '#_billing_country' ).val();
				tax_args.state    = $( '#_billing_state' ).val();
				tax_args.postcode = $( '#_billing_postcode' ).val();
				tax_args.city     = $( '#_billing_city' ).val();
			}

			var data = {
				action:   		 'wc_price_based_country_load_country_pricing',
				order_id: 		  woocommerce_admin_meta_boxes.post_id,
				billing_country:  $( '#_billing_country' ).val(),
				shipping_country: $( '#_shipping_country' ).val(),
				items:    		  $( 'table.woocommerce_order_items :input[name], .wc-order-totals-items :input[name]' ).serialize(),
				tax_args: 		  tax_args,
				security: 		  wc_price_based_country_pro_order_metaboxes_param.load_country_pricing_nonce
			};

			wcpbc_meta_boxes_order_items.block();

			$.ajax({
				url:  wc_price_based_country_pro_order_metaboxes_param.ajax_url,
				data: data,
				type: 'POST',
				success: function( response ) {
					wcpbc_meta_boxes_order_items.refresh(response);

					if ( typeof callback === 'function' ) {
						callback( response );
					}
				}

			});
		}
	};

	var wcpbc_order_actions = {

		/**
		 * Form state.
		 *
		 * @var string
		 */
		state: '',

		/**
		 * Initialize ajax methods
		 */
		init: function() {
			if ( ! $('button#wcpbc-load-pricing-action').length > 0 ) {
				// Nothing to do.
				return;
			}
			var postForm = $( 'form#post' );

			postForm.on( 'submit', this.before_save_order );
			postForm.on('click', 'a.edit_address', this.change_state);
			$( 'input:submit', postForm ).on( 'click keypress', function() {
				postForm.data( 'callerid', this.id );
			});
		},

		/**
		 * Change the state after edit address.
		 */
		change_state: function() {
			wcpbc_order_actions.state = 'edit';
		},

		/**
		 * Ask the user to load the country pricing before saves the order.
		 */
		before_save_order: function( e ) {
			if ( wcpbc_order_actions.need_update() && window.confirm('Price Based on Country: ' + wc_price_based_country_pro_order_metaboxes_param.i18n_before_save_confirm) ) {
				e.preventDefault();
				wcpbc_meta_boxes_order_items.load_country_pricing( wcpbc_order_actions.before_save_order_done );
			}
		},

		/**
		 * Does need to load country pricing?
		 *
		 * @returns {bool}
		 */
		need_update: function() {
			var order_zone_id = wcpbc_order_actions.get_order_zone_id();
			return 'edit' === wcpbc_order_actions.state && ( order_zone_id !== $('button#wcpbc-load-pricing-action').data('zone_id') ) && $('.woocommerce_order_items tr.item').length > 0;
		},

		/**
		 * Continue with form submission.
		 */
		 before_save_order_done: function() {
			var postForm = $( 'form#post' ),
				callerid = postForm.data( 'callerid' );

			if ( 'publish' === callerid ) {
				postForm.append('<input type="hidden" name="publish" value="1" />').trigger( 'submit' );
			} else {
				postForm.append('<input type="hidden" name="save-post" value="1" />').trigger( 'submit' );
			}
		},

		/**
		 * Return the zone ID for the country of the order.
		 *
		 * @returns {String}
		 */
		get_order_zone_id: function() {
			var billing_country  = $( '#_billing_country' ).val();
			var shipping_country = ! $( '#_shipping_country' ).val() ? billing_country : $( '#_shipping_country' ).val();
			var country          = 'billing' === wc_price_based_country_pro_order_metaboxes_param.price_based_on ? billing_country : shipping_country;
			var zone_id          = '';
			wc_price_based_country_pro_order_metaboxes_param.zones_and_countries.forEach( function(element, index){
				if (-1 !== element.countries.indexOf( country ) ) {
					zone_id = element.zone_id;
					return;
				}
			});
			return zone_id;

		}
	};

	wcpbc_meta_boxes_order_items.init();
	wcpbc_order_actions.init();

})( jQuery );