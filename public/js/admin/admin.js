
// Auto Search 
$('#searchbox').typeahead({
	name: 'searchbox',
	limit: 10, 
	remote: {
        url: '/application/search/index/%QUERY',
        beforeSend: function(xhr){
        	$(".tt-hint").addClass("loading"); 
          },
         filter: function(parsedResponse){
        	  $(".tt-hint").removeClass("loading"); 
              return parsedResponse;
         }
    },
    template: [
		'<p class="repo-name"><i class="fa {{icon}}"></i> <strong>{{value}}</strong><br/>{{keywords}}</p>',
		].join(''),
	engine: Hogan 
}).on("typeahead:selected", function($e, datum){ 
    window.location = datum['url'];
});

$( '.wysiwyg' ).ckeditor();
var editor = $('.wysiwyg').ckeditor().editor;
editor.config.allowedContent = true;  