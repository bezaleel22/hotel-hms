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


function flight_info(){
	"use strict";
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var flight_id = $('#flight_id').val();

	$.ajax({
		dataType:"json",
		type: "POST",
		url: base + "transport_facility/transport_setting/flight_datarow",
		data: {
			csrf_test_name:csrf,
			flight_id:flight_id,
			
		},
		success: function(result) {
			console.log(result);
			$('#departure').val(result.departure);
			$('#arrival').val(result.arrival);
		}
	});

}

function showvbooksearch(){
    'use strict';
    $('#hide_report').hide();
    $('#report_show').show();
    var csrf = $('#csrf_token').val();
    var geturl=$("#vbookurl").val();
    
    var start_date=$("#start_date").val();
    var to_date=$("#to_date").val();
        $.ajax({
        type: "POST",
        url: geturl,
        data: {csrf_test_name:csrf, start_date: start_date, to_date: to_date},
        success: function(data) {
            $('#itemlist').html(data);
        } 
   });
   
   }

   function printContentvbook(el)
{
	$('#action').hide();
	$('.action2').hide();
    var divName="printArea";
    var printContents=document.getElementById(divName).innerHTML;
    var originalContents=document.body.innerHTML;
    document.body.innerHTML=printContents;
    window.print();
    document.body.innerHTML=originalContents;
    location.reload();
}





