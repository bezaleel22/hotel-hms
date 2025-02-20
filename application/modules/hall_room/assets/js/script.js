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
function hallcancelreservation(id){
	'use strict';
    $("#dayClose").trigger("click");
    var myurl =baseurl+"hall_room/hallroom/cancelreservation"+'/'+id;
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
$("#hallreservationbtn").on("click", function() {
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#booking_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/booking";
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
$("#hallcheckinbtn").on("click", function() {
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#checkin_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/directcheckin";
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
function halleditresrvation(id){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#booking_list").hide();
    $("#checkin_list").hide();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/bookingedit/"+id;
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
function hallprintresrvation(id){
    "use strict";
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/viewdetailsprint/"+id;
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
function editinforhall(id){
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
            $('select.selectpicker').selectpicker();
            $('.basic-single').select2({
                placeholder: "Select Option",
            });
        } 
    });
}
"use strict";
var baseurl = $("#base_url").val();
var image = baseurl+"assets/img/room-setting/room_images.png";
$("#reset").on("click", function(){
    $("#output").attr("src", image);
});
var editLoadFile = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(event.target.files[0]);
  };