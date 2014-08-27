
// ================ WYSIWYG JS Plugin ================ 
$( '.wysiwyg' ).ckeditor( function( textarea ) {
	this.config.allowedContent = true;
});


// ================ Date picker ================ 
$('.date').datepicker({
	'format': 'dd/mm/yyyy',
	'autoclose': true,
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



//================== START PRODUCT SET ATTRIBUTE MANAGEMENT ==================
$(function(){
  var treeview = $("#treeattributes");
  treeview.fancytree({
	  extensions: ["dnd"],
	  dnd: {
	        autoExpandMS: 400,
	        focusOnClick: true,
	        preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
	        preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
	        dragStart: function(node, data) {
	          return true;
	        },
	        dragEnter: function(node, data) {
	           return true;
	        },
	        dragDrop: function(node, data) {
	          data.otherNode.moveTo(node, data.hitMode);
	        }
	  },
  });
});
  
$(function(){
	  var treeview = $("#tree");
	  treeview.fancytree({
		  clickFolderMode: 2,
		  activeVisible: true,
		  extensions: ["dnd", "edit"],
		  source: {url: window.location.pathname},
		  childcounter: {
		        deep: true,
		        hideZeros: true,
		        hideExpanded: true
		  },
		  dnd: {
	        autoExpandMS: 400,
	        focusOnClick: true,
	        preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
	        preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
	        dragStart: function(node, data) {
	          if(node.folder){
	        	  return false;
	          }
	          return true;
	        },
	        dragEnter: function(node, data) {
	        	 if(node.parent.folder){ // move simple nodes into the folder elements only
	        		 return false;
	        	 }
	        	
	           return true;
	        },
	        dragDrop: function(node, data) {
	          console.log(data);
	          data.otherNode.moveTo(node, data.hitMode);
	        }
		  },
	
		  edit: {
		      triggerStart: ["f2", "dblclick", "shift+click", "mac+enter"],
		      beforeClose: function(event, data){
		        // Return false to prevent cancel/save (data.input is available)
		      },
		      beforeEdit: function(event, data){
		        // Return false to prevent edit mode
		      },
		      close: function(event, data){
		        // Editor was removed
		      },
		      edit: function(event, data){
		        // Editor was opened (available as data.input)
		      },
		      save: function(event, data){
		        // Save data.input.val() or return false to keep editor open
		        alert("save " + data.input.val());
		      }
		  },
	
	      createNode: function(event, data) {
		    	 if(data.node){
		    		 var key = data.node.key;
		    		 if(!$.isNumeric( key ) && key != "_statusNode"){
			    		 console.log(data.node.key);
				    	 console.log(data.node.title);
		    		 }
		    	 }
		    	 
	      },
	      dblclick: function(event, data) {
	          data.node.toggleSelected();
	          
	      },
  });
});

/* Post the json data */
$("#attributeset").submit(function() {
	var tree = $("#tree").fancytree("getTree");
	var d = tree.toDict(true);
	$("#attributeset").append('<input id="attributes" type="hidden" name="attributes" value=\''+JSON.stringify(d)+'\' />');
});

$("#btnCreate").click(function(event){
    var rootNode = $("#tree").fancytree("getRootNode");
    var name = prompt("What is the group name", "Type the group name here");
    rootNode.addChildren({
      title: name ? name : "New group",
      folder: true
    });
});

$("#btnDelete").click(function(event){
	var attrNode = $("#treeattributes").fancytree("getRootNode");
	var node = $("#tree").fancytree("getActiveNode");
	if( node ){
         $.ajax({
            url : "/admin/product/sets/tree/",
            success: function(data) {
            	if(data.status == "ok"){
                	if(data.isuserdefined == 1){
                		attrNode.addChildren({
                			title: node.title,
                			key: node.key
                		});
                		node.remove();
        	  		}else{
        	  			alert(data.mex);
        	  			return false;
        	  		}
                }
            },
            dataType : "json",
            type : "post",
            data : {
                "action" : "deleteNode",
                "key" : node.key
            }
        });
      }
});

//================== END PRODUCT SET ATTRIBUTE MANAGEMENT ==================



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
