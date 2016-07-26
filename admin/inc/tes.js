function initialize() {
    var myLatlng = new google.maps.LatLng(60.629765, 6.424094);
    var myOptions = {
        zoom: 14,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var drawMan = new google.maps.drawing.DrawingManager({
        map: map,
        drawingControl: false,
        polygonOptions: {
            editable: true,
            draggable: true
        }
    });
    
    drawMan.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);

    google.maps.event.addListener(drawMan, 'overlaycomplete', function (event) {
        // When draw mode is set to null you can edit the polygon you just drawed
        drawMan.setDrawingMode(null);
        
        google.maps.event.addListener(event.overlay.getPath(), 'remove_at', function () {
            alert('remove_at triggered');
        });

        google.maps.event.addListener(event.overlay.getPath(), 'set_at', function () {
            console.log('set_at');
        });

        google.maps.event.addListener(event.overlay.getPath(), 'insert_at', function () {
            console.log('insert_at');
        });                

    });
}

window.onload = function () {
    initialize();
};