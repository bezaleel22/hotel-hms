"use strict";
var baseurl = $("#base_url").val();
  // JavaScript Document
  $("#dayClose").on("click", function(){
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
					$('#pay').attr('hidden',false);
					$('#payment').attr('hidden',false);
					$('#PaymentMOdal').attr('hidden',false);
					$('#edit').attr('hidden',false);
				  return false; 
				}
				$('#pay').attr('hidden',true);
			  	$('#payment').attr('hidden',true);
			  	$('#PaymentMOdal').attr('hidden',true);
			  	$('#edit').attr('hidden',true);
				$('#add0').modal('hide');
				$('#openclosecash').html(data);
				$('#openregister').modal({
					backdrop: 'static',
					keyboard: false
				});
			  }
		  });
	$("#previous").on("click", function() {
		var url = $(location).attr('href').split("/").splice(5, 5).join("/");
		if(url == "supplier-list" | url == "customer-list" | url == "employee-payment" | url == "payment_record" | url == "product-destroyed"){
			$("#openregister").modal('hide');
			$('.modal').modal('hide');
		}
	});
});
function opencashregister(){
	var form = $('#cashopenfrm')[0];
		var formdata = new FormData(form);
        $.ajax({
        type: "POST",
        url: baseurl+"day_closing/cashregister/addcashregister",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
			if(data==1){
				$("#openregister").modal('hide');
				$('.modal').modal('hide');
			}
			else{
				swal({
					title: "Warning",
					text: "Something Wrong!!! .Please Select Counter Number!!",
					type: "warning",
					confirmButtonColor: "#28a745",
					confirmButtonText: "Ok",
					closeOnConfirm: true
				});
				}
        }
  
    });
	}
function closeopenresister(){
var closeurl=baseurl+"day_closing/cashregister/cashregisterclose";
var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		async: false,
		url: closeurl,
		data:{csrf_test_name:csrf},
		success: function(data) {
			$('#openclosecash').html(data);
			var htitle=$("#rpth").text();
			var counter=$("#pcounter").val();
			var puser=$("#puser").val();
			var fullheader = "Cash Register In"+htitle+"\n" + "Counter:"+counter+"\n"+puser;
			$("#openregister").modal('show');
			$('#RoleTbl').DataTable({ 
			responsive: true, 
			paging: true,
			dom: 'Bfrtip',
			"lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
			buttons: [  
				{extend: 'csv', title: 'Day Closing Cash Register', className: 'btn-sm prints',footer: true,header: true,orientation: 'landscape',messageTop: fullheader, exportOptions:{columns: ':visible'}}, 
				{extend: 'excel', title: 'Day Closing Cash Register', className: 'btn-sm prints', title: 'exportTitle',messageTop: fullheader,footer: true,header: true,orientation: 'landscape', exportOptions:{columns: ':visible'}}, 
				{extend: 'pdfHtml5', title: 'Day Closing Cash Register',className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true,header: true,orientation: 'landscape',messageTop: fullheader,customize: function (doc) {
					doc.defaultStyle.alignment = 'center';
					doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}
				} 
			],
			"searching": true,
				"processing": true,
			
				});
		}
	});
	
}
function closecashregister(){
	var form = $('#cashopenfrm')[0];
	var formdata = new FormData(form);
	$.ajax({
	type: "POST",
	url: baseurl+"day_closing/cashregister/closecashregister",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		if(data==1){
		$("#openregister").modal('hide');
		window.location.href=baseurl+"dashboard/home";
		}else{
			alert("Something Wrong On Cash Closing!!!");
			}
	}
 });
}