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