
$("#btnCategoryCreate").click(function(event){
    var rootNode = $("#tree").fancytree("getRootNode");
    var name = prompt("What is the category name", "Type the category name here");
    rootNode.addChildren({
      title: name ? name : "New category",
      folder: true
    });
});

$("#btnCategoryDelete").click(function(event){
	var attrNode = $("#treeattributes").fancytree("getRootNode");
	var node = $("#tree").fancytree("getActiveNode");
	if( node ){
         $.ajax({
            url : "/admin/category/sets/tree/",
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

$(function(){
	  var treeview = $("#categorytree");
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
	        	 // return false;
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
