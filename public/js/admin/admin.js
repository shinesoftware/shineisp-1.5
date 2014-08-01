
/** WYSIWYG JS Plugin*/
$( '.wysiwyg' ).ckeditor( function( textarea ) {
	this.config.allowedContent = true;
});

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
	          /** This function MUST be defined to enable dragging for the tree.
	           *  Return false to cancel dragging of node.
	           */
	          return true;
	        },
	        dragEnter: function(node, data) {
	          /** data.otherNode may be null for non-fancytree droppables.
	           *  Return false to disallow dropping on node. In this case
	           *  dragOver and dragLeave are not called.
	           *  Return 'over', 'before, or 'after' to force a hitMode.
	           *  Return ['before', 'after'] to restrict available hitModes.
	           *  Any other return value will calc the hitMode from the cursor position.
	           */
	          // Prevent dropping a parent below another parent (only sort
	          // nodes under the same parent)
	/*           if(node.parent !== data.otherNode.parent){
	            return false;
	          }
	          // Don't allow dropping *over* a node (would create a child)
	          return ["before", "after"];
	*/
	           return true;
	        },
	        dragDrop: function(node, data) {
	          /** This function MUST be defined to enable dropping of items on
	           *  the tree.
	           */
	          data.otherNode.moveTo(node, data.hitMode);
	        }
	  },
  });
});
  
$(function(){
	  var treeview = $("#tree");
	  treeview.fancytree({
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
          /** This function MUST be defined to enable dragging for the tree.
           *  Return false to cancel dragging of node.
           */
          if(node.folder){
        	  return false;
          }
          return true;
        },
        dragEnter: function(node, data) {
          /** data.otherNode may be null for non-fancytree droppables.
           *  Return false to disallow dropping on node. In this case
           *  dragOver and dragLeave are not called.
           *  Return 'over', 'before, or 'after' to force a hitMode.
           *  Return ['before', 'after'] to restrict available hitModes.
           *  Any other return value will calc the hitMode from the cursor position.
           */
          // Prevent dropping a parent below another parent (only sort
          // nodes under the same parent)
/*           if(node.parent !== data.otherNode.parent){
            return false;
          }
          // Don't allow dropping *over* a node (would create a child)
          return ["before", "after"];
*/
        	 if(node.parent.folder){ // move simple nodes into the folder elements only
           	  return false;
             }
        	
           return true;
        },
        dragDrop: function(node, data) {
          /** This function MUST be defined to enable dropping of items on
           *  the tree.
           */
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
      removeNode: function(event, data) {
          // Optionally release resources
          console.log(data);
      },
  });
});

$("#attributeset").submit(function() {
	// Render hidden <input> elements for active and selected nodes
	$("#tree").fancytree("getTree").generateFormElements();

	alert("POST data:\n" + jQuery.param($(this).serializeArray()));
	// return false to prevent submission of this sample
	return false;
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
	var node = $("#tree").fancytree("getActiveNode");
	if( node ){
		node.remove();
      }else{
        alert("Please select a group.");
      }
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


/* Date picker */
$('.date').datepicker({
	'format': 'dd/mm/yyyy',
	'autoclose': true,
});

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
