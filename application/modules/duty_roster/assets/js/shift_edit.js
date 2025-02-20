
$(document).ready(function(e) {
    'use strict'

  $('.hrmtimepicker2').bootstrapMaterialDatePicker({
    format: ' HH:mm',
    startDate: new Date(),
    shortTime: false,
    date: false,
    time: true,
    monthPicker: false,
    year: false,
    switchOnClick: true,
    
    });
});

function shifttimechk() {
		"use strict";
        var base          = $('#base_url').val();
		var csrf          = $('#csrf_token').val();
		var shift_id      = $('#shift_id').val();
		var leave_from1   = $('#shift_start2').val();
		var leave_to1     = $('#shift_end2').val();
		var shift_starth2 = $('#shift_starth2').val();
		var shift_endh2   = $('#shift_endh2').val();
		var shifttimetotal_h2   = $('#shifttimetotal_h2').val();
        
        function toSeconds(time_str) {
			var parts = time_str.split(':');
			return parts[0] * 3600 + 
			parts[1] * 60; 
		}

		var difference = Math.abs(toSeconds(leave_from1) - toSeconds(leave_to1));
		var h= Math.floor(difference / 3600); 
		var m = Math.floor((difference % 3600) / 60); 
		if(isNaN(h) || isNaN(h)) {
			h = '';
			m = '';
		}else{
			h = h+':';
			m = m;
		}
		$('#shifttimetotal2').val(h+m);
        
        if (leave_from1 > leave_to1) {
            
            $('#shift_start2').val(shift_starth2);
            $('#shift_end2').val(shift_endh2);
            $('#shifttimetotal2').val(shifttimetotal_h2);
            swal({
						title: "Failed",
						text: "Shift End Time Should Larger Then Start Time",
						type: "warning",
						confirmButtonColor: "#28a745",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
         }
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/check_inshiftedit",
			data:{
			   csrf_test_name:csrf,
			   shift_start:leave_from1,
			   shift_end:leave_to1,
               shift_id:shift_id
		   },
		   success: function(data) {
			if (data == 1) {
				$('#shift_start2').val(shift_starth2);
				$('#shift_end2').val(shift_endh2);
				$('#shifttimetotal2').val(shifttimetotal_h2);
                swal({
						title: "Failed",
						text: "Duplicate Shift Time",
						type: "warning",
						confirmButtonColor: "#28a745",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
			}
		   } 
	   });
	}
