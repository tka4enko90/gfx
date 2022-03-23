/* global wcpbc_checkout_add_ons_param */
;( function( $ ) {
	'use strict';

	if ( 'undefined' === typeof wcpbc_checkout_add_ons_param ) {
		return;
	}

	var options = {
		init: function() {
			$('.options_group.wcpbc_pricing table.wcpbc-checkout-add-ons-option-fields tbody').each(function(){
				var zone_id = $(this).data('zone_id');
				if (
					'undefined' !== typeof wcpbc_checkout_add_ons_param.add_on[zone_id] &&
					'undefined' !== typeof wcpbc_checkout_add_ons_param.add_on[zone_id]['options']
				) {
					if ( Array.isArray( wcpbc_checkout_add_ons_param.add_on[zone_id]['options'] ) ) {
						wcpbc_checkout_add_ons_param.add_on[zone_id]['options'].forEach( function(element, index) {
							options.setOptionData( index, zone_id, element.adjustment );
						});
					} else {
						for ( var index in wcpbc_checkout_add_ons_param.add_on[zone_id]['options'] ) {
							options.setOptionData( index, zone_id, wcpbc_checkout_add_ons_param.add_on[zone_id]['options'][index].adjustment );
						}
					}
				}
			});
		},
		setOptionData: function( index, zoneId, value ) {
			var $input   = $('.checkout-add-ons-options table tr input.price-adjustment[name="options[' + index + '][adjustment]"]');
			if ( $input.length) {
				$input.data('wcpbcPrice_' + zoneId , value);
			}
		},
		getRows: function(){
			var rows = [];
			$('.checkout-add-ons-options table tr input.price-adjustment').each(function(){
				// Get the ID.
				var data = {
					id: $(this).attr('name').replace('options[', '').replace('][adjustment]', ''),
					label: $(this).closest('tr').find('td.checkout-add-on-option-label input').val(),
					type: $(this).closest('tr').find('select.price-adjustment-type').val(),
					that: $(this),
				};
				if ( $.isNumeric(data.id) && 'fixed' === data.type ) {
					rows.push(data);
				}
			});
			return rows;
		},
		sync: function() {
			var rows = this.getRows();
			$('.options_group.wcpbc_pricing table.wcpbc-checkout-add-ons-option-fields tbody').each(function(){
				var $tbody = $(this);
				$tbody.empty();
				rows.forEach( function(row){

					var data = {
						id: row.id,
						label: row.label,
						zone_id: $tbody.data('zone_id'),
						value: ''
					}

					if ( 'undefined' !== typeof row.that.data('wcpbcPrice_' + data.zone_id) ) {
						data.value = row.that.data('wcpbcPrice_' + data.zone_id);
					}

					var trTemplate = wp.template('wcpbc-checkout-add-ons-option');
					var tr         = trTemplate(data);
					$tbody.append(tr);
				});
			});
		},
		afterUpdateOption: function() {
			var optionId = $(this).closest('tr').data('optionId');
			var zoneId   = $(this).closest('tbody').data('zone_id');
			options.setOptionData( optionId, zoneId, $(this).val() );
		}
	};

	var panel = {
		showHide: function() {
			var addonType   = $('#type').val();
			var showOptions = -1 < $.inArray(addonType, wcpbc_checkout_add_ons_param.types_with_options);
			$('p._wcpbc_adjustment_field').toggle(!showOptions);
			$('div.wrapper-wcpbc-checkout-add-ons-option-fields').toggle(showOptions);

			// Check there are fixed adjustment.
			var hidePricing = ( ! showOptions && 'fixed' !== $('select[name="adjustment_type"]').val() ) ||
				( showOptions && ! options.getRows().length );

			$('.options_group.wcpbc_pricing').toggle(!hidePricing);
			$('#wcpbc-checkout-add-ons-no-fixed-alert').toggle(hidePricing);
		}
	};

	$(document).ready(function(){
		options.init();

		$('.wc-tab.zone_pricing_tab a').on('click', function(){
			panel.showHide();
			options.sync();
		});
		$('.wcpbc-checkout-add-ons-option-fields').on('change', '.wcpbc-checkout-add-ons-option-price-adjustment', options.afterUpdateOption );
	});
})( jQuery );