"use strict";
var baseurl = $("#base_url").val();
  // JavaScript Document
  $( window ).on("load", function() {
	// Run code
	 "use strict";
	var myurl=baseurl+"day_closing/cashregister/checkcashregister";
	var csrf = $('#csrf_token').val();
	$.ajax({
			  type: "POST",
			  data:{csrf_test_name:csrf},
			  async: false,
			  url: myurl,
			  success: function(data) {
			  if(data==1){
				  return false; 
				}
				 $('#openclosecash').html(data);
				 $('#openregister').modal({
					backdrop: 'static',
					keyboard: false
				});
			  }
		  });
	$("#previous").on("click", function() {
            window.location.href=baseurl+"dashboard/home";
	});
});