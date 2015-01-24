
// Auto Search 
$('#searchbox').typeahead({
	name: 'searchbox',
	limit: 10, 
	remote: {
        url: '/search/query/%QUERY',
        beforeSend: function(xhr){
        	$(".tt-hint").addClass("loading"); 
          },
         filter: function(parsedResponse){
        	  $(".tt-hint").removeClass("loading"); 
              return parsedResponse;
         }
    },
    template: [
		'<p class="repo-name"><i class="fa {{icon}}"></i> {{value}}<br/><small>{{keywords}}</small></p>',
		].join(''),
	engine: Hogan 
}).on("typeahead:selected", function($e, datum){ 
    window.location = datum['url'];
});


// Navbar Shrink Style
var cbpAnimatedHeader = (function() {

	var docElem = document.documentElement,
		header = document.querySelector( '.navbar-default' ),
		didScroll = false,
		changeHeaderOn = 300;

	function init() {
		window.addEventListener( 'scroll', function( event ) {
			if( !didScroll ) {
				didScroll = true;
				setTimeout( scrollPage, 250 );
			}
		}, false );
	}

	function scrollPage() {
		var sy = scrollY();
		if ( sy >= changeHeaderOn ) {
			classie.add( header, 'navbar-shrink' );
		}
		else {
			classie.remove( header, 'navbar-shrink' );
		}
		didScroll = false;
	}

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	init();

})();
