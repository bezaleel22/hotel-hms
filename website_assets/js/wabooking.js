"use strict"; 
    var baseurl=$('#base_url').val();
    var wanumber = $("#wanumber").val();   
    var wamsg = $("#wamsg").val();   
    var link = "https://api.whatsapp.com/send?phone="+wanumber+"&text="+wamsg+"";
swal({
	        title: "Reservation Successfully Completed",
	        text: "Do you like to send booking information to whatsapp?",
	        type: "success",
	        showCancelButton: true,
	        confirmButtonColor: "#28a745",
	        confirmButtonText: "Yes",
	        cancelButtonText: "No",
	        closeOnConfirm: true,
	        closeOnCancel: true
	    },
	    function (isConfirm) {
	        if (isConfirm) {
	        window.open(link,"_blank");
            window.location.href=baseurl+""
	        } else {
	            window.location.href=baseurl+"";
	        }
	    });