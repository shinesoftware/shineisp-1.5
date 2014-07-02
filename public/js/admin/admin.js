
/** WYSIWYG JS Plugin*/
$( '.wysiwyg' ).ckeditor( function( textarea ) {
	this.config.allowedContent = true;
});



function onChangeCountry( that ){
    var countryid   = $(that).val();
    
    $.ajax({
         'url'          : '/location/regions/'+countryid
        ,'dataType'     : 'json'
        ,'success'      : function( data ){
            if( data.success == true ) {
                var regions = $(that).closest('form').find('select[name="address[region_id]"]');
                var province = $(that).closest('form').find('select[name="address[province_id]"]');
                
                if( data.total == 0 ) {
                    regions.attr('disabled','disabled');
                    province.attr('disabled','disabled');
                    regions.empty();
                    province.empty();
                } else {
                	province.removeAttr('disabled');
                    regions.removeAttr('disabled');
                    regions.empty();
                    regions.append('<option value=""></option>');
                    $.each( data.rows, function( key, value ) {
                        regions.append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                    
                }
            }
        }
        
    });
}

function onChangeRegion( that ){
	var regionid   = $(that).val();
	
	$.ajax({
		'url'          : '/location/province/'+regionid
		,'dataType'     : 'json'
			,'success'      : function( data ){
				if( data.success == true ) {
					var province = $(that).closest('form').find('select[name="address[province_id]"]');
					if( data.total == 0 ) {
						province.attr('disabled','disabled');
					} else {
						province.removeAttr('disabled');
						province.empty();
						province.append('<option value=""></option>');
						$.each( data.rows, function( key, value ) {
							province.append('<option value="'+value.id+'">'+value.name+'</option>');
						});
						
					}
				}
			}
	
	});
}
