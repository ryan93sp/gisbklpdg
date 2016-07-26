var map;
var drawingManager;
var selectedShape;
var markers = [];

function processPoints(geometry, callback, thisArg) {
  if (geometry instanceof google.maps.LatLng) {
    callback.call(thisArg, geometry);
  } else if (geometry instanceof google.maps.Data.Point) {
    callback.call(thisArg, geometry.get());
  } else {
    geometry.getArray().forEach(function(g) {
      processPoints(g, callback, thisArg);
    });
  }
}
function clearSelection() {
  if (selectedShape) {
    selectedShape.setEditable(false);
    selectedShape = null;
  }
}
function setSelection(shape) {
  clearSelection();
  selectedShape = shape;
  shape.setEditable(true);
}
function deleteSelectedShape() {
  $("#geom").val('');
  if (selectedShape) {
    selectedShape.setMap(null);
  }
  drawingManager.setOptions({
    drawingControl: true
  });
}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}
// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
	$('#hidem').remove();
	$('#floating-panel').append('<button id="showm" onclick="showMarkers()" type="button">Show marker</button>');
	
}
// Shows any markers currently in the array.
function showMarkers() {
	setMapOnAll(map);
	$('#showm').remove();
	$('#floating-panel').append('<button id="hidem" onclick="clearMarkers()" type="button">Hide marker</button>');
}
function hideReg() {
	bengkel_reg.setMap(null);
	$('#hider').remove();
	$('#regedit').append('<button class="btn btn-default btn-xs" id="showr" onclick="showReg()"><i class="fa fa-eye-slash"></i> Show region</button>');
}
function showReg() {
	bengkel_reg.setMap(map);
	$('#showr').remove();
	$('#regedit').append('<button class="btn btn-default btn-xs" id="hider" onclick="hideReg()"><i class="fa fa-eye-slash"></i> Hide Region</button>');
}

function initialize(){
    map = new google.maps.Map(document.getElementById('map'),{
		center: new google.maps.LatLng(-0.938627, 100.355848),
		zoom: 12,
		mapTypeId: google.maps.MapTypeId.SATELLITE,
		disableDefaultUI: true,
		zoomControl: true,
		mapTypeControl: true
	});
	
	//mencari lokasi dengan latlng
	var geocoder = new google.maps.Geocoder;
	var infowindow = new google.maps.InfoWindow;
    document.getElementById('btnlatlng').addEventListener('click', function() {
        geocodeLatLng(geocoder, map, infowindow);
    });
    function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              map.setZoom(20);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
			  map.setCenter(latlng);
			  markers.push(marker);
              /* infowindow.setContent(results[1].formatted_address);
              infowindow.open(map, marker); */
			  $('#showm,#hidem').remove();
			  $('#floating-panel').append('<button id="hidem" onclick="clearMarkers()" type="button">Hide marker</button>');
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
    }
	
	//zoom peta sesuai digitasi
	bengkel_reg = new google.maps.Data();
	bengkel_reg.loadGeoJson('act/bengkel_region.php?gid='+gid.value);
	bengkel_reg.setMap(map);
	bengkel_reg.setStyle({
		fillColor: 'red',
		strokeColor: 'red'
	});
	var bounds = new google.maps.LatLngBounds();
	bengkel_reg.addListener('addfeature', function(e) {
		processPoints(e.feature.getGeometry(), bounds.extend, bounds);
		map.fitBounds(bounds);
	});
	
	var polyOptions = {
	fillColor: 'blue',
	strokeColor: 'blue',
	draggable: true
	};
	
	//menampilkan drawing manager
    drawingManager = new google.maps.drawing.DrawingManager({
		//drawingMode: google.maps.drawing.OverlayType.POLYGON,
		//drawingControl: true,
		drawingControlOptions: {
		position: google.maps.ControlPosition.TOP_LEFT,
		drawingModes: [
			google.maps.drawing.OverlayType.POLYGON
		]
		},
		polygonOptions: polyOptions,
		map: map
	});

	//event digitasi di google map
	google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event){
		if (event.type == google.maps.drawing.OverlayType.POLYGON) {
			//console.log('polygon path array', event.overlay.getPath().getArray());
			var str_input ='MULTIPOLYGON(((';
			i=1;
			$.each(event.overlay.getPath().getArray(), function(key, latlng){
				var lat = latlng.lat();
				var lon = latlng.lng();
				coor[i] = lon +' '+ lat;
				//console.log(coor[i]);
				str_input += lon +' '+ lat +',';
				i++;
			});
			drawingManager.setDrawingMode(null);
			drawingManager.setOptions({
				drawingControl: false
			});
			// Add an event listener that selects the newly-drawn shape when the user
			// mouses down on it.
			var newShape = event.overlay;
			newShape.type = event.type;
			google.maps.event.addListener(newShape, 'click', function() {
				setSelection(newShape);
			});
			setSelection(newShape);
		
			//str_input = str_input.substr(0,str_input.length-1) + '))';
			str_input = str_input+''+coor[1]+')))';
			//console.log('the str_input will be:', str_input);
			$("#geom").val(str_input);
		
		}
		google.maps.event.addListener(newShape.getPath(), 'set_at', function (key, latlng){
			//alert('point changed');
			var polygonBounds = newShape.getPath();
			str_input ='MULTIPOLYGON(((';
			for(var i = 0 ; i < polygonBounds.length ; i++){
				coor[i] = polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat();
				str_input += polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat() +',';
				//alert(i);
			}
			str_input = str_input+''+coor[0]+')))';
			//console.log('the str_input will be:', str_input);
			$("#geom").val(str_input);
			});
			
		google.maps.event.addListener(newShape.getPath(), 'insert_at', function () {
			//alert('point added');
			var polygonBounds = newShape.getPath();
			str_input ='MULTIPOLYGON(((';
			for(var i = 0 ; i < polygonBounds.length ; i++){
				coor[i] = polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat();
				str_input += polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat() +',';
			}
			str_input = str_input+''+coor[0]+')))';
			//console.log('the str_input will be:', str_input);
			$("#geom").val(str_input);
			});

		// YOU CAN THEN USE THE str_inputs AS IN THIS EXAMPLE OF POSTGIS POLYGON INSERT
		// INSERT INTO your_table (the_geom, name) VALUES (ST_GeomFromText(str_input, 4326), 'Test')
	});
	
	google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
	google.maps.event.addListener(map, 'click', clearSelection);
	google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

}
google.maps.event.addDomListener(window, 'load', initialize);