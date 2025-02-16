 $( function() {
 	"use strict"; 
	$( ".draggable" ).draggable({
		cursor: "move",
  		stop: function( event, ui ) {
	   var id=event.target.id;
	   var style=$("#"+id).attr('style');
	   var csrf = $('#csrf_token').val();
	   var dataString="ids="+id+"&style="+style+"&csrf_test_name="+csrf;
	    $.ajax({
		 type: "POST",
		 url: baseurl+'ordermanage/restauranttable/updatesetting',
		 data: dataString,
		 success: function(data) {
			
		 } 
	});
	   
	  }});
  }); 
 