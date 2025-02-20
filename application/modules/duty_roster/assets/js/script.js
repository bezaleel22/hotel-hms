//all js 
function editinfo2(id, cldate){
	'use strict'
	   var geturl=$("#url_"+id).val();
	   var myurl =geturl+'/'+id+'/'+cldate;
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

    function changestatus3(stcode, table, id, fieldname) {
        "use strict";
        var base = $('#base_url').val();
        var csrf = $('#csrf_token').val();
    
        $.ajax({
            type: "POST",
            url: base + "pool_booking/pool_setting/changestatus",
            data: {
                csrf_test_name:csrf,
                scode:stcode,
                tname:table,
                id:id,
                fieldname:fieldname
            },
            success: function(data) {
                location.reload();
            }
        });
    
    }

	$(document).ready(function() {

		$('.hrmtimepicker').bootstrapMaterialDatePicker({
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

	// attendance_dashboard_view start
    $(document).ready(function() {
        $('.shiftdate').daterangepicker({
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true,
            minDate: 1901,
            maxDate: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            
        });

        shiftdata();

});
    function shiftdata(){
		"use strict";
		var base 	   = $('#base_url').val();
		var csrf 	   = $('#csrf_token').val();
        $.ajax({
                type: "POST",
                url: base+"duty_roster/Shift_management/loadallshift",
                data:{
                csrf_test_name:csrf,
            },
            success: function(data) {
                $('#main_data').html(data);
            } 
        });
	}

    function cngdata(){
        "use strict";
        
        var cngedate= $('#changedrsdate').val();
        var date    = new Date(cngedate),
        yr          = date.getFullYear(),
        newmonth    = date.getMonth() + 1,
        month       = newmonth < 10 ? '0' + newmonth : newmonth,
        day         = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
        newDate     = yr + '-' + month + '-' + day;
        var date2   = new Date(),
        yr          = date2.getFullYear(),
        newmonth2   = date2.getMonth() + 1,
        month2      = newmonth2 < 10 ? '0' + newmonth2 : newmonth2,
        day2        = date2.getDate()  < 10 ? '0' + date2.getDate()  : date2.getDate(),
        crntDate    = yr + '-' + month2 + '-' + day2;
       
        var base 	= $('#base_url').val();
        var csrf 	= $('#csrf_token').val();
        var cndate  = newDate;
        $.ajax({
                type: "POST",
                url: base+"duty_roster/Shift_management/loadcngdate",
                data:{
                csrf_test_name:csrf,
                cndate:cndate,
            },
            success: function(data) {
                $('#main_data').hide().html(data).fadeIn();
            } 
        });
    }
	// attendance_dashboard_view end

	// attenshift_view start
	
	function clickedshift(id) {
		"use strict";
		$('#pills-tabContent').hide();

		var cngedate 	   = $('#changedrsdate').val();
		var date    = new Date(cngedate),
		yr      = date.getFullYear(),
		newmonth   = date.getMonth() + 1,
		month   = newmonth < 10 ? '0' + newmonth : newmonth,
		day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
		newDate = yr + '-' + month + '-' + day;

		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var clk_shiftid = $('#clk_shiftid_'+id).val();
		
		
		$.ajax({
			type: "POST",

			url: base + "duty_roster/Shift_management/load_clkshftemp",
			data: {
				csrf_test_name: csrf,
				clk_shiftid: clk_shiftid,
				clickdate: newDate,
			},
			success: function(data) {
				$('#empdatashow').hide().html(data).fadeIn();

			}
		});

	}
	// attenshift_view End

	$(document).on("change", "#shift_id", function(){
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var shift_id  = $('#shift_id').val();
		
	
		$.ajax({
			 type: "POST",
			 dataType: "json",
			 
			 url: base+"duty_roster/Shift_management/shiftrowdata",
			 data:{
				csrf_test_name:csrf,
				shift_id:shift_id
				
			},
	
			success: function(data) {
				
				$('#start_time').val(data.shift_start);
				$('#end_time').val(data.shift_end);
				
			} 
		});

		
		
	});
	$(document).on("change", "#roster_id", function(){
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var roster_id  = $('#roster_id').val();
		$.ajax({
			 type: "POST",
			 dataType: "json",
			 url: base+"duty_roster/Shift_management/rosterrowdata",
			 data:{
				csrf_test_name:csrf,
				roster_id:roster_id
			},
			success: function(data) {
				$('#rstr_start_date').val(data.roster_start);
				$('#rstr_end_date').val(data.roster_end);
				$('#rstr_start_time').val(data.shift_start);
				$('#rstr_end_time').val(data.shift_end);
			} 
		});

	});

	function rosterdatechk(){
		"use strict";
		
		var base 	   = $('#base_url').val();
		var csrf 	   = $('#csrf_token').val();
		var start_date = $('#roster_start_date').val();
		var end_date   = $('#roster_end_date').val();
		$.ajax({
			type: "POST",
			
			url: base+"duty_roster/Shift_management/checkshift_data",
			data:{
			csrf_test_name:csrf,
			start_date:start_date,
			end_date:end_date,
		},
			success: function(data) {
				if (data == 1) {
					
					$('#roster_start_date').val('');
					$('#roster_end_date').val('');
					$('#roster_days').val('');
					$(".submitrosterbtn").prop('disabled', true);
					swal({
						title: "Failed",
						text: "This schedule is Already Taken",
						type: "warning",
						confirmButtonColor: "#28a745",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
					
				}else{
					var roster_days = $('#roster_days').val();
					if (roster_days < 0 ) {
						$('#roster_start_date').val('');
						$('#roster_end_date').val('');
						$('#roster_days').val('');
						swal({
							title: "Failed",
							text: "Please Reset Your Roster",
							type: "warning",
							confirmButtonColor: "#28a745",
							confirmButtonText: "Ok",
							closeOnConfirm: true
						});
					}
				}
			} 
		});
	}

	function rosterdatechk2(){
		"use strict";
		var base 	   = $('#base_url').val();
		var csrf 	   = $('#csrf_token').val();
		var start_date = $('#roster_start_date').val();
		var end_date   = $('#roster_end_date').val();
		
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/checkshift_data2",
			data:{
				csrf_test_name:csrf,
				start_date:start_date,
				end_date:end_date,
			},
			success: function(data) {
				if (data == 1) {
					
					$('#roster_start_date').val('');
					$('#roster_end_date').val('');
					$('#roster_days').val('');
					$(".submitrosterbtn").prop('disabled', true);
					swal({
						title: "Failed",
						text: "This schedule is Already Taken",
						type: "warning",
						confirmButtonColor: "#28a745",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
				}else{
					var roster_days = $('#roster_days').val();
					if (roster_days < 0 ) {
						$('#roster_start_date').val('');
						$('#roster_end_date').val('');
						$('#roster_days').val('');
						swal({
							title: "Failed",
							text: "Please Reset Your Roster",
							type: "warning",
							confirmButtonColor: "#28a745",
							confirmButtonText: "Ok",
							closeOnConfirm: true
						});
					}
				}
			} 
		});
		
	}

	function shifttimechk() {
		"use strict";
		var leave_from1  = $('#shift_start').val();
		var leave_to1  = $('#shift_end').val();

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

		$('#shifttimetotal').val(h+m);

		if ($('#shift_start').val() !=''&& $('#shift_end').val() !=''&& $('#shifttimetotal').val() !=''&& $('#shift_name').val() !='') {
			$(".submitshiftbtn").prop('disabled', false);
		}else{
			$(".submitshiftbtn").prop('disabled', true);
		}
	}

	function rostdaychk() {
		"use strict";
		var roster_days = '';
		var roster_start_date  = '';
		var roster_end_date  = '';
		roster_start_date  = new Date($('#roster_start_date').val());
		roster_end_date  = new Date($('#roster_end_date').val());
		var Difference_In_Time = roster_end_date.getTime() - roster_start_date.getTime();
		var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
		if(isNaN(Difference_In_Days)) {
			roster_days;
			}else{
				if (Difference_In_Days < 0) {
					
					roster_days = Difference_In_Days;
				}else{
					roster_days = Difference_In_Days+1;

				}
			}
		$('#roster_days').val(roster_days);

		if ($('#roster_shift_id').val() !=''&& $('#roster_start_date').val() !=''&& $('#roster_end_date').val() !=''&& $('#roster_days').val() !='') {
			$(".submitrosterbtn").prop('disabled', false);
		}else{
			$(".submitrosterbtn").prop('disabled', true);
		}
	}

	$(document).on("change", "#roster_id", function(){
		
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var roster_id  = $('#roster_id').val();
		
		$.ajax({
			 type: "POST",
			 url: base+"duty_roster/Shift_management/empdatashow",
			 data:{
				csrf_test_name:csrf,
				roster_id:roster_id
			},
			success: function(data) {
				
				
				$('#employeedatalistshow').hide().html(data).fadeIn();
				
			} 
		});

	});

	function checkduplicateshift(){
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var shift_start  = $('#shift_start').val();
		var shift_end  = $('#shift_end').val();
		if (shift_end !='') {
			if (shift_start >= shift_end) {
				$('#shift_start').val("");
				$('#shift_end').val("");
				$('#shifttimetotal').val("");
				$("#shift_end").prop('disabled', true);
				swal({
					title: "Failed",
					text: "Shift End Time Should Larger Then Start Time",
					type: "warning",
					confirmButtonColor: "#28a745",
					confirmButtonText: "Ok",
					closeOnConfirm: true
				});
			}
		}
		
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/chkduplicateshift",
			data:{
			   csrf_test_name:csrf,
			   shift_start:shift_start
		    },
		    success: function(data) {
			    if (data == 1) {
					$('#shift_start').val("");
					$('#shift_end').val("");
					$('#shifttimetotal').val("");
					$("#shift_end").prop('disabled', true);
					swal({
						title: "Failed",
						text: "Duplicate Shift Time",
						type: "warning",
						confirmButtonColor: "#28a745",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
					
				}
				if ($('#shift_start').val() != '') {
					$("#shift_end").prop('disabled', false);
					$('.hrmtimepickernew').bootstrapMaterialDatePicker({
						format: ' HH:mm',
						startDate: new Date(),
						shortTime: false,
						date: false,
						time: true,
						monthPicker: false,
						year: false,
						switchOnClick: true,
						});
				}
		   	} 
	   });
	}

	function checkduplicateshift2(){
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var shift_end  = $('#shift_end').val();
		var shift_start  = $('#shift_start').val();
		if (shift_start >= shift_end) {
			$('#shift_start').val("");
			$('#shift_end').val("");
			$('#shifttimetotal').val("");
			$("#shift_end").prop('disabled', true);
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
			url: base+"duty_roster/Shift_management/chkduplicateshift2",
			data:{
			   csrf_test_name:csrf,
			   shift_end:shift_end
		    },
		    success: function(data) {
				if (data == 1) {
					$('#shift_start').val("");
					$('#shift_end').val("");
					$('#shifttimetotal').val("");
					$("#shift_end").prop('disabled', true);
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

	function check_inshift(){
		"use strict";
		var base = $('#base_url').val();
		var csrf = $('#csrf_token').val();
		var shift_start  = $('#shift_start').val();
		var shift_end  = $('#shift_end').val();
	
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/check_inshift",
			data:{
			   csrf_test_name:csrf,
			   shift_start:shift_start,
			   shift_end:shift_end
		   },
		   success: function(data) {
			if (data == 1) {
				$('#shift_start').val("");
				$('#shift_end').val("");
				$('#shifttimetotal').val("");
				$("#shift_end").prop('disabled', true);
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

	$(document).on("keyup", "#shift_name", function(){
		if ($('#shift_start').val() !=''&& $('#shift_end').val() !=''&& $('#shifttimetotal').val() !=''&& $('#shift_name').val() !='') {
			$(".submitshiftbtn").prop('disabled', false);
		}else{
			$(".submitshiftbtn").prop('disabled', true);
		}

	});

	
	function checkshiftstart(){
		"use strict";
		var base 		  = $('#base_url').val();
		var csrf 		  = $('#csrf_token').val();
		var shift_start2  = $('#shift_start2').val();
		var shift_starth2 = $('#shift_starth2').val();
		var shift_id 	  = $('#shift_id').val();
		var shifttimetotal_h2   = $('#shifttimetotal_h2').val();
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/chk_shift_start_into_other",
			data:{
			   csrf_test_name:csrf,
			   shift_start2:shift_start2,
			   shift_id:shift_id
		    },
			success: function(data) {
				if (data == 1) {
					$('#shift_start2').val(shift_starth2);
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

	function checkshiftend(){
		"use strict";
		var base 		= $('#base_url').val();
		var csrf 		= $('#csrf_token').val();
		var shift_end2  = $('#shift_end2').val();
		var shift_endh2 = $('#shift_endh2').val();
		var shift_id    = $('#shift_id').val();
		var shifttimetotal_h2   = $('#shifttimetotal_h2').val();
		$.ajax({
			type: "POST",
			url: base+"duty_roster/Shift_management/chk_shift_end_into_other",
			data:{
			   csrf_test_name:csrf,
			   shift_end2:shift_end2,
			   shift_id:shift_id
		   },
			success: function(data) {
				if (data == 1) {
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

	
		
	

