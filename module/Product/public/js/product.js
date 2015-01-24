$(document).ready(function(){
	
	
	$('.multiselect').selectpicker();
	
	//Handle all the select2 objects
	$(".select2").each(function(){
		$(this).select2(select2Factory($(this)));
	});
	
	//Select2 auto-creation
	function select2Factory(select2) {
		var prefmultiple = select2.attr("data-multiple");
		return {
		 	allowClear: true,
		 	width: "100%",
		 	multiple: prefmultiple,
		     ajax: {
		         url: select2.attr("data-url-search"),
		         dataType: 'json',
		         cache: true,
		         data: function (term, page) {
		             return {
		                 term: term
		             };
		         },
		         results: function (data) {
		             var results = [];
		             $.each(data, function (index, item) {
		                 var id = select2.attr("data-field-id");
		                 var field_data = select2.attr("data-fields-data");
		                 var i, mask, mask_length;
		                 
		                 mask = field_data.split(' ');
		                 mask_length = mask.length;
		
		                 output = '';
		                 for (i = 0; i < mask_length; i++) {
		                     if (i > 0) output += ' ';
		                     field = item[mask[i]];
		                     if (typeof field === 'undefined') {
		                         output += mask[i];
		                     } else {
		                         output += field;
		                     }
		                 }
		                 
		                 results.push({
		                     id: item[id],
		                     text: output
		                 });
		             });
		             return {
		                 results: results
		             };
		         },
		     },
		     initSelection: function (element, callback) {
		         var id = $(element).val();
		         var fieldid = select2.attr("data-field-id");
		         var field_data = select2.attr("data-fields-data");
		         var i, mask, mask_length;
		         var data = [];
		         
		         mask = field_data.split(' ');
		         mask_length = mask.length;
		         
		         $.ajax(select2.attr("data-url-search") + "/id/" + id, {dataType: "json"}).done(function(items) { 
		        	 console.log(items);
		        	 $.each(items, function() {
			         	if (typeof this !== 'undefined') {	
				            	output = '';
				                for (i = 0; i < mask_length; i++) {
				                    if (i > 0) output += ' ';
				                    field = this[mask[i]];
				                    if (typeof field === 'undefined') {
				                        output += mask[i];
				                    } else {
				                        output += field;
				                    }
				                }
				                data.push({id: this[fieldid], text: output });
			         	}
		        	 });
		        	 callback(data);
		         });
		     }
		 };
	}
	
	//================== START PRODUCT ATTRIBUTE MANAGEMENT ==================
	
	if("file" == $("#input").val()){
		$('#uploadopt').attr('class', '');
		$('#uploadopt a').attr('data-toggle', 'tab');
	}else{
		$('#uploadopt').attr('class', 'disabled');
		$('#uploadopt a').attr('data-toggle', 'tab disabled');
	}
	
	$("#input").on('change', function() {
		if(this.value == "file"){
			$('#uploadopt').attr('class', '');
			$('#uploadopt a').attr('data-toggle', 'tab');
		}else{
			$('#uploadopt').attr('class', 'disabled');
			$('#uploadopt a').attr('data-toggle', 'tab disabled');
		}
	});
	
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
});
