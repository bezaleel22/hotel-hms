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


function addtoplus(id, itemrow) {
	"use strict";
	var row = $("#newitemrow tr").length;
	if (row > 0 ) {
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		
	}
	var count =row + 1;
	var getid = id;
	var newdiv = document.createElement('tr');
	newdiv.setAttribute("id", "itemrow_"+id);
	var qty =  $('#itqty_'+getid).val();
	var packname =  $('#packname_'+getid).html();
	var packid =  $('#packid_'+getid).val();
	
	var dqty = parseInt(qty) + 1;

	$('#itqty_'+getid).val(dqty);
	var packageprice = $('#packprice_'+getid).html();
	var subtotal = parseFloat(packageprice * dqty);
	$('#subtprice_'+getid).html(subtotal.toFixed(2));
	//hidden input package Price
	$('#per_priceinp_'+getid).val(packageprice);
	//hidden input package name
	$('#package_nameinp_'+getid).val(packid);
	
	if(dqty != 1){

		$('#listitmqty_'+getid).html(dqty);
		$('#listitmtotal_'+getid).html(parseFloat(subtotal).toFixed(2));
		//hidden input item quantity & sub total
		$('#itemqtyinp_'+getid).val(dqty);
		$('#sub_totalinp_'+getid).val(subtotal);
	}
	
	if(dqty == 1){

		newdiv.innerHTML ='<tr><td><i class="ti-control-record" ></i></td><td>'+packname+'</td><td><span id="listitmqty_'+id+'">'+dqty+
		'</span>X'+packageprice+'</td><td class="listitmtotal text-center" id="listitmtotal_'+id+'">'+subtotal.toFixed(2)+
		'</td><td class="text-center"><button class="btn btn-xs btn-danger" type="button" value="Delete" onclick="removerow(this,'+id
		+')"><i class="ti-trash" aria-hidden="true"></i> </td></button> <input type="hidden" name="package_idinp[]" value="'+packid+
		'" id="package_nameinp_'+id+'" ><input type="hidden" name="per_priceinp[]" id="per_priceinp_'+id+'"  value="'+packageprice+
		'" ><input type="hidden" name="itemqtyinp[]" value="'+dqty+'" id="itemqtyinp_'+id+
		'" ><input type="hidden" class="mysubtotal" name="sub_totalinp[]" value="'+subtotal+'" id="sub_totalinp_'+id+'"></tr>';
		document.getElementById(itemrow).appendChild(newdiv);
	}

	var allprice = 0;
	$(".mysubtotal").each(function() {
		allprice=parseFloat(allprice)+parseFloat($(this).val());
	});
	$("#tamount").html(allprice.toFixed(2));
	$("#total_amount").val(allprice.toFixed(2));

	if ($("#total_amount").val() != 0 ) {
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		$('#bksvbtn2').show();
	}else{
		$('#tamountstr').hide();
		$('#tamount').hide();
		$('#bksvbtn').hide();
		$('#bksvbtn2').hide();
	}
	
}


function addtominus(id) {
	"use strict";
	var getid = id;
	var qty   =  $('#itqty_'+getid).val();
	if(qty != 0){
			
		var dqty = parseInt(qty) - 1;
		$('#itqty_'+getid).val(dqty);
		var packageprice = $('#packprice_'+getid).html();
		var subtotal = packageprice * dqty;
		$('#subtprice_'+getid).html(subtotal);
		$('#listitmqty_'+getid).html(dqty);
		$('#listitmtotal_'+getid).html(parseFloat(subtotal).toFixed(2));

		//hidden input item quantity & sub total
		$('#itemqtyinp_'+getid).val(dqty);
		$('#sub_totalinp_'+getid).val(subtotal);
	}
	

	if($('#listitmqty_'+getid).html() == 0){
		$('#itemrow_'+getid).remove();
		
	}
	var allprice = 0;
	$(".mysubtotal").each(function() {
		allprice=parseFloat(allprice)+parseFloat($(this).val());
	});
	$("#tamount").html(allprice.toFixed(2));
	$("#total_amount").val(allprice.toFixed(2));

	if ($("#total_amount").val() != 0 ) {
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		$('#bksvbtn2').show();
	}else{
		$('#tamountstr').hide();
		$('#tamount').hide();
		$('#bksvbtn').hide();
		$('#bksvbtn2').hide();
	}
}

