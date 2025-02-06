function editwidget(id){
	'use strict';
	$("#area").show();
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	 var myurl =base+'dashboard/web_setting/updatewidget/'+id;
	  $.ajax({
		 type: "POST",
		 url: myurl,
		 data: {csrf_test_name: csrf, id: id},
		 success: function(data) {
			 tinymce.remove();
			$('#updatecontent').html(data);
			
		 } 
		});
	}
