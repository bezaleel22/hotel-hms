//all js 
function editinfo(id){
	'use strict';
	   var geturl=$("#url_"+id).val();
	   var myurl =geturl+'/'+id;
	    var dataString = "id="+id;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			 $('#edit').modal('show');
			  $('.datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    shortTime: false,
    date: true,
    time: false,
    monthPicker: false,
    year: false,
    switchOnClick: true,
  });
		 } 
	});
	}
function paymentinfos(id){
	'use strict';
	   var geturl=$("#link_"+id).val();
	   var myurl =geturl+'/'+id;
	    var dataString = "id="+id;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.paymentinfo').html(data);
			 $('#pay').modal('show');
		 } 
	});
	}
function editinforoom(id){
	'use strict';
	   var geturl=$("#url_"+id).val();
	   var myurl =geturl+'/'+id;
	    var dataString = "id="+id;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			 $('#edit').modal('show');
			 $('select').selectpicker();
		 } 
	});
	}

$(document).ready(function(){
	'use strict';
	$( "input[type='radio']" ).on( "click", function() {
	var getnationality=$("input:checked" ).val();
	if(getnationality=="foreigner"){
		$("#foreignerinfo").show();

		$("#nationalitycon").prop('required',true);
		$("#passport_no").prop('required',true);
		$("#visa_reg_no").prop('required',true);
		
	}
	else{
		$("#foreignerinfo").hide();
		$("#nationalitycon").prop('required',false);
		$("#passport_no").prop('required',false);
		$("#visa_reg_no").prop('required',false);

		}
	});
});