function removerow2(t,id){
	var itid = id;
	var e = t.parentNode.parentNode;
	e.parentNode.removeChild(e);
	$('#itqty_'+id).val('0');
	$('#subtprice_'+id).html(0);
	var allprice = 0;
	$(".mysubtotal").each(function() {
		allprice=parseFloat(allprice)+parseFloat($(this).val());
	});
	$("#tamount").html(allprice.toFixed(2));
	$("#total_amount").val(allprice.toFixed(2));

	var row = $("#newitemrow tr").length;
	if(row == 0){
	}

	if ($("#total_amount").val() != 0 ) {
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		$('#bksvbtn2').show();
	}else{
		$('#tamountstr').hide();
		$('#tamount').hide();
		$('#bksvbtn').hide();
		$('#bksvbtn2').hide();
	}

}

function subtotalval(id) {
	"use strict";
	var getid = id;
	var qty =  $('#itqty_'+getid).val();
		
	$('#subtprice_'+getid).html(qty);
		
}

$(document).on("change", "#cust_name", function(){
	"use strict";
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var cust_id  = $('#cust_name').val();
	
	$.ajax({
		type: "POST",
		dataType: "json",
		
		url: base+"pool_booking/Pool_setting/cust_details",
		data:{
		csrf_test_name:csrf,
		cust_id:cust_id
		},
		success: function(data) {
	
		} 
	});

	if(cust_id == ''){
		$("#firstname").val('');
		$("#lastname").val('');
		$("#email").val('');
		$("#phonephonepool").val('');
		
	}
	
});

function removerow(t,id){
	var itid = id;
	var e = t.parentNode.parentNode;
	e.parentNode.removeChild(e);
	
	$('#itqty_'+id).val('0');
	$('#subtprice_'+id).html(0);


	var allprice = 0;
	$(".mysubtotal").each(function() {
		allprice=parseFloat(allprice)+parseFloat($(this).val());
	});
	$("#tamount").html(allprice.toFixed(2));
	$("#total_amount").val(allprice.toFixed(2));

	if ($("#total_amount").val() != 0 ) {
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		$('#bksvbtn2').show();
	}else{
		$('#tamountstr').hide();
		$('#tamount').hide();
		$('#bksvbtn').hide();
		$('#bksvbtn2').hide();
	}

}



$(document).ready(function() {
	var row = $("#newitemrow tr").length;
	if(row == 0){
		$('#tamountstr').hide();
		$('#tamount').hide();
		$('#bksvbtn').hide();
		$('#bksvbtn2').hide();
	}else{
		$('#tamountstr').show();
		$('#tamount').show();
		$('#bksvbtn').show();
		$('#bksvbtn2').show();
	}

	$(".custar").html(' *');
	$("#cust_name").attr("required", true);

	$('#newcust').hide();

	

	$("#addcustbtn").click(function(){

		$("#newcust").toggle();
		if ($("#newcust").is(':visible')) {
			$(".custar").html(' ');
			$("#addcustbtn i").addClass("ti-minus");
			$("#cust_name").attr("required", false);

			$("#firstname").attr("required", true);
			$("#doc_type").attr("required", true);
			$("#doc_num").attr("required", true);
			

			$("#cust_name").attr("disabled", true);

			$("#cust_name").val(" ");
			$("#bksvbtn2").attr("disabled", true);

			}else{
			$(".custar").html(' *');

			$("#addcustbtn i").removeClass("ti-minus");
			$("#addcustbtn i").addClass("ti-plus");
			$("#cust_name").attr("required", true);

			$("#firstname").attr("required", false);
			$("#doc_type").attr("required", false);
			$("#doc_num").attr("required", false);
			
			$("#bksvbtn2").attr("disabled", false);
			$("#cust_name").attr("disabled", false);
			}
		});
});


var j = [];
var k = [];
var l = [];
var m = [];
var pack_id= [];
var per_price= [];
var itemqty= [];
var sub_total= [];

