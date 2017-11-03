/** * 
 */

$(function() {

	var baseUrl = document.location.origin;

	$.ajax({
	  url: "public/test/get-operation",
      contentType: "application/json",
      dataType: "json",
	})
	  .done(function( data ) {
		  
		  var myLatlng = new google.maps.LatLng(19.367 , -99.140);
		  var mapOptions = {
		    zoom: 10,
		    center: myLatlng
		  }

		  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		  
		  
		  var locationSimul = {
				  0 : {
					  "lat" : 19.367,
					  "lon" : -99.000
				  },
				  1 : {
					  "lat" : 19.397,
					  "lon" : -99.010
				  },
				  2 : {
					  "lat" : 19.417,
					  "lon" : -99.100
				  },
				  3 : {
					  "lat" : 19.487,
					  "lon" : -99.160
				  },
				  4 : {
					  "lat" : 19.507,
					  "lon" : -99.190
				  },
		  };
		  
		  console.log( locationSimul[0].lat );
		  $.each( data.result.operations , function( key, value ) {
		
			  console.log(value.affiliated_name + ' ' + value.authorization_code + ' ' + value.origin.location.latitude + ' ' + value.origin.location.longitude);
			  console.log(key);
			  
			 // myLatlng = new google.maps.LatLng( value.origin.location.latitude , value.origin.location.longitude );
			  myLatlng = new google.maps.LatLng( locationSimul[key].lat , locationSimul[key].lon  );


			  var marker = new google.maps.Marker({
			      position: myLatlng,
			      title: value.affiliated_name + ' ' + value.authorization_code
			  });

			  // To add the marker to the map, call setMap();
			  marker.setMap(map);
			  
			});
	  });
	
});



