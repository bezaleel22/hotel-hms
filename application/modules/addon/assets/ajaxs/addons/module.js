"use strict";
 $(".delete_item").on('click', function(e){
    e.preventDefault();
    var action_url = $(this).attr('href');
	var csrf = $('#csrfhashresarvation').val();
    var CSRF_TOKEN = $('#csrfhashresarvation').val();
    var base_url = $("#base_url").val();
	
	swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this module and its account transactions!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3085d6",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel plx!",
		  closeOnConfirm: true,
		  closeOnCancel: true
	  },
	  function (isConfirm) {
		  if (isConfirm) {
		  window.location.href = action_url;
		   
		  } else {
			 swal("Cancelled", "Your module file is safe :)", "success");
			
		  }
	  });

 });
 $("#app_redirect").on("click", function(){
	var csrf = $('#csrf_token').val();
	var myurl = baseurl + "addon/module/app_redirect";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
			if(data=="success"){
				window.open('https://play.google.com/store/apps/details?id=com.bdtask.housekeeper', '_blank');
			}else{
				swal({
					title: "Invalid",
					text: "Your information is not valid",
					type: "error",
					confirmButtonColor: "#28a745",
					confirmButtonText: "Ok",
					closeOnConfirm: true
				});
			}
        }
    });
 });