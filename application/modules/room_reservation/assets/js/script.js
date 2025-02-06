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
function cancelreservation(id){
	'use strict';
    $("#dayClose").trigger("click");
	   var myurl =baseurl+"room_reservation/room_reservation/cancelreservation"+'/'+id;
	    var dataString = "id="+id;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			 $('#edit').modal('show');
			 $('select.selectpicker').selectpicker();
		 } 
	});
	}
$(document).ready(function() {
"use strict";
$("#reservationbtn").on("click", function() {
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#booking_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/booking";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#newreservation").html(data);
        }
    });
});
$("#checkinbtn").on("click", function() {
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#checkin_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/directcheckin";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#newreservation").html(data);
        }
    });
});
});
function editresrvation(id){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#booking_list").hide();
    $("#checkin_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/bookingedit/"+id;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#newreservation").html(data);
            if($("#checkin_list").length){
                $("#view_checin").text("");
                $("#view_checin").append("<i class='ti-plus' aria-hidden='true'></i> Check In List");
            }
            $('.selectpicker').selectpicker('refresh');
        }
    });
}
function checkinresrvation(id){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#booking_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/bookingcheckin/"+id;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#newreservation").html(data);
            $('.selectpicker').selectpicker('refresh');
        }
    });
}
function checkoutresrvation(id){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#checkin_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/bookingcheckout/"+id;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#newreservation").html(data);
            $('.selectpicker').selectpicker('refresh');
        }
    });
}
function printresrvation(id){
    "use strict";
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/viewdetailsprint/"+id;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#printreservation").html(data);
            setTimeout(function () {
                $(".print-list").trigger('click');
             }, 100);
        }
    });
}