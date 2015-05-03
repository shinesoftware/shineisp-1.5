
// ================ WYSIWYG JS Plugin ================ 

$( '.wysiwyg' ).ckeditor( function( textarea ) {
	this.config.allowedContent = true;
});

// ================ Date picker ================ 

/* START Date Time Picker tool configuration */
$('.date').datetimepicker({
    format: 'd/m/Y',
    minDate: new Date(),
});

//================== START TAB MANAGEMENT ==================

$('.nav-tabs a[href="#tab1"]').tab('show');

//store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#tabs a[href="' + hash + '"]').tab('show');

// ================== END TAB MANAGEMENT ==================

