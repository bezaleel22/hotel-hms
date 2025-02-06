$(document.body).on('change', '#floor_name', function(e){
	'use strict';
	e.preventDefault();
	$("#roomno" ).empty();
	$("#num_of_room" ).val('');
	});
	$(document.body).on('keyup', '#startno', function(e){
		'use strict';
	e.preventDefault();
	});
		$(document.body).on('keyup', '#num_of_room', function(e){
			'use strict';
		e.preventDefault();
		var floornum =$("#startno").val();
		var total =this.value;
		if(floornum==''){
			swal({
				title: "Failed",
				text: "Please Add Starting room No. ex:(1st Floor start with 101,2nd start with 201)",
				type: "error",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			});
			$("#num_of_room").val('');
			return false;
			}
		var str50 = parseInt(floornum)+parseInt(total)-1;
		var htmlcontent='<label for="room_no" class="col-sm-4 col-form-label">Room No.</label>';
		var htmlcontentop='<div class="col-sm-8 row allrom"></div>';
		$("#roomno" ).empty();
		var htmlcontentmain="";
		for(var i=floornum;i<=str50;i++){
			var return_first = function () {
				var csrf = $('#csrf_token').val();
				var check = null;
				$.ajax({
					url: baseurl+"room_setting/floorplan/checkRoom",
					async: false,
					type: "POST",
					data: {
						csrf_test_name: csrf,
						roomno: i,
					},
					success: function(data) {
						var obj = JSON.parse(data);
						if(obj!=""){
							check = "is-invalid";
						}else{
							check="";
						}
					}
				});
				return check;
			}();
			 htmlcontentmain +='<div class="col-sm-4 pl-0"><input name="room_no[]" autocomplete="off" class="form-control padding_3_3_m_b_3 '+return_first+'" type="number" id="room_no" value="'+i+'"></div>';
			}
		$("#roomno").append(htmlcontent+htmlcontentop); 
		$(".allrom").append(htmlcontentmain); 
		});	
		$(document.body).on('change', '#floor_nameedit', function(e){
			'use strict';
	e.preventDefault();
	$("#roomnoedit" ).empty();
	$("#num_of_roomedit" ).val('');
	});
	$(document.body).on('keyup', '#startnoedit', function(e){
		'use strict';
	e.preventDefault();
	});
		$(document.body).on('keyup', '#num_of_roomedit', function(e){
			'use strict';
		e.preventDefault();
		var floornum =$("#startnoedit").val();
		var total =this.value;
		if(floornum==''){
			swal({
				title: "Failed",
				text: "Please Add Starting room No. ex:(1st Floor start with 101,2nd start with 201)",
				type: "error",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			});
			$("#num_of_roomedit").val('');
			return false;
			}
		var str50 = parseInt(floornum)+parseInt(total)-1;
		var htmlcontent='<label for="room_no" class="col-sm-4 col-form-label">Room No <span class="text-danger">*</span></label>';
		var htmlcontentop='<div class="col-sm-8 row allrom"></div>';
		$("#roomnoedit" ).empty();
		var htmlcontentmain="";
		for(var i=floornum;i<=str50;i++){
			var return_first = function () {
				var csrf = $('#csrf_token').val();
				var floor = $("#floor").val();
				var check = null;
				$.ajax({
					url: baseurl+"room_setting/floorplan/checkRoom",
					async: false,
					type: "POST",
					data: {
						csrf_test_name: csrf,
						roomno: i,
						floor: floor
					},
					success: function(data) {
						var obj = JSON.parse(data);
						if(obj!=""){
							check = "is-invalid";
						}else{
							check="";
						}
					}
				});
				return check;
			}();
			 htmlcontentmain +='<div class="col-sm-4 pl-0"><input name="room_no[]" autocomplete="off" class="form-control padding_3_3_m_b_3 '+return_first+'" type="number" id="room_no" value="'+i+'"></div>';
			}
		$("#roomnoedit").append(htmlcontent+htmlcontentop); 
		$(".allrom").append(htmlcontentmain); 
		});	

		"use strict";
	    $("#capabiliity").on("change", function(){
			if(this.value==1){
				$("#exbed").attr("hidden", false);
				$("#experson").attr("hidden", false);
			}
			if(this.value==0){
				$("#exbed").attr("hidden", true);
				$("#experson").attr("hidden", true);
			}
		});