// Document Ready
///////////////////////////////////////////////////////////////////////
$(document).ready(function() {
  // Homepage City Hover
  ////////////////////////////////////////
  $('.cities a').click(function(){
    id = $(this).attr('data-id');
    if (!$(this).hasClass('active')){ 
      $(this).addClass('active').siblings().removeClass('active');
      $('.addresses').css('opacity', 1);
      $('.addresses div').css('opacity', 0);
      $('.addresses div[data-id='+id+']').css('opacity', 1).show();
    }else{
      $(this).removeClass('active').siblings().removeClass('active');
      $('.addresses div[data-id='+id+']').css('opacity', 0);
      $('.addresses').css('opacity', 0);

    }
  });


	// Open External Links in a New Window
	////////////////////////////////////////
	$('a[rel="external"]').click( function() {
	        window.open( $(this).attr('href') );
	        return false;
    });


	// Form Overlabel 
	////////////////////////////////////////
	$("#contactForm label").overlabel();

	$("#register label").overlabel();
	
	$('#register p.select select,#register p.select input').live('focus', function() {
		$(this).parent().find('.overlabel-apply').hide()
	});

	// Shop Page Tool Tip
	//////////////////////////////////////
/*
	$("#shopBox a[title]").tooltip({ 
			position: "bottom center",
			offset: [-88, 0],
			effect: 'fade',
	    tip: '#tooltip',
			relative: true
	});
*/
  // $("#shopBox a[title]").tooltip('#tooltip');
  
  $('#shopBox ul li').hover(function() {
    $(this).find('.tooltip').stop().fadeTo(300, 1);
  }, function() {
    $(this).find('.tooltip').stop().fadeTo(300, 0);
  });
  
  $('#shopBox ul li .tooltip').fadeTo(0,0);


	// Product Detail Page Cycle
	//////////////////////////////////////
	$(function(){

		$('.productDetailPic').after('<div id="productThumbs"><ul>');

		$('#productDetailPg .slide').cycle({ 
		    fx:     'fade', 
		    speed:  'fast', 
		    timeout: 0, 
		    pager:  '#productThumbs ul', 

		    // callback fn that creates a thumbnail to use as pager anchor 
		    pagerAnchorBuilder: function(idx, slide) { 
		        return '<li><a href="#"><img src="' + slide.src + '" width="132" height="132" /></a></li>'; 
		    } 
		});
		
		if( $('#productThumbs ul li').length <= 0 ) {
			$('#productThumbs').height( 160 );
		}

		$("#productThumbs li:nth-child(3n)").addClass('last'); // class to remove margin on every 3rd (last) thumbnail in the set
	});
	


	// Press Page Cycle
	//////////////////////////////////////
	$(".thumbs li:nth-child(6)").addClass('last'); // class to remove margin on last thumbnail in the set

	var tGroup = $('#secondaryContent ul.thumbs');

	if (tGroup.length > 1) {
		$('div#secondaryContent').after('<div class="controls"><a href="#" class="prev">prev</a> <a href="#" class="next">next</a></div>');
		$('#secondaryContent').cycle({ 
			fx:     'scrollHorz', 
			speed:  'fast', 
			timeout: 0,
			prev: 'a.prev',
			next: 'a.next'
		});
	}

	var cycleOpts = {
		fx:     'fade', 
		speed:  500, 
 		timeout: 0, 
		pager:  'ul.thumbs',
		pagerAnchorBuilder: function(idx, slide) { 
			return 'ul.thumbs li:eq(' + idx + ') a'; 
		}
	}

	$.fn.cycle.updateActivePagerLink = function(pager, currSlideIndex) { 
		$(pager).find('li').animate({'opacity' : .75}).filter('li:eq('+currSlideIndex+')').animate({'opacity' : 1}, 'fast');
		$(pager).find('li').removeClass('activeSlide').filter('li:eq('+currSlideIndex+')').addClass('activeSlide');
	};

	$('.press .slide').cycle(cycleOpts);

		
	// Press Page Fancy Box
	//////////////////////////////////////
	if(jQuery.fn.fancybox) {
		$(".press .slide li a").fancybox({ 
			'padding' : 20,
			'hideOnContentClick' : true, 
			'showCloseButton' : true,
			'titlePosition' : 'inside',
			'overlayColor' : '#000000',
			'overlayOpacity' : '0.6'
		});
		
		$('a.custom-shipping').attr('href', '#custom-shipping').fancybox({
			// 'modal': true
			'height': 420,
			'width': 422,
			'autoDimensions': false
		});
		
		$('a[rel="fancybox"]').fancybox();
		
		var fancybox_settings = {
			// 'modal': true
			'height': 480,
			'width': 450,
			'autoDimensions': false,
			'onComplete': function() {
				
				if(jQuery.fn.validate) {
					$('#fancybox-wrap form').validate({
						submitHandler: function(form) {
							$.fancybox.showActivity();
							
							$(form).find('button').attr('disabled', 'disabled');
							
							$.post( $(form).attr('action'), $(form).serialize(), function(data) {
								$.fancybox.hideActivity();
								
								$('#fancybox-wrap #fancybox-inner').html(data);
								$.fancybox.resize();
								$.fancybox.center();
							});
							return false;
						}
					});
					
					$('form').bind('submit', function() {
						return false;
					});
				}
				
			},
			'onCleanup': function() {
				$('#fancybox-wrap #fancybox-inner').html('');
			}
		};

		$('a.email-link').fancybox(fancybox_settings);

		fancybox_settings.height = 550;
		$('a.request-information').fancybox(fancybox_settings);
		
		$('.email-item div:not(.ignore) label').overlabel();
		
		$('a.email-link, a.request-information').bind('click', function() {
			$(this).attr('href', '?').unbind('click.fb');
		});
		
	}


	// Checkout page add classes
	////////////////////////////////////////
	$("#checkoutPg #cartBox dt:first-child").addClass('hide');
	$("#checkoutPg #cartBox li:nth-child(3)").addClass('last');



	// Contact Form Validate
	////////////////////////////////////////
	if(jQuery.fn.validate) {
		$('#contactForm').validate();
	}


	// Register Form Validate
	////////////////////////////////////////
	if(jQuery.fn.validate) {
	$('#registerForm').validate({
		rules: {
		     shipping_state: 	"required",
			 shipping_zip: 		"required",
			 shipping_phone: 	"required",
		     billing_state: 	"required",
			 billing_zip: 		"required",
			 billing_phone: 	"required"
		   },
		   messages: {
		     shipping_state: 	"Required",
			 shipping_zip: 		"Required",
			 shipping_phone: 	"Required",
		     billing_state: 	"Required",
			 billing_zip: 		"Required",
			 billing_phone: 	"Required"
		   }
		
		});
	}
	
	// lazyload
	if(jQuery.fn.lazyload) {
		$('#shopBox ul li a img').lazyload({
			'effect': "fadeIn"
		});
	}
	
	
	if(jQuery.fn.validate) {
		$('#giftRegisterForm').validate();
	}



// the end of Document Load
///////////////////////////////////////////////////////////////////////
});

