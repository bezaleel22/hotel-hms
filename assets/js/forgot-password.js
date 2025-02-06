'use strict';
var baseurl=$('#base').val();
$('#sent').hide();
$('#sent1').hide();
$('#otp_btn').hide();
$('#reset_btn').hide();
$('#login_btn').hide();
$('#new_password').hide();
function forgot_password(){
    'use strict';
	var forgot= $("#inputEmail").val();
	if(forgot==''){
		swal({
            title: "Error",
            text: "Please Write Email!!",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		return false;
		}
	var csrf = $('#csrf_token').val();
	var myurl=baseurl+"dashboard/auth/forgot_check";
	$.ajax({
		url: myurl,
		 type: "POST",
		 data: {csrf_test_name: csrf, forgot: forgot},
		 success: function(data) {
		$("#inputEmail").val('');
		var obj =JSON.parse(data);
		$('#status').val(obj.status);
		$('#msg').val(obj.msg);
		if(obj.status=='false'){
		$('#sent').show();
		$('#msg_email').text(obj.msg);
		}else{
			$('#main_email').hide();
			$('#email_btn').hide();
			$("#otp_btn").show();
			$('#sent1').show();
			$('#sent').show();
			$('#msg_email').text(obj.msg);
			$('#hemail').val(obj.email);
		}
		} 
	  });
}
function submit_code(){
	'use strict';
	var forgot= $("#code").val();
	var hemail= $("#hemail").val();
	if(forgot==''){
		swal({
            title: "Error",
            text: "Please Write Code...",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		return false;
		}
	var csrf = $('#csrf_token').val();
	var myurl=baseurl+"dashboard/auth/check_code";
	$.ajax({
		url: myurl,
		 type: "POST",
		 data: {csrf_test_name: csrf, forgot: forgot, hemail:hemail},
		 success: function(data) {
		$("#code").val('');
		var obj =JSON.parse(data);
		$('#status').val(obj.status);
		$('#msg').val(obj.msg);
		if(obj.status=='false'){
		$('#sent').show();
		$('#msg_email').text(obj.msg);
		}else{
			$('#otp_btn').hide();
			$('#sent1').hide();
			$('#msg_email').text(obj.msg);
			$('#new_password').show();
			$('#reset_btn').show();
		}
		 } 
	  });
}
function reset_password(){
	'use strict';
	var forgot= $("#new_pass").val();
	var hemail= $("#hemail").val();
	if(forgot==''){
		swal({
            title: "Error",
            text: "Please Write New Password...",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		return false;
		}
	var csrf = $('#csrf_token').val();
	var myurl=baseurl+"dashboard/auth/new_password";
	$.ajax({
		url: myurl,
		 type: "POST",
		 data: {csrf_test_name: csrf, forgot: forgot, hemail:hemail},
		 success: function(data) {
		$("#new_pass").val('');
		var obj =JSON.parse(data);
		$('#status').val(obj.status);
		$('#msg').val(obj.msg);
		if(obj.status=='false'){
		$('#sent').show();
		$('#msg_email').text(obj.msg);
		}else{
			$('#new_password').hide();
			$('#reset_btn').hide();
			$('#login_btn').show();
			$('#msg_email').text(obj.msg);
		}
		 } 
	  });
}
