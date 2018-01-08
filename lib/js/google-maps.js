var geocoder;
var flair_map_style;

$(document).ready(function() {
	setupGmaps();
	
	$('.google-maps').each(function(n) {
		$(this).addClass('google-maps-' + n);
		
		// showSpot( $(this).attr('title'), $(this).get(0), ( n == 0 ? true : false ), $(this).html() );
		// alert( $(this).attr('title') );
		setCenter(
		  $(this).get(0), // what element?
		  $(this).attr('title').replace(new RegExp( "\\n", "g" ), ''), // where you hear that. -- address.
		  ( n == 0 ? 'large' : 'small' ) // size? -- for different flair icons
		);
	});
});

function setupGmaps() {
	geocoder = new google.maps.Geocoder();
	
	
	flair_map_style = [{
	  // Reset
	  featureType: "all",
	  elementType: "all",
	  stylers: [{
	    hue: "#282828"
	  },{
	    lightness: -20
	  },{
	    saturation: -100
	  }]
	},
	{
	  // Water
	  featureType: "water",
	  elementType: "all",
	  stylers: [{
	    hue: "#FFFFFF"
	  },{
	    lightness: -40
	  },{
	    saturation: -100
	  }]
	},
	{
	  // Landscape Labels
	  featureType: "landscape",
	  elementType: "labels",
	  stylers: [{
	    visibility: "off"
	  }]
	},{
	  // Landscape Global
	  featureType: "landscape",
	  elementType: "all",
	  stylers: [{
	    hue: "#cccccc"
	  },{
	    lightness: 100
	  },{
	    saturation: 0
	  }]
	}];
}

function setCenter( elem, address, size ) {

	if (geocoder) {
		geocoder.geocode( { 'address': address }, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				
				var map = new google.maps.Map(elem, {
					zoom: 15,
					center: results[0].geometry.location,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					
					mapTypeControl: false,
					navigationControl: true,
					navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
				});
				
				var styledMapOptions = {
					map: map,
					name: "flair"
			  };

			  var flair_map_type =  new google.maps.StyledMapType(flair_map_style, styledMapOptions);
			  map.mapTypes.set('flair', flair_map_type);
			  map.setMapTypeId('flair');
				
				if( size == 'large' ) {
					var image = new google.maps.MarkerImage(
						'http://flair.verbsite.com/images/marker-icon-large.png',
						new google.maps.Size(136, 136), // marker size
						new google.maps.Point(0,0), // origin
						new google.maps.Point(68, 68) // anchor
					);	
				} else {
					var image = new google.maps.MarkerImage(
						'http://flair.verbsite.com/images/marker-icon.png',
						new google.maps.Size(73, 73), // marker size
						new google.maps.Point(0,0), // origin
						new google.maps.Point(36, 36) // anchor
					);
				}

				var marker = new google.maps.Marker({
					map: map, 
					position: results[0].geometry.location,
					icon: image
				});
				
				google.maps.event.addListener(marker, 'click', function() {
					// window.location.href = 'http://maps.google.com/maps?q=' + escape( address );
					window.open( 'http://maps.google.com/maps?q=' + escape( address ) );
				});
				
			} else {

				alert("Geocode was not successful for the following reason: " + status);

			}
		});
	}

}