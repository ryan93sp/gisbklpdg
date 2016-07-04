var drawingManager;
var all_overlays = [];
var selectedShape;

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

function initialize(){
    var map = new google.maps.Map(document.getElementById('map'),
	{
		center: new google.maps.LatLng(-0.938627, 100.355848),
		zoom: 12,
		mapTypeId: google.maps.MapTypeId.HYBRID
	});
	
	//zoom peta sesuai digitasi
	var bengkel_reg = new google.maps.Data();
	bengkel_reg.loadGeoJson('bengkel_region.php?gid='+gid.value);
	bengkel_reg.setMap(map);
	var bounds = new google.maps.LatLngBounds();
	bengkel_reg.addListener('addfeature', function(e) {
		processPoints(e.feature.getGeometry(), bounds.extend, bounds);
		map.fitBounds(bounds);
	});
	
	//menampilkan drawing manager
    var drawingManager = new google.maps.drawing.DrawingManager({
		//drawingMode: google.maps.drawing.OverlayType.MARKER,
		drawingControl: true,
		drawingControlOptions: {
		position: google.maps.ControlPosition.TOP_CENTER,
		drawingModes: [
			google.maps.drawing.OverlayType.POLYGON
		]
	  }
	});
    drawingManager.setMap(map);

	//event digitasi di google map
	google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event){
		var str_input ='MULTIPOLYGON(((';
		if (event.type == google.maps.drawing.OverlayType.POLYGON) {
			console.log('polygon path array', event.overlay.getPath().getArray());
			i=1;
			$.each(event.overlay.getPath().getArray(), function(key, latlng){
				var lat = latlng.lat();
				var lon = latlng.lng();
				//console.log(lat, lon);
				coor[i] = lon +' '+ lat;
				console.log(coor[i]);
				str_input += lon +' '+ lat +',';
				//console.log(str_input);
				i++;
			});
		}
		console.log(coor[1]);
		drawingManager.setDrawingMode(null);
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
		console.log('the str_input will be:', str_input);
		$("#geom").val(str_input);
		$("#coor").append(str_input);
		
		google.maps.event.addListener(newShape.getPath(), 'set_at', function (key, latlng){
			alert('point changed');
			var lat = latlng.lat();
			var lon = latlng.lng();
			console.log(lat, lon); 
			//polygons.push(event.overlay);
			var polygonBounds = newShape.getPath();
			str_input ='MULTIPOLYGON(((';
			for(var i = 0 ; i < polygonBounds.length ; i++){
				coor[i] = lon +' '+ lat;
				str_input += lon +' '+ lat +',';
				//alert(i);
			}
			str_input = str_input+''+coor[0]+')))';
			console.log('the str_input will be:', str_input);
			$("#geom").val(str_input);
			$("#coor").append('<br>'+str_input);
			});
			
		google.maps.event.addListener(newShape.getPath(), 'insert_at', function () {
			alert('point added');
			var polygonBounds = newShape.getPath();
			str_input ='MULTIPOLYGON(((';
			for(var i = 0 ; i < polygonBounds.length ; i++){
				coor[i] = polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat();
				str_input += polygonBounds.getAt(i).lng() +' '+ polygonBounds.getAt(i).lat() +',';
			}
			str_input = str_input+''+coor[0]+')))';
			console.log('the str_input will be:', str_input);
			$("#geom").val(str_input);
			$("#coor").append('<br>'+str_input);
			});

		// YOU CAN THEN USE THE str_inputs AS IN THIS EXAMPLE OF POSTGIS POLYGON INSERT
		// INSERT INTO your_table (the_geom, name) VALUES (ST_GeomFromText(str_input, 4326), 'Test')
		all_overlays.push(event);
	});
	
	google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
	google.maps.event.addListener(map, 'click', clearSelection);
	google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

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
  if (selectedShape) {
    selectedShape.setMap(null);
  }
}
function deleteAllShape() {
  for (var i = 0; i < all_overlays.length; i++) {
    all_overlays[i].overlay.setMap(null);
  }
  all_overlays = [];
}
google.maps.event.addDomListener(window, 'load', initialize);