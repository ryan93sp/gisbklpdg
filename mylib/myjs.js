$(document).ready(function($) {
    "use strict";

    if( $('body').hasClass('navigation-fixed') ){
        $('.off-canvas-navigation').css( 'top', - $('.header').height() );
        $('#page-canvas').css( 'margin-top',$('.header').height() );
    }
});
var $body = $('body');
if( $body.hasClass('map-fullscreen') ) {
    if( $(window).width() > 768 ) {
        $('.map-canvas').height( $(window).height() - $('.header').height() );
    }
    else {
        $('.map-canvas #map').height( $(window).height() - $('.header').height() );
    }
}
$('.map .toggle-navigation').click(function() {
	$('.map-canvas').toggleClass('results-collapsed');
	$('.map-canvas .map').one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
		google.maps.event.trigger(map, 'resize');
	});
});

$(window).resize(function() {
	var bodyheight = $(window).height()-70;
	$("#sidebar").height(bodyheight);
});

function myFunction() {
    var elmnt = document.getElementByClass("items-list");
    var x = elmnt.scrollLeft;
    var y = elmnt.scrollTop;
    document.getElementById ("demo").innerHTML = "Horizontally: " + x + "px<br>Vertically: " + y + "px";
}
//memilih rating
$('.star').click(function(){
	//get the id of star
	var star_id = $(this).attr('id');
	var star_index = $(this).attr("id").split("-")[1];
	$("#rateid").val(star_index);
	//console.log(star_index);
	switch (star_id){
		case "star-1":
			$("#star-1").addClass('star-checked');
			$("#star-2").removeClass('star-checked');
			$("#star-3").removeClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-2":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").removeClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-3":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").removeClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-4":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").addClass('star-checked');
			$("#star-5").removeClass('star-checked');
			break;
		case "star-5":
			$("#star-1").addClass('star-checked');
			$("#star-2").addClass('star-checked');
			$("#star-3").addClass('star-checked');
			$("#star-4").addClass('star-checked');
			$("#star-5").addClass('star-checked');
			break;
	}
});