function pbooking_create() {
	"use strict";
	var finyear = $("#finyear").val();
	if(finyear<=0){
		swal({
            title: "Failed",
            text: "Please Create Financial Year First",
            type: "warning",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		return false;
	}
	var row        = $("#newitemrow tr").length;
	var pakids     = document.getElementsByName('package_idinp[]');
	var per_prices = document.getElementsByName('per_priceinp[]');
	var itemqtys   = document.getElementsByName('itemqtyinp[]');
	var loopnum    = document.getElementsByName('itemqtyinp[]').length;
	var sub_totals = document.getElementsByName('sub_totalinp[]');

	for (var i = 0; i < pakids.length; i++) {
		var a = pakids[i];
		var b = per_prices[i];
		var c = itemqtys[i];
		var d = sub_totals[i];

		j = j + a.value+' ';
		k = k + b.value+' ';
		l = l + c.value+' ';
		m = m + d.value+' ';
	}
	pack_id   = j;
	per_price =k;
	itemqty   = l;
	sub_total = m;

	var base 	  = $('#base_url').val();
	var csrf 	  = $('#csrf_token').val();
	var cust_id   = $('#cust_name').val();
	var doc_type  = $('#doc_type').val();
	var firstname = $('#firstname').val();
	var lastname  = $('#lastname').val();
	var doc_num   = $('#doc_num').val();
	var email     = $('#email').val();
	var phone     = $('#phonepool').val();
	var umbl_cnt  = $('#unique_mobile_count').val();
	var total_amount = $('#total_amount').val();
	var newcustomer_type = $('#newcustomer_type').val();
	var cust_idold = $('#cust_idold').val();
	if (newcustomer_type == 'newcust'|| cust_id!=null) {
		if(cust_id || firstname && umbl_cnt == 0){
		
			$.ajax({
				type: "POST",
				url: base + "pool_booking/pool_setting/booking_create_ajax",
				data: {
					csrf_test_name:csrf,
					total_amount:total_amount,
					cust_id:cust_id,
					doc_type:doc_type,
					newcustomer_type:newcustomer_type,
					doc_num:doc_num,
					firstname:firstname,
					lastname:lastname,
					phone:phone,
					email:email,
					package_idinp:pack_id,
					per_priceinp:per_price,
					itemqtyinp:itemqty,
					loopnum:loopnum,
					sub_totalinp:sub_total
				},
				success: function(data) {
					$('#poollastins').val(data).trigger('change');
				
					$('#newitemrow').empty();
					$('#tamountstr').hide();
					$('#tamount').hide();
					$('#bksvbtn').hide();
					$('#bksvbtn2').hide();
					$('input[name="itqty"]').val('0');
					$('.subpriceclr').html('0.00');
					$("#cust_name").val('');
					$('#cust_name').val(null).trigger('change');
					$('#newcustomer_type').val(null).trigger('change');
					$('#cust_idold').val(null).trigger('change');
					$("#firstname").val('');
					$("#doc_type").val('');
					$("#doc_num").val('');
					$("#lastname").val('');
					$("#email").val('');
					$("#phonepool").val('');
					$("#addcustbtn i").removeClass("ti-minus");
					$("#addcustbtn i").addClass("ti-plus");
					$('#newcust').hide();
					$("#cust_name").attr("disabled", false);
					$("#new_cust_data1").prop('hidden', true);
					$("#new_cust_data2").prop('hidden', true);
					$("#old_cust_data1").prop('hidden', true);
					$("#old_cust_data2").prop('hidden', true);
					
					swal({
						title: "Succsess",
						text: "Do you Want to Print Invoice ???",
						type: "success",
						showCancelButton: true,
						confirmButtonColor: "#28a745",
						confirmButtonText: "Yes",
						cancelButtonText: "No",
						closeOnConfirm: true,
						closeOnCancel: true
					},
					function(isConfirm) {
						if (isConfirm) {
								
							$('.poolprint-btn').trigger('click');
	
						} else {}
					});
	
				}
			});
		
		}else{
			swal({
				title: "Failed",
				text: "Please Provide New Customer Information",
				type: "warning",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			});
		}
		
	}
	else if (newcustomer_type == "oldcust") {
		if(cust_idold){
		
			$.ajax({
				type: "POST",
				url: base + "pool_booking/pool_setting/booking_create_ajax",
				data: {
					csrf_test_name:csrf,
					total_amount:total_amount,
					cust_idold:cust_idold,
					newcustomer_type:newcustomer_type,
					package_idinp:pack_id,
					per_priceinp:per_price,
					itemqtyinp:itemqty,
					loopnum:loopnum,
					sub_totalinp:sub_total
				},
				success: function(data) {
					$('#poollastins').val(data).trigger('change');
				
					$('#newitemrow').empty();
					$('#tamountstr').hide();
					$('#tamount').hide();
					$('#bksvbtn').hide();
					$('#bksvbtn2').hide();
					$('input[name="itqty"]').val('0');
					$('.subpriceclr').html('0.00');
					$("#cust_name").val('');
					$('#cust_name').val(null).trigger('change');
					$('#newcustomer_type').val(null).trigger('change');
					$('#cust_idold').val(null).trigger('change');
					$("#firstname").val('');
					$("#doc_type").val('');
					$("#doc_num").val('');
					$("#lastname").val('');
					$("#email").val('');
					$("#phonepool").val('');
					$("#oldfirstname").val('');
					$("#addcustbtn i").removeClass("ti-minus");
					$("#addcustbtn i").addClass("ti-plus");
					$('#newcust').hide();
					$("#cust_name").attr("disabled", false);
					$("#new_cust_data1").prop('hidden', true);
					$("#new_cust_data2").prop('hidden', true);
					$("#old_cust_data1").prop('hidden', true);
					$("#old_cust_data2").prop('hidden', true);
					
					swal({
						title: "Succsess",
						text: "Do you Want to Print Invoice ???",
						type: "success",
						showCancelButton: true,
						confirmButtonColor: "#28a745",
						confirmButtonText: "Yes",
						cancelButtonText: "No",
						closeOnConfirm: true,
						closeOnCancel: true
					},
					function(isConfirm) {
						if (isConfirm) {
								
							$('.poolprint-btn').trigger('click');
	
						} else {}
					});
	
				}
			});
		
		}else{
			swal({
				title: "Failed",
				text: "Please Provide Old Customer Information",
				type: "warning",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			});
		}
	}
	else{
		swal({
			title: "Failed",
			text: "Please Provide Customer Information",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
	}

		
}

function loadpdataview(){
	"use strict";
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var poollastins = $('#poollastins').val();

	$.ajax({
		type: "POST",
		url: base+"pool_booking/Pool_setting/poolprdataview",
		data:{
			csrf_test_name:csrf,
			poollastins:poollastins
		},

		success: function(data) {
			$('#printdatadiv').html(data);
		
		} 
	});

}

function pbooking_createinhouse() {
	"use strict";
	var finyear = $("#finyear").val();
	if(finyear<=0){
		swal({
            title: "Failed",
            text: "Please Create Financial Year First",
            type: "warning",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		
		return false;
	}
	var row 	   = $("#newitemrow tr").length;
	var pakids 	   = document.getElementsByName('package_idinp[]');
	var per_prices = document.getElementsByName('per_priceinp[]');
	var itemqtys   = document.getElementsByName('itemqtyinp[]');
	var loopnum    = document.getElementsByName('itemqtyinp[]').length;
	var sub_totals = document.getElementsByName('sub_totalinp[]');

	for (var i = 0; i < pakids.length; i++) {
		var a = pakids[i];
		var b = per_prices[i];
		var c = itemqtys[i];
		var d = sub_totals[i];

		j = j + a.value+' ';
		k = k + b.value+' ';
		l = l + c.value+' ';
		m = m + d.value+' ';
	}
	pack_id   = j;
	per_price = k;
	itemqty   = l;
	sub_total = m;
	var base      = $('#base_url').val();
	var csrf      = $('#csrf_token').val();
	var cust_id   = $('#cust_name').val();
	var doc_type  = $('#doc_type').val();
	var firstname = $('#firstname').val();
	var lastname  = $('#lastname').val();
	var doc_num   = $('#doc_num').val();
	var email     = $('#email').val();
	var phone     = $('#phonepool').val();
	var total_amount = $('#total_amount').val();
	if(cust_id){
	
		$.ajax({
			type: "POST",
			url: base + "pool_booking/pool_setting/booking_create_ajax2",
			data: {
				csrf_test_name:csrf,
				total_amount:total_amount,
				cust_id:cust_id,
				doc_type:doc_type,
				doc_num:doc_num,
				firstname:firstname,
				lastname:lastname,
				phone:phone,
				email:email,
				package_idinp:pack_id,
				per_priceinp:per_price,
				itemqtyinp:itemqty,
				loopnum:loopnum,
				sub_totalinp:sub_total
			},
			success: function(data) {
				
				$('#newitemrow').empty();
				$('#tamountstr').hide();
				$('#tamount').hide();
				$('#bksvbtn').hide();
				$('#bksvbtn2').hide();
				$('input[name="itqty"]').val('0');
				$('.subpriceclr').html('0.00');
				$("#cust_name").val('');
				$('#cust_name').val(null).trigger('change');
				$("#firstname").val('');
				$("#doc_type").val('');
				$("#doc_num").val('');
				$("#lastname").val('');
				$("#email").val('');
				$("#phonepool").val('');
				$("#addcustbtn i").removeClass("ti-minus");
				$("#addcustbtn i").addClass("ti-plus");
				$('#newcust').hide();
				$("#cust_name").attr("disabled", false);
				
				swal({
					title: "Succsess",
					text: "Swimming Pool Booked !!",
					type: "success",
					confirmButtonColor: "#28a745",
					confirmButtonText: "Ok",
					closeOnConfirm: true
					
				});
			
			}
		});

	}else{
		swal({
            title: "Failed",
            text: "Please Provide Customer Information",
            type: "warning",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
	}
	
}

function podataprintflist(pbk_id){
	"use strict";
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();

	$.ajax({
		type: "POST",
		
		url: base+"pool_booking/Pool_setting/poolprdataview",
		data:{
			csrf_test_name:csrf,
			poollastins:pbk_id
		},

		success: function(data) {
			$('#printdatadivfromlist').html(data);
			$('.poolprint-btn').trigger('click');
		} 
	});


}

function pooldataclrjs(){
	
	$("#pool_name").val($("#pool_name option:first").val());
	$("#status").val($("#status option:first").val());
	$('.selectpicker').selectpicker('refresh');
	$('.jsclrimg').attr('src', baseurl+'assets/img/room-setting/room_images.png');
}

function poolimgdataclrjs(){
	
	$("#pool_id").val($("#pool_id option:first").val());
	$('.selectpicker').selectpicker('refresh');
	$('.jsclrimg').attr('src', baseurl+'assets/img/room-setting/room_images.png');
}

function newcustdata(){
	var newcustomer_type = $('#newcustomer_type').val();
	if (newcustomer_type == "newcust") {
		$("#phonepool").prop('readonly',false);
		$("#phonepool").val('');
		$("#oldfirstname").val('');
		$("#mobile_msg").attr('class', '');
		$("#cust_idold").val(null).trigger('change');
		$("#new_cust_data1").prop('hidden', false);
		$("#new_cust_data2").prop('hidden', false);
		$("#old_cust_data1").prop('hidden', true);
		$("#old_cust_data2").prop('hidden', true);
	}
	
	if (newcustomer_type == "oldcust") {

		$("#phonepool").prop('readonly', true);
		$("#mobile_msg").attr('class', '');
		$("#phonepool").val('');
		$("#old_cust_data1").prop('hidden', false);
		$("#old_cust_data2").prop('hidden', false);
		$("#new_cust_data1").prop('hidden', true);
		$("#new_cust_data2").prop('hidden', true);
		
	} 
}

function oldcustdatalist() {
	"use strict";
	var baseurl = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var cust_idold = $('#cust_idold').val();
	
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: baseurl+"pool_booking/Pool_setting/check_registered_customer",
		data:{
		  csrf_test_name:csrf,
		  cust_idold:cust_idold,
			
		},
		success: function(data) {
			console.log(data);
			if (data != null) {
				$('#oldfirstname').val(data.firstname);
				$('#phonepool').val(data.cust_phone);
			}
		} 
	  });
}

$('body').on('keyup', '#phonepool', function(){
	"use strict";
	var baseurl = $('#base_url').val();
	var csrf = $('#csrfhashresarvation').val();
	var mobile = $('#phonepool').val();
	
	$.ajax({
		type: "POST",
		url: baseurl+"pool_booking/Pool_setting/check_duplicate_customer",
		data:{
		  csrf_test_name:csrf,
		  mobile:mobile,
			
		},
		success: function(data) {
			$('#unique_mobile_count').val(data);
			console.log(data);
			if (data > 0) {
				$('#mobile_msg').addClass('text-danger');
				$('#mobile_msg').removeClass('text-success');
			}else{
				$('#mobile_msg').addClass('text-success');
				$('#mobile_msg').removeClass('text-danger');
				
			}
		} 
	  });

});
