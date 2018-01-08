$(document).ready(function() {
	
	$('.sameAs').click(function() {
	
		var elements = [
			'_name',
			'_company',
			'_address',
			'_address_2',
			'_country',
			'_city',
			'_state',
			'_zip',
			'_phone'
		];
		
		_.each(elements, function(element) {			
			$('#shipping' + element).val( $('#billing' + element).val() ).trigger('change');
			
			// console.log( 'billing: ', $('#billing' + element).val(), 'shipping: ', $('#shipping' + element).val() );
			
			/*
			if( $('#billing' + element).is('select') ) {
				$('#billing' + element).trigger('change');
			}
			*/
			
			if( $('#billing' + element).val() != '' ) {
				$('#shipping' + element + ',#billing' + element).parent().find('.overlabel-apply').css('textIndent', '-10000px');
			}
		});
		
	});
	
});