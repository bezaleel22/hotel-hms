function getfreerooms(){
    'use strict';
	var guest= $("#guest").val();
	var room_name= $("#room_name").val();
	var no_of_people= $("#no_of_people");
	var check_in= $("#check_in").val();
	var check_out= $("#check_out").val();
	if(guest==''){
		alert('Please Select Guest!!');
		return false;
		}
	if(room_name==''){
		alert('Please Select Room');
		return false;
		}
	if(no_of_people==''){
		alert('Please Select Number of people');
		return false;
		}
	if(check_in==''){
		alert('Please Select Check In Date');
		return false;
		}
	if(check_out==''){
		alert('Please Select Check Out Date');
		return false;
        }
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var myurl=base+"room_reservation/room_reservation/checkroom";
	$.ajax({
		url: myurl,
		 type: "POST",
		 data: {csrf_test_name: csrf, guest: guest, room_name: room_name, check_in: check_in, check_out: check_out},
		 success: function(data) {
			 $('#bookinginfo').html(data);
			  $('select').selectpicker();
			 var found=$("#found").val();
		 } 
	  });
}

function getroomnumber(){
    'use strict';
	var totalroom=$("#numofroom").val();
	var totalnight=$("#totalnight").val();
	var price=$("#pernight").text();
	var subtotal=$("#orgSubtotal").val();
	var charge=$("#serviceCharge").val();
	var vat=$("#orgtax").val();
	var total=parseInt(subtotal)*parseInt(totalroom);
	var totalprice=parseInt(totalnight)*parseInt(price);
	var discount=parseInt(totalprice)*parseInt(totalroom);
	var totaldiscount=parseInt(discount)-parseInt(total);
	var serviceCharge=parseInt(charge)*parseInt(total)/100;
	var tax=parseInt(vat)*parseInt(total)/100;
	var granttotal=parseInt(total)+parseInt(serviceCharge)+parseInt(tax);
	$("#discount").val(total);
	$("#offer").text(totaldiscount);
	$("#prdis").text(total);
	$("#prcharge").text(serviceCharge);
	$("#prtax").text(tax);
	$("#total").text(granttotal);
	$("#gramount").val(granttotal);

	var noofpeople=$("#numofpeople").val();
	var maxpeople=$("#maxpeople").val();
	var capacity=$("#capacity").val();
	if(parseInt(noofpeople)>parseInt(maxpeople)){
	alert("Max number of people exceeds");
	$("#numofpeople").val('');
	return false;
	}
	if(parseInt(noofpeople)>parseInt(totalroom*capacity)){
	alert("Number of peoples capacity exceed on room");
	$("#numofpeople").val('');
	return false;
	}
	if(parseInt(totalroom)>parseInt(maxpeople/capacity)){
	alert("Room capacity exceed");
	$("#numofroom").val('');
	return false;
	}
	}