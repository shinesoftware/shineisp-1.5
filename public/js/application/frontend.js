
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
