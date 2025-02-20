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
			  $('select').selectpicker();
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
function edithousekeeping(id){
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
			 var date = new Date();
			 date.setDate(date.getDate()-1);
			 $('.datetimepickers').bootstrapMaterialDatePicker({
				 format: 'YYYY-MM-DD HH:mm',
				 startDate: new Date(),
				 shortTime: true,
				 date: true,
				 time: true,
				 monthPicker: false,
				 year: false,
			 })
		 } 
	});
}
function laundrypayment(id){
	'use strict';
		var geturl=$("#url_"+id).val();
		var myurl =geturl+'/'+id;
		var dataString = "id="+id;
			$.ajax({
			type: "GET",
			url: myurl,
			data: dataString,
			success: function(data) {
				$('.paymentinfo').html(data);
				$('#payment').modal('show');
				$('select').selectpicker();
				$('#dayClose').trigger('click');
			} 
	});
}