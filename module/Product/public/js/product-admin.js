$(document).ready(function(){

    $('.multiselect').selectpicker();

	//Handle all the select2 objects
	$(".select2").each(function(){
		select2Factory($(this));
	});

	//Select2 auto-creation
	function select2Factory(select) {
        var prefmultiple = select.attr("data-multiple");

        $.ajax({
            url: select.attr("data-url-search"),
            dataType:'JSON',
            success:function(data){

                //clear the current content of the select
                select.html('');

                //iterate over the data and append a select option
                var id = select.attr('data-field-id');
                var name = select.attr('data-field-list');
                $.each(data, function(key, val){
                    select.append('<option id="' + val[id] + '">' + val[name] + '</option>');
                })
            },
            error:function(){
                //if there is an error append a 'none available' option
                select.html('<option id="-1">none available</option>');
            }
        });
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
		  }
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
