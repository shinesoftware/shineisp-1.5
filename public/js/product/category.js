$(function(){
	  var treeview = $("#categorytree");
	  treeview.fancytree({
		  clickFolderMode: 3,
		  activeVisible: true,
		  extensions: ["dnd", "edit"],
		  source: {url: '/admin/category/load'},
		  childcounter: {
		        deep: true,
		        hideZeros: true,
		        hideExpanded: true
		  },
		  dnd: {
	        autoExpandMS: 400,
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
	          var nodeKey = 0;
	          
	          if (node.getLevel() == 1 && (data.hitMode == 'after' || data.hitMode == 'before')) {
	        	  nodeKey = 0;
	          }else{
	        	  nodeKey = data.node.key;
	          }
	          
	          $.ajax({
	                 url : "/admin/category/move/" + data.otherNode.key + '/' + nodeKey,
	                 success: function(data) {
	                 	if(data.status == "ok"){
	                 		alert('saved');
	                     }
	                 },
	                 dataType : "json",
	                 type : "get",
	             });
	          data.otherNode.moveTo(node, data.hitMode);
	        }
		  },
	
		  edit: {
		      save: function(event, data){
		    	  $.getJSON( "/admin/category/add/" + data.input.val(), function( data ) {
		    		  
		          });
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
	      click: function(event, data) {
	    	  var id = data.node.key.replace("_", "");
	    	  
	    	  $.getJSON( "/admin/category/get/" + id, function( data ) {
	    		  $("input[name='id']").val(data.id);
	    		  $("input[name='name']").val(data.name);
	    		  $("input[name='slug']").val(data.slug);
	    		  $("input[name='description']").val(data.description);
	          });
	      }
  });
	  

	  $("#btnCatCreate").click(function(event){
	      var rootNode = $("#categorytree").fancytree("getActiveNode");
	      if(!rootNode){
		      var rootNode = $("#categorytree").fancytree("getRootNode");
	      }
	      
	      if (rootNode.getLevel() >= 2){
	    	  alert('Only two levels are allowed!');
	      }else{
			  
		      var name = prompt("What is the category name", "Type the category name here");
		      
		      $.getJSON( "/admin/category/add/" + name + "/" + rootNode.key, function( data ) {
		    	  rootNode.addChildren({
		  	        title: name ? name : "New category",
		  	        key: data.id,
		  	        folder: true
		  	      });
	          });
	      } 
	    
	  });

	  $("#btnCatDelete").click(function(event){
	  	var node = $("#categorytree").fancytree("getActiveNode");
	  	if( node ){
	  		   $.getJSON( "/admin/category/delete/" + node.key, function( data ) {
	              	node.remove();
	          });
	        }
	  });
});
