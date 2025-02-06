function getreport(){
    'use strict';
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	if(from_date==''){
		swal({
			title: "Failed",
			text: "Please select from date",
			type: "error",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		return false;
		}
	if(to_date==''){
		swal({
			title: "Failed",
			text: "Please select To date",
			type: "error",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		return false;
		}
	var myurl = base+"reports/report/purchasereport/";
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: {csrf_test_name: csrf, from_date: from_date, to_date: to_date},
		 success: function(data) {
			 $('#getresult2').html(data);
		 } 
	});
	}