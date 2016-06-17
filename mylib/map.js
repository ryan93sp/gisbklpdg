var myLatLng = new google.maps.LatLng(-0.938627,100.355848);
var server= 'http://localhost/bengkel/json/';
function inisialisasi(){
		var mapOptions = {
			zoom: 14,
			center: myLatLng,
			mapTypeId: google.maps.MapTypeId.ROAD
		};

		map = new google.maps.Map(document.getElementById('map'), mapOptions); 
		
		geolocation();
		
		var bataspadang = new google.maps.Data();
		var bengkel_reg = new google.maps.Data();
		
		bataspadang.loadGeoJson(server+'padang_polyline.php');
		bengkel_reg.loadGeoJson(server+'bengkel_region.php');
		
		bataspadang.setMap(map);
		bengkel_reg.setMap(map);
}
function geolocation()
	{
	navigator.geolocation.getCurrentPosition(geolocationSuccess,geolocationError);
	} 
	function geolocationSuccess(posisi) 
	{
		var pos=new google.maps.LatLng(posisi.coords.latitude,posisi.coords.longitude);
		var image='image/geomarker.png'
			geomarker = new google.maps.Marker 
	   ({
			map: map,
			position: pos,
			icon: image,
			animation: google.maps.Animation.DROP
		});
			//markerposisi.push(geomarker);
			map.panTo(pos);
		    infowindow = new google.maps.InfoWindow();
		    infowindow.setContent(' Posisi Anda ');
		    infowindow.open(map, geomarker);
		    usegeolocation=true;
	}
		function geolocationError(err)  {
		usegeolocation=false;    
	}

google.maps.event.addDomListener(window, 'load', inisialisasi);