$(window).bind('load', function() {
	var duration = 500;
	
	$('.slide img').fadeIn(duration);
	setTimeout(function(){
		
		// Homepage Gallery Cycle
		////////////////////////////////////////
		$('#homePg .slide').cycle({
			fx: 'fade'
		});

	}, duration);

});


 // 	// Overlabel Plugin
	// //////////////////////////////////////
	( function( $ ) {
	    // plugin definition
	    $.fn.overlabel = function( options ) {
	         // build main options before element iteration
	        var opts = $.extend( {}, $.fn.overlabel.defaults, options );
	        var selection = this.filter( 'label[for]' ).map( function() {
	            var label = $( this );
	            var id = label.attr( 'for' );
	            var field = document.getElementById( id );

	           if ( !field ) return;

	            // build element specific options
	            var o = $.meta ? $.extend( {}, opts, label.data() ) : opts;
	            label.addClass( o.label_class );
	            var hide_label = function() { label.css( o.hide_css ) };
	            var show_label = function() { this.value || label.css( o.show_css ) };
	            $( field )
	                 .parent().addClass( o.wrapper_class ).end()
	                 .focus( hide_label ).blur( show_label ).each( hide_label ).each( show_label );
	            return this;
	        } );
	        return opts.filter ? selection : selection.end();
	    };
	    // publicly accessible defaults
	    $.fn.overlabel.defaults = {
	        label_class:   'overlabel-apply',
	        wrapper_class: 'overlabel-wrapper',
	        hide_css:      { 'text-indent': '-10000px' },
	        show_css:      { 'text-indent': '0px', 'cursor': 'text' },
	        filter:        false
	    };
	} )( jQuery );